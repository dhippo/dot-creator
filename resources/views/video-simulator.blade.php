<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Video Simulator - Dot Creator</title>

    <!-- p5.js depuis CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.7.0/p5.min.js"></script>

    <!-- CSS externe -->
    <link rel="stylesheet" href="{{ asset('video-simulator/css/styles.css') }}">
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

<!-- Scripts externes -->
<script src="{{ asset('video-simulator/js/config.js') }}"></script>
<script>
    // Injection des variables Laravel
    window.VideoSimulator = window.VideoSimulator || {};
    window.VideoSimulator.convertUrl = '{{ route("api.convert-webm") }}';
    window.VideoSimulator.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
</script>
<script src="{{ asset('video-simulator/js/sketch.js') }}"></script>
<script src="{{ asset('video-simulator/js/ui.js') }}"></script>
</body>
</html>
