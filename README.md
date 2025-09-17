# Dot-Creator

Dot-Creator est une application Laravel permettant aux utilisateurs de créer un compte, se connecter et gérer leurs créations de "balle rebondissante" (animation satisfaisante).  
Le projet utilise **Laravel Jetstream** avec **Livewire**, ainsi qu’une base de données MySQL.

---

## 🚀 Prérequis

Avant d’installer le projet, assurez-vous d’avoir :

- [PHP >= 8.2](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [Node.js + NPM](https://nodejs.org/)
- Une base de données **MySQL** (instancier en local via **Docker**, **Wamp**, ou **Herd**...)

### Exemple rapide avec Docker :
```bash
docker run --name dot-creator-mysql \
  -e MYSQL_ROOT_PASSWORD=root \
  -e MYSQL_DATABASE=dot_creator \
  -p 3307:3306 \
  -d mysql:8

```
⸻

## 📥 Installation du projet

Clonez le dépôt et installez les dépendances :
```bash
git clone https://github.com/votre-organisation/dot-creator.git
cd dot-creator
```

# Installer les dépendances PHP
```bash
composer install
```

# Installer les dépendances front
```bash
npm install
```

⸻

⚙️ Configuration

Configurez la base de données dans .env :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3309
DB_DATABASE=dot-creator-database
DB_USERNAME=root
DB_PASSWORD=root
```

⸻

🗄️ Migration de la base de données

Exécutez les migrations pour créer les tables nécessaires :
```bash
php artisan migrate
```

⸻

🎨 Compilation des assets

Pour lancer le serveur de développement front :
```bash
npm run dev
```

⸻

▶️ Lancer l’application

```bash
php artisan serve
```

Accessible par défaut sur http://127.0.0.1:8000

⸻

### 👤 Comptes & rôles

Par défaut, Jetstream installe l’authentification avec email et mot de passe.
Il est possible de créer des rôles (admin, premium, etc.) via les futures migrations/seeders.

⸻

### 🌍 Multilingue

Le projet est prévu pour supporter plusieurs langues (français, anglais, espagnol, italien, allemand).
Les fichiers de traduction se trouvent dans le dossier lang/.

⸻

### ✅ Vérification rapide après installation
- Accéder à la page d’accueil du site vitrine
- Créer un compte utilisateur via l’interface Jetstream
- Se connecter et vérifier l’accès au dashboard

⸻

### 🛠️ Outils utiles
- Herd : https://herd.laravel.com/
- Docker Desktop : https://www.docker.com/products/docker-desktop
- WampServer : https://www.wampserver.com/

⸻

### 📌 Notes
- Si vous utilisez Docker, exposez MySQL sur un port non utilisé (ex: 3307) pour éviter les conflits.
- Le projet sera étendu pour intégrer des rôles avancés (admin, premium, etc.).
- Les animations seront gérées séparément par le collaborateur, mais les données (projets, versions, etc.) seront stockées dans cette application.

