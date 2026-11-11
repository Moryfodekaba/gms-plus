# GMS PLUS — Application web PHP/MySQL

Starter fonctionnel pour le site public et son administration.

## Prérequis
- PHP 8.1+ (PHP 8.3 recommandé), extensions PDO et pdo_mysql
- MySQL 8+
- Apache (XAMPP convient)

## Installation avec XAMPP
1. Décompresser `GMS-PLUS` dans `C:\xampp\htdocs\`.
2. Démarrer Apache et MySQL.
3. Ouvrir phpMyAdmin et importer `database/gms_plus_db.sql`.
4. Vérifier les paramètres dans `config/config.php`.
5. Ouvrir `http://localhost/GMS-PLUS/public/`.
6. Administration : `http://localhost/GMS-PLUS/public/admin/login.php`

## Identifiants initiaux
- Email : `admin@gmsplus.local`
- Mot de passe : `ChangeMe123!`

Changez immédiatement le mot de passe après la première connexion. En production, utilisez HTTPS, une vraie adresse email, des sauvegardes hors serveur et placez les fichiers sensibles hors de la racine web.

## Modules livrés dans cette première version
- Site public responsive (Accueil, À propos, Transport, Sécurité, Flotte, Contact)
- Connexion administrateur avec mot de passe haché
- Tableau de bord
- Gestion des textes principaux du site (CMS simple)
- Gestion des services
- Gestion des véhicules
- Consultation et changement de statut des demandes de devis
- Protection CSRF, requêtes PDO préparées, échappement HTML et validation élémentaire

Cette base est un MVP extensible, pas encore un ERP complet. Les modules contrats, facturation, planning de missions, paie, gestion avancée des agents, permissions granulaires, médias vidéo, multilingue et notifications SMS/e-mail devront être développés et testés avant une utilisation opérationnelle.
