CREATE DATABASE IF NOT EXISTS gms_plus_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE gms_plus_db;

CREATE TABLE admins (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE settings (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 setting_key VARCHAR(100) NOT NULL UNIQUE,
 setting_value TEXT NULL
) ENGINE=InnoDB;

CREATE TABLE services (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 category ENUM('transport','security') NOT NULL,
 title VARCHAR(180) NOT NULL,
 description TEXT NOT NULL,
 is_active TINYINT(1) NOT NULL DEFAULT 1,
 sort_order INT NOT NULL DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE vehicles (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(180) NOT NULL,
 brand VARCHAR(100) DEFAULT NULL,
 registration VARCHAR(80) DEFAULT NULL,
 capacity VARCHAR(100) DEFAULT NULL,
 wheels VARCHAR(50) DEFAULT NULL,
 status ENUM('Disponible','En mission','Maintenance') NOT NULL DEFAULT 'Disponible',
 description TEXT NULL,
 image_path VARCHAR(255) NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE quote_requests (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(150) NOT NULL,
 phone VARCHAR(50) NOT NULL,
 email VARCHAR(190) NULL,
 service_type ENUM('Transport','Sécurité','Autre') NOT NULL DEFAULT 'Autre',
 origin VARCHAR(180) NULL,
 destination VARCHAR(180) NULL,
 details TEXT NULL,
 status ENUM('Nouvelle','En cours','Acceptée','Refusée','Terminée') NOT NULL DEFAULT 'Nouvelle',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 INDEX(status), INDEX(created_at)
) ENGINE=InnoDB;

CREATE TABLE contact_messages (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(150) NOT NULL,
 email VARCHAR(190) NULL,
 phone VARCHAR(50) NULL,
 message TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE activity_logs (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 admin_id INT UNSIGNED NULL,
 action VARCHAR(190) NOT NULL,
 details TEXT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_log_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- Mot de passe initial : ChangeMe123! (à changer après connexion)
INSERT INTO admins (name,email,password_hash)
VALUES ('Administrateur GMS PLUS','',
'$2y$12$9RE07bmItCc/1JAlCOht6.zQhZ86KUsX.0yEN2HQTljYDMpTPmECK');

INSERT INTO settings (setting_key,setting_value) VALUES
('company_name','GLOBALE MULTI-SERVICES PLUS'),
('tagline','Le transport et la sécurité, au service de vos ambitions.'),
('phone','+224 625 676 659'),
('email','moryfodekaba10@gmail.com'),
('address','Conakry, République de Guinée'),
('about_text','GMS PLUS accompagne les entreprises et les particuliers avec des solutions de transport, de logistique et de sécurité adaptées à leurs besoins.'),
('hero_title','Transport & Sécurité : un partenaire de confiance'),
('hero_text','Des solutions professionnelles pour vos opérations, vos marchandises et la protection de vos sites.');

INSERT INTO services (category,title,description,sort_order) VALUES
('transport','Transport par camion plateau','Transport de marchandises et équipements sur plateau.',1),
('transport','Transport porte-char et porte-engins','Acheminement d’engins et de matériels lourds.',2),
('transport','Solutions logistiques','Organisation et suivi de vos besoins de transport.',3),
('security','Gardiennage de sites','Surveillance de sites professionnels, entrepôts et chantiers.',1),
('security','Contrôle d’accès','Contrôle des entrées et sorties de personnes et véhicules.',2),
('security','Sécurité industrielle','Solutions de surveillance adaptées aux installations industrielles.',3);

INSERT INTO vehicles (name,brand,capacity,wheels,status,description) VALUES
('Camion plateau','ASTRA','Selon configuration','26 roues','Disponible','Véhicule destiné au transport de marchandises et équipements.'),
('Porte-char','À renseigner','Selon configuration','À renseigner','Disponible','Transport d’engins et de matériels lourds.');