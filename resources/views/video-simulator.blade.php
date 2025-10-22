<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Video Simulator - Dot Creator</title>

    <!-- p5.js depuis CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.7.0/p5.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Toolbar (barre d'outils en bas à gauche) */
        #toolbar {
            position: fixed;
            bottom: 20px;
            left: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        #toolbar button {
            width: 48px;
            height: 48px;
            border: none;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.2s;
            padding: 8px;
        }

        #toolbar button:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        #toolbar button:active {
            transform: translateY(0);
        }

        #toolbar button img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        #toolbar.loading button {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Sidebar (panneau de contrôle à droite) */
        #sidebar {
            position: fixed;
            right: 0;
            top: 0;
            width: 320px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: -4px 0 12px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 999;
            transition: transform 0.3s ease;
        }

        #sidebar.hidden {
            transform: translateX(100%);
        }

        .sidebar-header {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .sidebar-header h2 {
            margin: 0 0 10px 0;
            font-size: 24px;
        }

        .tabs {
            display: flex;
            gap: 10px;
        }

        .tab {
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 6px;
            color: white;
            cursor: pointer;
            transition: background 0.2s;
        }

        .tab.active {
            background: white;
            color: #667eea;
        }

        .tab-content {
            display: none;
            padding: 20px;
        }

        .tab-content.active {
            display: block;
        }

        .control-group {
            margin-bottom: 24px;
        }

        .control-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .control-group input[type="range"] {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #e0e0e0;
            outline: none;
            -webkit-appearance: none;
        }

        .control-group input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #667eea;
            cursor: pointer;
        }

        .control-group input[type="color"] {
            width: 100%;
            height: 40px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
        }

        .control-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .value-display {
            display: inline-block;
            margin-left: 10px;
            color: #667eea;
            font-weight: 600;
        }

        /* Toggle sidebar button */
        #toggleSidebar {
            position: fixed;
            right: 20px;
            top: 20px;
            width: 48px;
            height: 48px;
            border: none;
            border-radius: 50%;
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            cursor: pointer;
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                width: 100%;
            }

            #toolbar {
                bottom: 10px;
                left: 10px;
            }
        }
    </style>
</head>
<body>
<!-- Container pour le canvas p5.js -->
<div id="canvas-container"></div>

<!-- Toolbar (Barre d'outils) -->
<div id="toolbar" class="loading">
    <button id="playBtn">
        <img src="{{ asset('video-simulator/icones/play.png') }}" alt="Play">
    </button>
    <button id="pauseBtn">
        <img src="{{ asset('video-simulator/icones/pause.png') }}" alt="Pause">
    </button>
    <button id="resetBtn">
        <img src="{{ asset('video-simulator/icones/reset.png') }}" alt="Reset">
    </button>
    <button id="recordBtn">
        <img src="{{ asset('video-simulator/icones/rec.png') }}" alt="Record">
    </button>
</div>

<!-- Toggle Sidebar Button -->
<button id="toggleSidebar">⚙️</button>

<!-- Sidebar (Panneau de contrôle) -->
<div id="sidebar">
    <div class="sidebar-header">
        <h2>Paramètres</h2>
        <div class="tabs">
            <button class="tab active" data-tab="circle">Cercle</button>
            <button class="tab" data-tab="triangle">Polygone</button>
        </div>
    </div>

    <!-- Onglet Cercle -->
    <div id="circle-tab" class="tab-content active">
        <div class="control-group">
            <label>
                Taille de la fente
                <span class="value-display" id="gapValue">30°</span>
            </label>
            <input type="range" id="gapSlider" min="0" max="180" value="30">
        </div>

        <div class="control-group">
            <label>
                Vitesse de rotation
                <span class="value-display" id="speedValue">1x</span>
            </label>
            <input type="range" id="speedSlider" min="0" max="5" step="0.1" value="1">
        </div>

        <div class="control-group">
            <label>
                <input type="checkbox" id="gravityCheckbox" checked>
                Activer la gravité
            </label>
        </div>

        <div class="control-group">
            <label>
                Couleur des balles
            </label>
            <input type="color" id="ballColorPicker" value="#FF6B6B">
        </div>

        <div class="control-group">
            <label>
                <input type="checkbox" id="soundCheckbox" checked>
                Activer les sons
            </label>
        </div>

        <div class="control-group">
            <label>
                Volume des sons
                <span class="value-display" id="volumeValue">50%</span>
            </label>
            <input type="range" id="volumeSlider" min="0" max="100" value="50">
        </div>
    </div>

    <!-- Onglet Triangle/Polygone -->
    <div id="triangle-tab" class="tab-content">
        <div class="control-group">
            <label>
                <input type="checkbox" id="polygonModeCheckbox">
                Mode polygone progressif
            </label>
        </div>

        <div class="control-group">
            <label>
                Nombre de côtés
                <span class="value-display" id="sidesValue">3</span>
            </label>
            <input type="range" id="sidesSlider" min="3" max="12" value="3">
        </div>

        <div class="control-group">
            <label>
                Taille de la fente (polygone)
                <span class="value-display" id="triGapValue">30°</span>
            </label>
            <input type="range" id="triGapSlider" min="0" max="120" value="30">
        </div>

        <div class="control-group">
            <label>
                Vitesse de rotation
                <span class="value-display" id="triSpeedValue">1x</span>
            </label>
            <input type="range" id="triSpeedSlider" min="0" max="5" step="0.1" value="1">
        </div>

        <div class="control-group">
            <label>
                <input type="checkbox" id="triGravityCheckbox" checked>
                Activer la gravité
            </label>
        </div>
    </div>
</div>

<script>
    // ============================================
    // CODE SKETCH.JS D'ANTOINE
    // ============================================

    p5.disableFriendlyErrors = true;

    /* ---------- Etat global ---------- */
    let shapeMode = 'circle'; window.shapeMode = shapeMode;
    let balls = []; let running = false;

    /* ---------- Cercle ---------- */
    let portalAngle = 0, portalSize = Math.PI/15;
    let radiusPct = 40, radius = 200;
    let center;

    /* ---------- Triangle / Polygone ---------- */
    let triAngle = 0, triSizePct = 40, triRadius = 200;
    let triPerimeter = 0, triGapLen = 0;
    let triExitMultiplier = 2;

    // Mode polygone progressif
    let polygonMode = false;
    let polygonSides = 3;
    let polygonMax = 50;
    let polyIncCooldown = 0;
    let polygonColorful = false;
    let shapeStroke = [255,255,255];

    /* ---------- Vitesse rotation ---------- */
    let rotationMultiplier = 5, triRotationMultiplier = 5;
    const baseRotationSpeed = 0.0015;

    /* ---------- Physique ---------- */
    let gravityEnabled = false, gravityDown = 0.04;
    let reboundSpeedMultiplier = 1.0, bounceCurvature = 0.04;
    const EPS = 0.6;

    /* ---------- Audio ---------- */
    let audioCtx=null, sfxEnabled=false, sfxVolume=0.7;
    let masterGain=null, recorderDest=null;

    /* ---------- Gameplay cercle ---------- */
    let gapEnabled=false;
    let exitMultiplier=2;
    let growthMultiplier=1.10;
    const initialBallSpeed = 3;

    /* ---------- Recording ---------- */
    let p5Canvas, mediaRecorder=null, recordedChunks=[], isRecording=false;

    /* ================= Setup ================= */
    function setup(){
        const w=540,h=960;
        p5Canvas=createCanvas(w,h);
        p5Canvas.parent('canvas-container');
        frameRate(60);
        center = createVector(width/2, height/2);
        radius = width*(radiusPct/100);
        triRadius = width*(triSizePct/100);
        updatePolygonGeometry();

        // Activer les boutons
        document.getElementById('toolbar').classList.remove('loading');

        console.log('✅ Setup terminé, canvas créé');
    }

    function windowResized(){
        const w=540,h=960; resizeCanvas(w,h);
        center.set(width/2,height/2);
        radius = width*(radiusPct/100);
        triRadius = width*(triSizePct/100);
        updatePolygonGeometry();
    }

    /* ================= Loop ================= */
    function draw(){
        background(0, isRecording?30:50);
        portalAngle += baseRotationSpeed*rotationMultiplier;
        triAngle    += baseRotationSpeed*triRotationMultiplier;

        if(polyIncCooldown>0) polyIncCooldown--;

        drawScene(); drawShapeName(); drawSignature(); drawBallCounter();
        if(!running) return;

        if(balls.length===0){
            balls.push(new Ball(center.copy(), p5.Vector.random2D().mult(initialBallSpeed)));
        }

        let spawned=[];
        for(let i=balls.length-1;i>=0;i--){
            const b=balls[i];
            b.frameReset();
            b.update();
            b.show();

            if(shapeMode==='circle' && !gapEnabled && b.isOffScreen()){
                balls.splice(i,1);
                for(let j=0;j<exitMultiplier;j++){
                    spawned.push(new Ball(center.copy(), p5.Vector.random2D().mult(random(1,initialBallSpeed))));
                }
                continue;
            }

            if(shapeMode==='triangle' && !polygonMode && b.exitedNow){
                for(let j=1;j<triExitMultiplier;j++){
                    spawned.push(new Ball(center.copy(), p5.Vector.random2D().mult(random(1,initialBallSpeed))));
                }
            }
        }
        if(spawned.length) balls=balls.concat(spawned);
    }

    /* ================= UI bits ================= */
    function drawBallCounter(){
        push();
        noStroke();
        fill(0,255,200);
        textAlign(CENTER,TOP);
        textSize(17);
        text(`Balls: ${balls.length}`,width/2,60);
        pop();
    }

    function drawSignature(){
        push();
        textAlign(CENTER,CENTER);
        const R=(shapeMode==='circle'?radius:triRadius);
        textSize(Math.min(R*0.12,17));
        stroke(0,140);
        strokeWeight(4);
        fill(255);
        text('@dot.creatorr',center.x,center.y);
        pop();
    }

    function drawShapeName(){
        if(shapeMode!=='triangle') return;
        const n = polygonMode ? polygonSides : 3;
        const name = polygonEnglishName(n);
        push();
        noStroke(); fill(255);
        textAlign(CENTER,TOP);
        textSize(18);
        const y = center.y + triRadius + 28;
        text(name, center.x, y);
        pop();
    }

    /* ================= Scène ================= */
    function drawScene(){
        stroke(...shapeStroke); strokeWeight(4); noFill();

        if(shapeMode==='circle'){
            if(!gapEnabled){
                const gs=portalAngle-portalSize, ge=portalAngle+portalSize;
                arc(center.x,center.y,radius*2,radius*2,ge,gs+TWO_PI);
            }
            else arc(center.x,center.y,radius*2,radius*2,0,TWO_PI);
            return;
        }

        const verts = getCurrentPolygonVertices();

        if(polygonMode){
            for(let i=0;i<verts.length;i++){
                const a=verts[i], b=verts[(i+1)%verts.length];
                line(a.x,a.y,b.x,b.y);
            }
        }else{
            const P = triPerimeter;
            const sCenter = angleToPerimeterOffset(triAngle);
            const sA = sCenter - triGapLen/2, sB = sCenter + triGapLen/2;
            const parts = perimeterPartsWithoutGap(verts, sA, sB, P);
            for(const seg of parts) line(seg.a.x, seg.a.y, seg.b.x, seg.b.y);
        }
    }

    /* ================= Ball ================= */
    class Ball{
        constructor(pos,vel){
            this.pos=pos.copy(); this.vel=vel.copy(); this.r=8;
            this.color=color(random(100,255),random(100,255),random(100,255),220);
            this.hasExitedGap=false;
            this.exitedNow=false;
            this.exitCooldown=0;
        }
        frameReset(){ if(this.exitCooldown>0) this.exitCooldown--; this.exitedNow=false; }

        update(){
            if(gravityEnabled) this.vel.y += gravityDown;
            this.pos.add(this.vel);
            if(shapeMode==='circle') this._updateCircle();
            else this._updateTriangleOrPolygon();
        }

        _updateCircle(){
            const dir=p5.Vector.sub(this.pos,center);
            const dist=dir.mag(); const ang=dir.heading();

            if(!gapEnabled){
                if(dist >= radius - this.r){
                    if(!this.hasExitedGap && isAngleInsideGap(ang,portalAngle,portalSize)){
                        this.hasExitedGap=true;
                        this.vel.add(dir.copy().normalize().mult(1));
                    }else if(!this.hasExitedGap){
                        this._reflectOnNormal(dir.copy().normalize());
                        const n=dir.copy().normalize(); this.pos=p5.Vector.add(center,n.mult(radius-this.r-EPS));
                    }
                }
            }else{
                if(dist >= radius - this.r){
                    this._reflectOnNormal(dir.copy().normalize());
                    const target=radius - EPS - 1; this.r=Math.min(target,this.r*growthMultiplier); if(target-this.r<0.5) this.r=target;
                    const n=dir.copy().normalize(); this.pos=p5.Vector.add(center,n.mult(radius-this.r-EPS));
                }
            }
        }

        _updateTriangleOrPolygon(){
            const verts = getCurrentPolygonVertices();
            const edges = verts.length;

            for(let e=0;e<edges;e++){
                const p0=verts[e], p1=verts[(e+1)%edges];
                const res=collideCircleLineSegment(this.pos,this.r,p0,p1);
                if(!res.hit) continue;

                const outward = p5.Vector.mult(res.normal,-1);
                const goingOut = p5.Vector.dot(this.vel,outward) > 0;

                if(!polygonMode){
                    const sOnPerim = edgeParamToPerimeterOffset(edges, e, res.tOnSeg);
                    const gapLenEff = triGapLen + 2*this.r*1.2;
                    const inGap = isPerimeterInsideGap(sOnPerim, gapLenEff, triAngle, triPerimeter);

                    if(inGap && goingOut && this.exitCooldown===0){
                        this.vel.add(outward.copy().mult(0.8));
                        this.pos.add(outward.copy().mult(EPS+1));
                        this.exitedNow=true;
                        this.exitCooldown=10;
                        triggerBounceSound(this.vel.mag());
                        if(polygonColorful) randomizeShapeColor();
                        break;
                    }else if(!inGap){
                        this._reflectOnNormal(res.normal);
                        this.pos.add(res.normal.copy().mult((this.r+EPS)-res.dist));
                        if(polygonColorful) randomizeShapeColor();
                        break;
                    }else{
                        this.pos.add(outward.copy().mult(0.2));
                        break;
                    }
                }else{
                    this._reflectOnNormal(res.normal);
                    this.pos.add(res.normal.copy().mult((this.r+EPS)-res.dist));

                    if(polyIncCooldown===0 && polygonSides < polygonMax){
                        polygonSides++;
                        updatePolygonGeometry();
                        polyIncCooldown = 8;
                        const badge = document.getElementById('polyCurrent');
                        if(badge) badge.textContent = polygonSides;
                    }
                    if(polygonColorful) randomizeShapeColor();
                    break;
                }
            }
        }

        _reflectOnNormal(n){
            const dot=p5.Vector.dot(this.vel,n);
            this.vel.sub(p5.Vector.mult(n,2*dot));
            const t=createVector(-n.y,n.x); this.vel.add(t.mult(bounceCurvature));
            this.vel.mult(reboundSpeedMultiplier).limit(16);
            triggerBounceSound(this.vel.mag());
        }

        isOffScreen(){ return this.pos.x<-50||this.pos.x>width+50||this.pos.y<-50||this.pos.y>height+50; }

        show(){ noStroke(); this.color.setAlpha(220); fill(this.color); circle(this.pos.x,this.pos.y,this.r*2); }
    }

    /* ================= Polygone helpers ================= */
    function getCurrentPolygonVertices(){
        const n = polygonMode ? polygonSides : 3;
        const verts = [];
        const start = -PI/2 + triAngle;
        for(let i=0;i<n;i++){
            const ang = start + i * TWO_PI/n;
            const v = p5.Vector.fromAngle(ang).mult(triRadius);
            verts.push(createVector(center.x + v.x, center.y + v.y));
        }
        return verts;
    }
    function updatePolygonGeometry(){
        const n = polygonMode ? polygonSides : 3;
        triPerimeter = 2 * n * triRadius * Math.sin(Math.PI / n);
    }
    function angleToPerimeterOffset(a){
        const frac = (((a%TWO_PI)+TWO_PI)%TWO_PI)/TWO_PI;
        return frac * triPerimeter;
    }
    function perimeterPartsWithoutGap(verts, sA, sB, P){
        let a=((sA%P)+P)%P, b=((sB%P)+P)%P; if(b<a) b+=P;
        const n = verts.length;
        const sideLen = P / n;
        const starts = Array.from({length:n+1}, (_,i)=> i*sideLen);
        const parts=[];
        for(let e=0;e<n;e++){
            const segStart=starts[e], segEnd=starts[e+1];
            const A=Math.max(segStart,a), B=Math.min(segEnd,b);
            const p0=verts[e], p1=verts[(e+1)%n];
            const pointAt=t=>p5.Vector.lerp(p0,p1,t);
            const push=(sAbs,eAbs)=>{
                const s=constrain((sAbs-segStart)/sideLen,0,1);
                const ee=constrain((eAbs-segStart)/sideLen,0,1);
                if(ee-s>1e-6) parts.push({a:pointAt(s),b:pointAt(ee)});
            };
            if(A-segStart>1e-6) push(segStart,A);
            if(segEnd-B>1e-6)   push(B,segEnd);
        }
        return parts;
    }
    function isPerimeterInsideGap(s,gapLen,angleCenter,P){
        const c=angleToPerimeterOffset(angleCenter);
        let a=((c-gapLen/2)%P+P)%P, b=((c+gapLen/2)%P+P)%P;
        if(a<=b) return s>=a && s<=b;
        return s>=a || s<=b;
    }
    function edgeParamToPerimeterOffset(edgeCount, edgeIndex, t){
        const sideLen = triPerimeter / edgeCount;
        return edgeIndex * sideLen + t*sideLen;
    }
    function collideCircleLineSegment(c,r,a,b){
        const ab=p5.Vector.sub(b,a), ac=p5.Vector.sub(c,a), ab2=ab.magSq();
        const t=(ab2>0)?constrain(p5.Vector.dot(ac,ab)/ab2,0,1):0;
        const p=p5.Vector.add(a,p5.Vector.mult(ab,t)), pc=p5.Vector.sub(c,p), dist=pc.mag();
        if(dist<=r+EPS){ let n=dist>1e-8?pc.copy().mult(1/dist):createVector(0,-1); return {hit:true,dist,tOnSeg:t,normal:n}; }
        return {hit:false};
    }

    /* ================= Cercle helpers ================= */
    function isAngleInsideGap(angle,centerAngle,halfWidth){
        const a=((angle+TWO_PI)%TWO_PI), c=((centerAngle+TWO_PI)%TWO_PI);
        const d1=abs(a-c), d2=TWO_PI-d1; return min(d1,d2)<=halfWidth*1.3;
    }

    /* ================= Audio ================= */
    function ensureAudio(){
        if(!audioCtx) audioCtx=new (window.AudioContext||window.webkitAudioContext)();
        if(!masterGain){ masterGain=audioCtx.createGain(); masterGain.gain.value=1; masterGain.connect(audioCtx.destination); }
        if(audioCtx.state==='suspended') audioCtx.resume();
    }
    function triggerBounceSound(speed){
        if(!sfxEnabled) return; ensureAudio();
        const now=audioCtx.currentTime, dur=0.12, freq=220+Math.min(speed,20)*25, vol=sfxVolume*Math.min(1,0.3+speed/10);
        const osc=audioCtx.createOscillator(); osc.type='sine'; osc.frequency.setValueAtTime(freq,now); osc.frequency.exponentialRampToValueAtTime(freq*0.6,now+dur);
        const g=audioCtx.createGain(); g.gain.setValueAtTime(0.0001,now); g.gain.linearRampToValueAtTime(vol,now+0.01); g.gain.exponentialRampToValueAtTime(0.0001,now+dur);
        osc.connect(g).connect(masterGain); osc.start(now); osc.stop(now+dur);
    }

    /* ================= Helpers couleurs ================= */
    function randomizeShapeColor(){
        shapeStroke = [random(120,255), random(120,255), random(120,255)];
    }

    /* ================= Noms en anglais ================= */
    function polygonEnglishName(n){
        const map = {
            3:'Triangle',4:'Square',5:'Pentagon',6:'Hexagon',7:'Heptagon',8:'Octagon',9:'Nonagon',10:'Decagon',
            11:'Hendecagon',12:'Dodecagon'
        };
        return map[n] || `${n}-gon`;
    }

    /* ================= Setters (UI) ================= */
    function startSim(){
        if(!center) {
            console.warn('⚠️ Setup pas encore terminé');
            return;
        }
        if(balls.length===0){
            balls.push(new Ball(center.copy(), p5.Vector.random2D().mult(initialBallSpeed)));
        }
        running=true;
    }
    function stopSim(){ running=false; }
    function resetSim(){ balls=[]; running=false; }

    window.startSim=startSim; window.stopSim=stopSim; window.resetSim=resetSim;

    function setShapeMode(m){ shapeMode=(m==='triangle')?'triangle':'circle'; window.shapeMode=shapeMode; }
    function setPortalSizeFromDegrees(deg){ portalSize=(deg*Math.PI/180)/2; }
    function setRotationSpeed(m){ rotationMultiplier=m; }
    function setCircleRadiusPct(p){ radiusPct=p; radius=width*(radiusPct/100); }

    function setGapEnabled(on){ gapEnabled=!!on; }
    function setBallMultiplier(n){ exitMultiplier=max(1,floor(n)); }
    function setGrowthPercent(p){ growthMultiplier=1+max(0,p)/100; }
    function setBallSpeed(v){ reboundSpeedMultiplier=max(0.1,Number(v)); }
    function setCurvature(c){ bounceCurvature=max(0,Number(c)); }
    function setGravityEnabled(on){ gravityEnabled=!!on; }
    function setGravityDown(g){ gravityDown=max(0,Number(g)); }
    function setSfxEnabled(on){ sfxEnabled=!!on; if(sfxEnabled) ensureAudio(); }
    function setSfxVolume(v){ sfxVolume=constrain(Number(v),0,1); }

    function setTriangleSizePct(p){ triSizePct=p; triRadius=width*(triSizePct/100); updatePolygonGeometry(); }
    function setTriangleRotationSpeed(m){ triRotationMultiplier=m; }
    function setTriangleGapDegrees(deg){
        const frac = constrain(deg/360, 0, 1);
        triGapLen = frac * triPerimeter;
    }
    function setTriangleBallMultiplier(n){ triExitMultiplier=max(1,floor(n)); }

    function setPolygonMode(on){
        polygonMode = !!on;
        if(polygonMode){
            polygonSides = 3;
            polyIncCooldown = 0;
            updatePolygonGeometry();
        }
    }
    function getPolygonMode(){ return polygonMode; }
    function getPolygonSides(){ return polygonSides; }
    function setPolygonMax(n){
        polygonMax = constrain(Math.floor(n), 3, 50);
        if(polygonSides>polygonMax) polygonSides = polygonMax;
        updatePolygonGeometry();
    }
    function setPolygonColorful(on){ polygonColorful = !!on; }
    window.setPolygonColorful = setPolygonColorful;

    window.setShapeMode=setShapeMode; window.setPortalSizeFromDegrees=setPortalSizeFromDegrees;
    window.setRotationSpeed=setRotationSpeed; window.setCircleRadiusPct=setCircleRadiusPct;
    window.setGapEnabled=setGapEnabled; window.setBallMultiplier=setBallMultiplier; window.setGrowthPercent=setGrowthPercent;
    window.setBallSpeed=setBallSpeed; window.setCurvature=setCurvature; window.setGravityEnabled=setGravityEnabled; window.setGravityDown=setGravityDown;
    window.setSfxEnabled=setSfxEnabled; window.setSfxVolume=setSfxVolume;

    window.setTriangleSizePct=setTriangleSizePct; window.setTriangleRotationSpeed=setTriangleRotationSpeed;
    window.setTriangleGapDegrees=setTriangleGapDegrees; window.setTriangleBallMultiplier=setTriangleBallMultiplier;

    window.setPolygonMode=setPolygonMode; window.getPolygonMode=getPolygonMode;
    window.getPolygonSides=getPolygonSides; window.setPolygonMax=setPolygonMax;

    /* ================= Recording ================= */
    function startRecording(){
        if(isRecording) return;
        const canvasStream=p5Canvas.elt.captureStream(60);
        const track=canvasStream.getVideoTracks()[0];
        if(track?.applyConstraints) track.applyConstraints({frameRate:60}).catch(()=>{});
        ensureAudio();
        recorderDest=audioCtx.createMediaStreamDestination();
        try{ masterGain.disconnect(); }catch(e){}
        masterGain.connect(audioCtx.destination);
        masterGain.connect(recorderDest);
        const mixedStream=new MediaStream([...canvasStream.getVideoTracks(), ...recorderDest.stream.getAudioTracks()]);
        const prefs=['video/webm;codecs=vp8','video/webm'];
        let mime='';
        for(const m of prefs){
            if(MediaRecorder.isTypeSupported(m)){
                mime=m;
                break;
            }
        }
        const opts=mime?{mimeType:mime,videoBitsPerSecond:3_000_000}:{videoBitsPerSecond:3_000_000};
        recordedChunks=[];
        mediaRecorder=new MediaRecorder(mixedStream,opts);
        mediaRecorder.ondataavailable=e=>{
            if(e.data&&e.data.size>0) recordedChunks.push(e.data);
        };
        mediaRecorder.onstop=async()=>{
            try{ masterGain.disconnect(recorderDest); }catch(e){}
            recorderDest=null;
            await saveRecordingMP4();
        };
        mediaRecorder.start();
        isRecording=true;
        const b=document.getElementById('recordBtn');
        if(b) b.style.background = '#ff0000';
    }

    function stopRecording(){
        if(!isRecording||!mediaRecorder) return;
        mediaRecorder.stop();
        isRecording=false;
        const b=document.getElementById('recordBtn');
        if(b) b.style.background = 'white';
    }

    function toggleRecord(){
        if(isRecording) stopRecording();
        else startRecording();
    }
    window.toggleRecord=toggleRecord;

    async function saveRecordingMP4(){
        try{
            const webmBlob=new Blob(recordedChunks,{type: recordedChunks[0]?.type || 'video/webm'});
            const fd=new FormData();
            fd.append('webm',webmBlob,'input.webm');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const resp=await fetch('{{ route('api.convert-webm') }}',{
                method:'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body:fd
            });

            if(!resp.ok) throw new Error('convert failed');
            const mp4Blob=await resp.blob();
            downloadAutoIncrement(mp4Blob,'mp4');
        }catch(err){
            console.warn('⚠️ Conversion serveur échouée, fallback WebM.',err);
            const wb=new Blob(recordedChunks,{type: recordedChunks[0]?.type || 'video/webm'});
            downloadAutoIncrement(wb,'webm');
        }
    }

    function downloadAutoIncrement(blob,ext){
        const key='bb_video_index';
        const idx=Number(localStorage.getItem(key)||1);
        const name=`video${idx}.${ext}`;
        localStorage.setItem(key,String(idx+1));
        const url=URL.createObjectURL(blob);
        const a=document.createElement('a');
        a.href=url;
        a.download=name;
        document.body.appendChild(a);
        a.click();
        setTimeout(()=>{
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
        },0);
    }
</script>

<script>
    // ============================================
    // CONNEXION UI (sidebar + toolbar)
    // ============================================

    // Toggle sidebar
    document.getElementById('toggleSidebar').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('hidden');
    });

    // Switch tabs
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', (e) => {
            const tabName = e.target.dataset.tab;

            // Masquer tous les onglets
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.tab').forEach(t => {
                t.classList.remove('active');
            });

            // Afficher l'onglet sélectionné
            document.getElementById(`${tabName}-tab`).classList.add('active');
            e.target.classList.add('active');

            // Changer le mode de forme
            if(tabName === 'circle') {
                setShapeMode('circle');
            } else {
                setShapeMode('triangle');
            }
        });
    });

    // Connexion des contrôles - Cercle
    document.getElementById('gapSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('gapValue').textContent = value + '°';
        if(typeof setPortalSizeFromDegrees === 'function') setPortalSizeFromDegrees(parseFloat(value));
    });

    document.getElementById('speedSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('speedValue').textContent = value + 'x';
        if(typeof setRotationSpeed === 'function') setRotationSpeed(parseFloat(value));
    });

    document.getElementById('gravityCheckbox').addEventListener('change', (e) => {
        if(typeof setGravityEnabled === 'function') setGravityEnabled(e.target.checked);
    });

    document.getElementById('soundCheckbox').addEventListener('change', (e) => {
        if(typeof setSfxEnabled === 'function') setSfxEnabled(e.target.checked);
    });

    document.getElementById('volumeSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('volumeValue').textContent = value + '%';
        if(typeof setSfxVolume === 'function') setSfxVolume(parseFloat(value) / 100);
    });

    // Connexion des contrôles - Triangle/Polygone
    document.getElementById('polygonModeCheckbox').addEventListener('change', (e) => {
        if(typeof setPolygonMode === 'function') setPolygonMode(e.target.checked);
    });

    document.getElementById('sidesSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('sidesValue').textContent = value;
        // Note: en mode normal (pas polygone progressif), ce slider ne fait rien
    });

    document.getElementById('triGapSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('triGapValue').textContent = value + '°';
        if(typeof setTriangleGapDegrees === 'function') setTriangleGapDegrees(parseFloat(value));
    });

    document.getElementById('triSpeedSlider').addEventListener('input', (e) => {
        const value = e.target.value;
        document.getElementById('triSpeedValue').textContent = value + 'x';
        if(typeof setTriangleRotationSpeed === 'function') setTriangleRotationSpeed(parseFloat(value));
    });

    document.getElementById('triGravityCheckbox').addEventListener('change', (e) => {
        if(typeof setGravityEnabled === 'function') setGravityEnabled(e.target.checked);
    });

    // Connexion toolbar
    document.getElementById('playBtn').addEventListener('click', startSim);
    document.getElementById('pauseBtn').addEventListener('click', stopSim);
    document.getElementById('resetBtn').addEventListener('click', resetSim);
    document.getElementById('recordBtn').addEventListener('click', toggleRecord);

    // Initialiser les valeurs au chargement
    window.addEventListener('load', () => {
        document.getElementById('gapSlider').dispatchEvent(new Event('input'));
        document.getElementById('speedSlider').dispatchEvent(new Event('input'));
        document.getElementById('volumeSlider').dispatchEvent(new Event('input'));
        document.getElementById('triGapSlider').dispatchEvent(new Event('input'));
        document.getElementById('triSpeedSlider').dispatchEvent(new Event('input'));
    });
</script>
</body>
</html>
