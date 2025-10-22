# 👋 Hey Antoine ! Guide du Simulateur dans Dot Creator

Salut mec ! Ton simulateur de balles rebondissantes a été intégré dans l'app Laravel d'Hippolyte. Ce doc va t'expliquer comment tout ça marche et où retrouver ton code.

---

## 📚 C'est quoi Laravel ? (version ultra simple)

**Laravel = Framework PHP pour faire des sites web**

Imagine Laravel comme une **grosse boîte à outils** qui gère :
- 🔐 **Authentification** : Connexion/déconnexion des utilisateurs
- 🗄️ **Base de données** : Stockage des infos (users, crédits, vidéos, etc.)
- 🛣️ **Routes** : Les URLs du site (`/dashboard`, `/video-simulator`, etc.)
- 👀 **Vues** : Les pages HTML (fichiers `.blade.php` = HTML + PHP)
- 🎨 **Assets publics** : Images, CSS, JS dans le dossier `public/`

**En gros** : Laravel c'est le moteur qui fait tourner toute l'app, et ton simulateur est une page de cette app.

---

## 🏗️ Architecture globale du projet

```
dot-creator/
├── app/                              ← Code PHP (logique métier)
│   └── Http/Controllers/
│       └── VideoConverterController.php  ← Conversion WebM → MP4
├── public/                           ← Fichiers accessibles publiquement
│   └── video-simulator/
│       └── icones/                   ← TES icônes (play, pause, rec, reset)
│           ├── play.png
│           ├── pause.png
│           ├── rec.png
│           └── reset.png
├── resources/views/                  ← Pages HTML (templates Blade)
│   └── video-simulator.blade.php     ← TON CODE (HTML + CSS + JS)
└── routes/
    └── web.php                       ← Définition des URLs
```

---

## 📁 Où est mon code ?

### 1. **Ton code principal** (HTML + CSS + JS + p5.js)

**Fichier** : `resources/views/video-simulator.blade.php`

Ce fichier contient **TOUT** ton code original dans un seul fichier :
- Le `<head>` avec le chargement de p5.js
- Le CSS (toolbar, sidebar, responsive)
- Le HTML (toolbar + sidebar + canvas container)
- **TOUT** le code de `sketch.js` (setup, draw, physique, audio, etc.)
- Le code de connexion UI (event listeners sur les sliders)

**En gros** : C'est ton `index.html` + `sketch.js` fusionnés ensemble, avec quelques ajouts Laravel.

### 2. **Tes icônes**

**Dossier** : `public/video-simulator/icones/`

Les 4 PNG de ta toolbar :
- `play.png`
- `pause.png`
- `rec.png`
- `reset.png`

---

## 🔀 Comment ton projet original a été transformé

### Ton projet original (standalone)

```
Dotcreator/
├── index.html        ← Interface + toolbar + sidebar
├── sketch.js         ← Code p5.js (physique, animation, audio)
├── server.js         ← Serveur Node.js pour conversion WebM → MP4
└── icones/           ← Assets graphiques
```

### Dans Dot Creator (Laravel)

Tout a été **fusionné dans un seul fichier Blade** :

```blade
resources/views/video-simulator.blade.php
├─ <head>
│   ├─ Chargement p5.js (CDN)
│   └─ Token CSRF Laravel {{ csrf_token() }}
├─ <style>
│   └─ Tout ton CSS (toolbar, sidebar, etc.)
├─ <body>
│   ├─ <div id="canvas-container"></div>  ← p5.js crée le canvas ici
│   ├─ Toolbar (4 boutons avec tes icônes)
│   ├─ Sidebar (sliders, checkbox, onglets)
│   ├─ <script> TOUT ton code sketch.js </script>
│   └─ <script> Connexion des event listeners UI </script>
```

**Ce qui a changé** :
1. Les chemins des icônes utilisent `{{ asset() }}` Laravel
2. La fonction `saveRecordingMP4()` appelle Laravel au lieu de Node.js
3. Token CSRF ajouté pour la sécurité Laravel

**Ce qui n'a PAS changé** :
- Toute ta physique, ta logique, tes animations
- Les fonctions p5.js (setup, draw, etc.)
- L'interface UI (toolbar + sidebar)
- Les contrôles et les sliders

---

## 🎬 Comment ça marche dans l'app ?

### Schéma du flux

```
1. User connecté clique sur "Créer ma vidéo"
   ↓
2. Laravel charge la page VideoCreator
   ↓
3. Cette page contient une <iframe> qui pointe vers /video-simulator
   ↓
4. Laravel affiche video-simulator.blade.php (ton code)
   ↓
5. p5.js démarre, crée le canvas, lance setup() puis draw()
   ↓
6. User joue avec les sliders, clique sur Play, etc.
   ↓
7. User clique sur REC → enregistrement WebM
   ↓
8. User clique à nouveau → arrêt de l'enregistrement
   ↓
9. Le WebM est envoyé à Laravel via POST /api/convert-webm
   ↓
10. Laravel utilise FFmpeg PHP pour convertir en MP4
   ↓
11. Le MP4 est renvoyé au navigateur et téléchargé
```

### Conversion vidéo : Avant vs Maintenant

**AVANT (ton projet original)** :
```
Browser → Enregistrement WebM
    ↓
POST vers serveur Node.js (localhost:5500)
    ↓
server.js utilise FFmpeg (ffmpeg-static)
    ↓
Retour du MP4 → Téléchargement
```

**MAINTENANT (dans Laravel)** :
```
Browser → Enregistrement WebM
    ↓
POST vers Laravel (/api/convert-webm)
    ↓
VideoConverterController utilise FFmpeg PHP
    ↓
Retour du MP4 → Téléchargement
```

**Différence** : Plus besoin de serveur Node.js ! Laravel fait tout.

---

## 🛠️ Comment modifier mon code ?

### Méthode 1 : Éditer directement le fichier Blade (RECOMMANDÉ)

```bash
# Ouvre le fichier dans ton éditeur
code resources/views/video-simulator.blade.php
```

**Zones à modifier** :

**1. CSS** (styles) :
```html
<style>
    /* Modifie les couleurs, tailles, animations, etc. */
    #toolbar { ... }
    #sidebar { ... }
</style>
```

**2. HTML** (structure) :
```html
<div id="sidebar">
    <!-- Ajouter/modifier des sliders, boutons, etc. -->
</div>
```

**3. JavaScript p5.js** (physique, animation) :
```html
<script>
    // Ton code sketch.js est ici
    function setup() { ... }
    function draw() { ... }
    class Ball { ... }
    // etc.
</script>
```

**⚠️ NE TOUCHE PAS À** :
- `{{ csrf_token() }}` → Sécurité Laravel
- `{{ asset('video-simulator/icones/play.png') }}` → Chemins Laravel
- `{{ route('api.convert-webm') }}` → URL générée par Laravel
- La fonction `saveRecordingMP4()` modifiée → Conversion Laravel

### Méthode 2 : Travailler sur ton projet original et synchroniser

Si tu préfères bosser sur ton projet original :

```bash
# 1. Fais tes modifs dans ~/Dotcreator/sketch.js
code ~/Dotcreator/sketch.js

# 2. Copie ton code modifié dans le fichier Blade
# (copie juste la partie JavaScript, pas le HTML complet)

# 3. Ouvre le fichier Blade et remplace ton code sketch.js
code ~/dot-creator/resources/views/video-simulator.blade.php
```

---

## 🧪 Comment tester mes modifications ?

### En local (sur ta machine)

```bash
# 1. Lance le serveur Laravel
cd ~/dot-creator
php artisan serve

# 2. Ouvre ton navigateur
http://localhost:8000/video-simulator

# 3. Ouvre la console (F12) pour voir les logs
```

**Tu devrais voir** :
- Le canvas avec le cercle/triangle
- La toolbar en bas à gauche
- La sidebar à droite
- Les logs `✅ Setup terminé`

### En production (sur le serveur d'Hippolyte)

```bash
# 1. Commit tes changements
git add resources/views/video-simulator.blade.php
git commit -m "Update simulator: added new feature"
git push

# 2. Hippolyte déploie (ou via Plesk)
# Le site se met à jour automatiquement

# 3. Teste sur
https://dot-creator.dhippo.fr/video-simulator
```

---

## 🎨 Ajouter de nouvelles features

### Exemple : Ajouter un nouveau slider

**1. Ajoute le HTML dans la sidebar** :

```html
<div class="control-group">
    <label>
        Ma nouvelle feature
        <span class="value-display" id="myFeatureValue">50</span>
    </label>
    <input type="range" id="myFeatureSlider" min="0" max="100" value="50">
</div>
```

**2. Ajoute la variable globale dans le code p5.js** :

```javascript
let myFeatureValue = 50;
```

**3. Crée la fonction setter** :

```javascript
function setMyFeature(value) {
    myFeatureValue = value;
    // Applique la logique ici
}
window.setMyFeature = setMyFeature; // ← Important !
```

**4. Connecte le slider** :

```javascript
document.getElementById('myFeatureSlider').addEventListener('input', (e) => {
    const value = e.target.value;
    document.getElementById('myFeatureValue').textContent = value;
    if(typeof setMyFeature === 'function') setMyFeature(parseFloat(value));
});
```

**5. Utilise-la dans `draw()` ou ailleurs** :

```javascript
function draw() {
    // ...
    if(myFeatureValue > 50) {
        // Fait un truc cool
    }
}
```

---

## 🐛 Troubleshooting (problèmes courants)

### L'animation ne s'affiche pas

**Vérifie** :
1. Console (F12) : Y a-t-il des erreurs ?
2. `typeof p5` → doit être `"function"`
3. `typeof setup` → doit être `"function"`
4. `document.querySelector('canvas')` → doit retourner un `<canvas>`

**Solution** : p5.js ne se charge pas ou le code sketch.js n'est pas dans le fichier.

### Les sliders ne font rien

**Vérifie** :
1. Les fonctions sont bien exposées sur `window` : `window.setRotationSpeed = setRotationSpeed`
2. Les event listeners sont bien connectés dans le dernier `<script>`
3. Console : Tape `typeof setRotationSpeed` → doit être `"function"`

### Les icônes ne s'affichent pas

**Vérifie** :
1. Elles sont bien dans `public/video-simulator/icones/`
2. Les chemins utilisent `{{ asset() }}` Laravel
3. Permissions : `chmod 644 public/video-simulator/icones/*`

### La conversion MP4 échoue

**Causes possibles** :
1. FFmpeg pas installé sur le serveur
2. La route `/api/convert-webm` ne fonctionne pas
3. Problème de permissions

**Fallback** : Le code télécharge en WebM si la conversion échoue.

---

## 📝 Checklist avant de push

Avant de commit/push tes changements :

- [ ] ✅ Testé en local (`php artisan serve`)
- [ ] ✅ L'animation fonctionne
- [ ] ✅ Les sliders répondent
- [ ] ✅ Pas d'erreurs dans la console (F12)
- [ ] ✅ L'enregistrement fonctionne (même en WebM c'est OK)
- [ ] ✅ Les icônes s'affichent
- [ ] ✅ Pas touché aux trucs Laravel (`{{ }}`, CSRF, routes)

---

## 💬 Questions fréquentes

**Q : Je peux modifier le CSS ?**  
R : Oui ! Tout le CSS est dans le `<style>` du fichier Blade. Fais-toi plaisir.

**Q : Je peux ajouter de nouvelles formes (hexagone, étoile, etc.) ?**  
R : Carrément ! C'est ton code p5.js, tu fais ce que tu veux.

**Q : Je dois connaître Laravel pour modifier le simulateur ?**  
R : Non. Tant que tu ne touches pas aux `{{ }}`, tu peux coder comme dans ton projet original.

**Q : Comment je sais si mon code marche en prod ?**  
R : Va sur `https://dot-creator.dhippo.fr/video-simulator` après le push. Si ça marche là, ça marche partout.

**Q : La conversion MP4 est obligatoire ?**  
R : Non. Si ça échoue, le code télécharge en WebM. C'est un fallback.

**Q : Je peux ajouter des libs JS (Three.js, etc.) ?**  
R : Oui ! Ajoute-les via CDN dans le `<head>` :
```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
```

---

## 🚀 Résumé express

**Ton code** : `resources/views/video-simulator.blade.php`  
**Tes icônes** : `public/video-simulator/icones/`  
**Tester local** : `php artisan serve` → `http://localhost:8000/video-simulator`  
**Tester prod** : `https://dot-creator.dhippo.fr/video-simulator`

**Division du travail** :
- **Toi** : Simulateur, physique, p5.js, interface, animations
- **Hippolyte** : Auth, dashboard, crédits, base de données, déploiement

**Workflow** :
1. Modifie `video-simulator.blade.php`
2. Teste en local
3. Commit + push
4. Hippolyte déploie
5. Profit ! 🎉

---

## 📞 Contact

**Des questions ?** → Ping Hippolyte sur WhatsApp/Discord

**Trouve un bug ?** → Dis-lui, il gère la partie Laravel

**Feature request ?** → Vas-y à fond, c'est ton code !

---

Bon code mec ! 🚀✨

---

*PS : Si tu veux ajouter des trucs de fou (particules, explosions, modes de jeu, etc.), lance-toi ! Le seul truc, garde juste la fonction `saveRecordingMP4()` telle quelle pour que la conversion Laravel marche.*
