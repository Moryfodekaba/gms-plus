# GMS Plus — Globale Multi-Service Plus
Site web professionnel complet (PHP + MySQL + panneau d'administration), compatible **XAMPP**.

## 📦 Contenu du projet
- Site public : accueil, à propos, services, flotte, réalisations, actualités, contact
- Formulaires fonctionnels : demande de devis, contact, inscription newsletter (enregistrés en base de données)
- Panneau d'administration complet : gestion des devis, messages, services, actualités, newsletter
- Base de données MySQL prête à l'emploi (`database.sql`) avec données de démonstration

## 🚀 Installation avec XAMPP

1. **Installez XAMPP** (si ce n'est pas déjà fait) : https://www.apachefriends.org
2. **Copiez le dossier** `gms-plus` dans le répertoire `htdocs` de votre installation XAMPP :
   - Windows : `C:\xampp\htdocs\gms-plus`
   - macOS : `/Applications/XAMPP/htdocs/gms-plus`
   - Linux : `/opt/lampp/htdocs/gms-plus`
3. **Démarrez Apache et MySQL** depuis le panneau de contrôle XAMPP.
4. **Créez la base de données** :
   - Ouvrez http://localhost/phpmyadmin
   - Cliquez sur "Importer"
   - Sélectionnez le fichier `database.sql` fourni à la racine du projet
   - Cliquez sur "Exécuter" (cela crée automatiquement la base `gms_plus` et toutes les tables avec des données de démonstration)
5. **Créez votre compte administrateur** :
   - Rendez-vous sur http://localhost/gms-plus/setup.php
   - Remplissez le formulaire (nom d'utilisateur, e-mail, mot de passe)
   - Ce script ne peut être utilisé qu'une seule fois (protection intégrée)
6. **Accédez au site** : http://localhost/gms-plus/
7. **Accédez au panneau admin** : http://localhost/gms-plus/admin/login.php

## ⚙️ Configuration de la base de données
Le fichier `config/database.php` utilise les identifiants par défaut de XAMPP :
```php
DB_HOST = localhost
DB_NAME = gms_plus
DB_USER = root
DB_PASS = (vide)
```
Si votre MySQL utilise un autre utilisateur/mot de passe, modifiez ce fichier.

## 🗂️ Structure du projet
```
gms-plus/
├── admin/                  → Panneau d'administration
│   ├── includes/            (auth, header, footer admin)
│   ├── login.php / logout.php
│   ├── dashboard.php        (tableau de bord + statistiques)
│   ├── devis.php            (gestion des demandes de devis)
│   ├── messages.php         (gestion des messages de contact)
│   ├── services.php         (CRUD des services)
│   ├── actualites.php       (CRUD des actualités)
│   └── newsletter.php       (liste des abonnés)
├── assets/
│   ├── css/style.css
│   ├── js/main.js
│   └── images/              (visuels du site — à remplacer par vos propres photos)
├── config/database.php      → Connexion PDO à MySQL
├── includes/
│   ├── functions.php        → Fonctions PHP réutilisables
│   ├── header.php / footer.php
├── index.php, a-propos.php, nos-services.php, notre-flotte.php,
│   realisations.php, actualites.php, actualite-detail.php, contact.php
├── traitement_devis.php     → Traitement AJAX du formulaire de devis
├── traitement_contact.php   → Traitement AJAX du formulaire de contact
├── traitement_newsletter.php→ Traitement AJAX de l'inscription newsletter
├── setup.php                → Création du 1er compte admin (à usage unique)
└── database.sql             → Script SQL complet (structure + données de démo)
```

## 🖼️ Remplacer les images
Des images de démonstration (fond bleu marine avec texte) sont fournies dans `assets/images/` pour que le site soit fonctionnel dès l'installation. Remplacez-les par vos propres photos en conservant **exactement les mêmes noms de fichiers**, ou modifiez les chemins d'images depuis le panneau d'administration (Services / Actualités) ou directement en base de données (table `flotte`, `realisations`, `partenaires`).

## 🔐 Sécurité
- Mots de passe admin hachés avec `password_hash()` (bcrypt)
- Requêtes SQL préparées (PDO) contre les injections SQL
- Échappement systématique des sorties HTML (`htmlspecialchars`) contre les failles XSS
- Le fichier `setup.php` se désactive automatiquement dès qu'un compte admin existe (vous pouvez le supprimer après la première utilisation, par sécurité)

## 📋 Boutons et fonctionnalités de la maquette, tous implémentés
- "Nos services" / "Demander un devis" (hero) → ancres et formulaire fonctionnels
- "En savoir plus" (cartes services) → page détail service
- "Découvrir l'entreprise" → page À propos
- Formulaire "Demander un devis" → enregistré en base + visible dans l'admin
- Formulaire newsletter (footer) → enregistré en base + visible dans l'admin
- Navigation complète (Accueil, À propos, Nos services, Notre flotte, Réalisations, Actualités, Contact)
- Réseaux sociaux, téléphone et e-mail cliquables (haut de page et pied de page)

Bon développement avec GMS Plus 🚛
