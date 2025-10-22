# 👋 Hey Antoine ! Guide du Simulateur dans Dot Creator

Salut mec ! Alors voilà, j'ai intégré ton simulateur de balles rebondissantes dans mon app Laravel. Ce fichier va t'expliquer comment tout ça fonctionne et où retrouver ton code.

## 🎯 C'est quoi Dot Creator ?

Dot Creator c'est mon app Laravel où les utilisateurs pourront créer et télécharger des vidéos de balles rebondissantes (ton simulateur) avec un système de crédits, d'authentification, etc.

## 📁 Où est mon code ?

Ton code original (HTML/JS/p5.js) a été intégré dans **un seul fichier** Laravel :
```
resources/views/video-simulator.blade.php
```

### C'est quoi un fichier `.blade.php` ?

C'est juste du HTML normal, mais avec la possibilité d'utiliser des trucs Laravel comme :
- `{{ asset('chemin/fichier.png') }}` → pour charger des images
- `{{ route('nom-route') }}` → pour générer des URLs
- `{{ csrf_token() }}` → pour la sécurité

**En gros, c'est ton `index.html` avec quelques ajouts Laravel.**

## 🗂️ Structure de ton code dans le fichier

Le fichier `video-simulator.blade.php` contient (dans l'ordre) :

1. **Le `<head>`** avec :
    - Le chargement de p5.js (CDN)
    - Le token CSRF pour la sécurité Laravel

2. **Tout le CSS** (celui de ton `index.html`)
    - Styles de la toolbar
    - Styles de la sidebar
    - Responsive, etc.

3. **Le HTML** (toolbar + sidebar)
    - Tes boutons play/pause/rec/reset
    - Les sliders, checkbox, color pickers
    - Les deux onglets Cercle/Polygone

4. **Ton code p5.js** (celui de `sketch.js`)
    - Variables globales
    - `setup()`, `draw()`
    - Physique, collision, audio
    - **Sauf** la fonction `saveRecordingMP4()` qui a été adaptée

5. **Le code de connexion UI** (le script inline de ton `index.html`)
    - Les `addEventListener` pour connecter les sliders aux fonctions
    - Les fonctions `switchTab()`, etc.

## 🎨 Où sont mes icônes ?

Elles sont dans :
```
public/video-simulator/icones/
├── play.png
├── pause.png
├── rec.png
└── reset.png
```

Ces fichiers sont accessibles via Laravel avec : `{{ asset('video-simulator/icones/play.png') }}`

## ⚙️ Comment ça marche maintenant ?

### Avant (ton projet original)
```
1. Navigateur → index.html
2. sketch.js → enregistrement WebM
3. POST vers serveur Node.js (server.js)
4. FFmpeg convertit WebM → MP4
5. Téléchargement du MP4
```

### Maintenant (dans Dot Creator)
```
1. Navigateur → /video-simulator (route Laravel)
2. Laravel affiche video-simulator.blade.php
3. sketch.js → enregistrement WebM
4. POST vers /api/convert-webm (route Laravel)
5. VideoConverterController utilise FFmpeg PHP
6. FFmpeg convertit WebM → MP4
7. Téléchargement du MP4
```

**Différence** : Au lieu d'un serveur Node.js séparé, la conversion se fait directement dans Laravel avec le même FFmpeg.

## 🔧 Qu'est-ce qui a changé dans ton code ?

### 1. La fonction `saveRecordingMP4()`

**Avant** (ton code) :
```javascript
const response = await fetch('http://localhost:5500/convert-webm', {
  method: 'POST',
  body: formData
});
```

**Maintenant** :
```javascript
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

const response = await fetch('{{ route('api.convert-webm') }}', {
  method: 'POST',
  headers: {
    'X-CSRF-TOKEN': csrfToken  // ← Sécurité Laravel
  },
  body: formData,
  credentials: 'same-origin'
});
```

**Pourquoi ?**
- Laravel a besoin d'un token CSRF pour la sécurité
- L'URL est générée dynamiquement par Laravel

### 2. Les chemins des icônes

**Avant** :
```html
<img src="icones/play.png">
```

**Maintenant** :
```html
<img src="{{ asset('video-simulator/icones/play.png') }}">
```

**Pourquoi ?**
- Laravel gère les chemins publics différemment
- `asset()` génère le bon chemin peu importe l'environnement

## 🚀 Comment tester mes modifications ?

### En local
```bash
# 1. Lance Laravel
cd dot-creator
php artisan serve

# 2. Ouvre ton navigateur
http://localhost:8000/video-simulator

# 3. Ou connecte-toi et va dans Dashboard → Créer ma vidéo
```

Tu devrais voir ton interface !

### En production

Quand Hippolyte déploie sur OVH :
1. Il push sur GitHub
2. Plesk clone le repo
3. Laravel compile tout automatiquement
4. Ton interface est dispo dans l'app

**Pas de serveur Node.js à gérer !** FFmpeg est déjà installé sur le serveur.

## 🛠️ Je veux modifier mon code

### Option 1 : Modifier directement le fichier Blade

Édite `resources/views/video-simulator.blade.php` et modifie :
- Le CSS dans `<style>`
- Le HTML dans `<body>`
- Le JS dans `<script>`

**Attention** :
- Ne touche pas aux `{{ ... }}` Laravel
- Ne touche pas à la fonction `saveRecordingMP4()` modifiée
- Ne touche pas au `<meta name="csrf-token">`

### Option 2 : Travailler sur ton projet original et synchroniser

Si tu préfères bosser sur ton projet original :
```bash
# Dans ton projet original (~/Dotcreator)
# Fais tes modifs dans index.html et sketch.js

# Puis synchronise
cd ~/Dotcreator
# Copie le contenu de index.html → resources/views/video-simulator.blade.php
# (en gardant les trucs Laravel)

# Copie les icônes si tu en as ajouté
cp -r icones/* ~/dot-creator/public/video-simulator/icones/
```

## 🐛 Problèmes courants

### "La conversion échoue"

→ Vérifier que FFmpeg est installé :
```bash
which ffmpeg
# Doit afficher : /usr/bin/ffmpeg
```

### "L'interface ne charge pas"

→ Vérifier que le fichier existe :
```bash
ls resources/views/video-simulator.blade.php
```

→ Vérifier que les icônes sont là :
```bash
ls public/video-simulator/icones/
```

### "Les fonctions sketch.js ne sont pas trouvées"

→ S'assurer que toutes les fonctions utilisées par l'UI sont bien exposées sur `window` :
```javascript
window.setGapDegrees = setGapDegrees;
window.startSim = startSim;
// etc.
```

## 📝 Checklist quand je modifie

- [ ] J'ai testé en local avec `php artisan serve`
- [ ] L'enregistrement fonctionne
- [ ] La conversion MP4 fonctionne
- [ ] Les sliders/contrôles répondent
- [ ] Pas d'erreurs dans la console (F12)
- [ ] Les icônes s'affichent
- [ ] Le son marche (si activé)

## 💬 Questions ?

Ping Hippolyte sur WhatsApp/Discord ! Il gère la partie Laravel, toi tu gères la partie p5.js/physique/interface.

**Division du travail** :
- **Toi** : Interface, physique, p5.js, design
- **Hippolyte** : Auth, crédits, base de données, déploiement

Bonne chance mec ! 🚀

---

*PS : Si tu veux ajouter des features (nouveaux modes, nouvelles formes, etc.), vas-y à fond ! Juste garde la fonction `saveRecordingMP4()` telle quelle pour que la conversion Laravel marche.*
