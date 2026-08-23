-- ============================================================
-- GMS PLUS - Global Multi-Service Plus
-- Base de données MySQL (compatible XAMPP / phpMyAdmin)
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
DROP DATABASE IF EXISTS gms_plus;
CREATE DATABASE gms_plus CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gms_plus;

-- ------------------------------------------------------------
-- Table : admin_users (connexion au panneau d'administration)
-- ------------------------------------------------------------
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL,
    role ENUM('super_admin','admin') DEFAULT 'admin',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    derniere_connexion DATETIME NULL
) ENGINE=InnoDB;

-- IMPORTANT : aucun compte admin n'est créé ici.
-- Après avoir importé cette base, ouvrez http://localhost/gms-plus/setup.php
-- dans votre navigateur pour créer votre compte administrateur en toute sécurité
-- (le mot de passe sera haché automatiquement par PHP).

-- ------------------------------------------------------------
-- Table : services
-- ------------------------------------------------------------
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    slug VARCHAR(160) NOT NULL UNIQUE,
    description_courte VARCHAR(300),
    description_longue TEXT,
    icone VARCHAR(50) DEFAULT 'fa-truck',
    image VARCHAR(255),
    ordre_affichage INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO services (titre, slug, description_courte, description_longue, icone, image, ordre_affichage) VALUES
('Transport Camion Plateau', 'transport-camion-plateau', 'Transport de marchandises générales, machines, matériaux de construction et autres produits en toute sécurité.', 'Nos camions plateaux assurent le transport sécurisé de marchandises générales, de machines industrielles, de matériaux de construction et de tout type de produits, partout en Guinée et dans la sous-région.', 'fa-truck', 'assets/images/service-plateau.jpg', 1),
('Transport Port-Char', 'transport-port-char', 'Transport d\'engins lourds, véhicules industriels et matériels spéciaux sur remorque porte-engins.', 'Grâce à notre flotte de porte-chars, nous transportons vos engins de chantier, véhicules lourds et équipements industriels avec un maximum de sécurité et de professionnalisme.', 'fa-trailer', 'assets/images/service-portchar.jpg', 2),
('Transport Logistique', 'transport-logistique', 'Solutions logistiques complètes et sur mesure pour optimiser votre chaîne d\'approvisionnement.', 'Nous concevons des solutions logistiques intégrées : gestion d\'entrepôt, planification des livraisons, suivi en temps réel et optimisation de votre chaîne d\'approvisionnement.', 'fa-boxes', 'assets/images/service-logistique.jpg', 3),
('Transport National & International', 'transport-national-international', 'Couverture nationale et sous-régionale pour tous vos besoins de transport.', 'GMS Plus couvre l\'ensemble du territoire guinéen ainsi que les pays de la sous-région ouest-africaine pour répondre à tous vos besoins de transport national et international.', 'fa-globe-africa', 'assets/images/service-international.jpg', 4);

-- ------------------------------------------------------------
-- Table : flotte (véhicules)
-- ------------------------------------------------------------
CREATE TABLE flotte (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    type_vehicule VARCHAR(100),
    capacite VARCHAR(100),
    marque VARCHAR(100),
    image VARCHAR(255),
    description TEXT,
    disponible TINYINT(1) DEFAULT 1,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO flotte (nom, type_vehicule, capacite, marque, image, description) VALUES
('Camion Plateau ASTRA 01', 'Camion Plateau', '20 tonnes', 'Astra', 'assets/images/flotte-1.jpg', 'Camion plateau robuste pour le transport de marchandises générales.'),
('Porte-Char Lourd 02', 'Porte-Char', '40 tonnes', 'Astra', 'assets/images/flotte-2.jpg', 'Remorque porte-engins pour le transport de véhicules et engins lourds.'),
('Camion Conteneur 03', 'Transport Conteneur', '30 tonnes', 'Iveco', 'assets/images/flotte-3.jpg', 'Camion spécialisé dans le transport de conteneurs maritimes.');

-- ------------------------------------------------------------
-- Table : realisations (projets réalisés)
-- ------------------------------------------------------------
CREATE TABLE realisations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    client VARCHAR(150),
    description TEXT,
    image VARCHAR(255),
    date_realisation DATE,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO realisations (titre, client, description, image, date_realisation) VALUES
('Transport d\'engins miniers', 'SMB - Société Minière de Boké', 'Transport sécurisé d\'engins lourds vers le site minier de Boké.', 'assets/images/realisation-1.jpg', '2025-11-10'),
('Livraison de matériaux de construction', 'Ciments de Guinée', 'Livraison de plus de 500 tonnes de ciment sur plusieurs chantiers.', 'assets/images/realisation-2.jpg', '2025-09-22'),
('Transport de conteneurs portuaires', 'Bolloré Transport & Logistics', 'Acheminement de conteneurs du port de Conakry vers l\'intérieur du pays.', 'assets/images/realisation-3.jpg', '2025-07-05');

-- ------------------------------------------------------------
-- Table : partenaires (clients / logos "Ils nous font confiance")
-- ------------------------------------------------------------
CREATE TABLE partenaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    logo VARCHAR(255),
    ordre_affichage INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

INSERT INTO partenaires (nom, logo, ordre_affichage) VALUES
('SMB - Société Minière de Boké', 'assets/images/partner-smb.png', 1),
('CBG - Compagnie des Bauxites de Guinée', 'assets/images/partner-cbg.png', 2),
('SOGUIPAMI', 'assets/images/partner-soguipami.png', 3),
('Guitrans Transport & Logistique', 'assets/images/partner-guitrans.png', 4),
('Bolloré Transport & Logistics', 'assets/images/partner-bollore.png', 5),
('Ciments de Guinée', 'assets/images/partner-ciments.png', 6);

-- ------------------------------------------------------------
-- Table : actualites (news / blog)
-- ------------------------------------------------------------
CREATE TABLE actualites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    slug VARCHAR(220) NOT NULL UNIQUE,
    extrait VARCHAR(400),
    contenu TEXT,
    image VARCHAR(255),
    auteur VARCHAR(100) DEFAULT 'GMS Plus',
    publie TINYINT(1) DEFAULT 1,
    date_publication DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO actualites (titre, slug, extrait, contenu, image, date_publication) VALUES
('GMS Plus renforce sa flotte de camions plateaux', 'gms-plus-renforce-flotte-camions-plateaux', 'Notre entreprise investit dans de nouveaux véhicules pour mieux servir ses clients.', 'GMS Plus poursuit son développement en Guinée avec l\'acquisition de nouveaux camions plateaux, permettant d\'augmenter notre capacité de transport et de réduire les délais de livraison pour nos clients partout dans le pays.', 'assets/images/actu-1.jpg', '2026-06-01 09:00:00'),
('Nouveau partenariat avec Bolloré Transport & Logistics', 'nouveau-partenariat-bollore', 'GMS Plus signe un accord stratégique pour le transport de conteneurs.', 'Dans le cadre de son développement, GMS Plus a signé un partenariat avec Bolloré Transport & Logistics pour assurer le transport de conteneurs entre le port de Conakry et les régions de l\'intérieur.', 'assets/images/actu-2.jpg', '2026-05-15 09:00:00');

-- ------------------------------------------------------------
-- Table : demandes_devis (formulaire "Demander un devis")
-- ------------------------------------------------------------
CREATE TABLE demandes_devis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(50) NOT NULL,
    type_service VARCHAR(150),
    message TEXT,
    statut ENUM('nouveau','en_cours','traite','annule') DEFAULT 'nouveau',
    date_demande DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table : messages_contact (formulaire de contact)
-- ------------------------------------------------------------
CREATE TABLE messages_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(50),
    sujet VARCHAR(200),
    message TEXT NOT NULL,
    lu TINYINT(1) DEFAULT 0,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table : newsletter
-- ------------------------------------------------------------
CREATE TABLE newsletter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    actif TINYINT(1) DEFAULT 1
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Table : statistiques (chiffres clés affichés sur le site)
-- ------------------------------------------------------------
CREATE TABLE statistiques (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(150) NOT NULL,
    valeur VARCHAR(50) NOT NULL,
    icone VARCHAR(50) DEFAULT 'fa-truck',
    ordre_affichage INT DEFAULT 0
) ENGINE=InnoDB;

INSERT INTO statistiques (libelle, valeur, icone, ordre_affichage) VALUES
('Véhicules dans notre flotte', '150+', 'fa-truck', 1),
('Clients satisfaits', '500+', 'fa-users', 2),
('Livraisons réalisées avec succès', '10 000+', 'fa-box', 3),
('Pays couverts en Afrique de l\'Ouest', '5+', 'fa-map-marker-alt', 4);

-- ------------------------------------------------------------
-- Table : parametres_site (infos générales, coordonnées, réseaux)
-- ------------------------------------------------------------
CREATE TABLE parametres_site (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cle VARCHAR(100) NOT NULL UNIQUE,
    valeur TEXT
) ENGINE=InnoDB;

INSERT INTO parametres_site (cle, valeur) VALUES
('nom_entreprise', 'Globale Multi-Service Plus'),
('telephone', '+224 625 676 659'),
('email', 'moryfodekaba10@gmail.com'),
('adresse', 'Conakry, République de Guinée'),
('horaires', 'Lun - Ven : 08h00 - 18h00 / Sam : 08h00 - 13h00'),
('facebook', '#'),
('linkedin', '#'),
('instagram', '#');

SET FOREIGN_KEY_CHECKS = 1;
