<?php
/**
 * GMS PLUS - Fonctions utilitaires
 */

require_once __DIR__ . '/../config/database.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Nettoie une chaîne pour affichage sécurisé (anti-XSS)
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

// Récupère un paramètre du site (téléphone, email, etc.)
function getParametre($cle, $defaut = '') {
    static $cache = null;
    if ($cache === null) {
        $stmt = getDB()->query("SELECT cle, valeur FROM parametres_site");
        $cache = [];
        foreach ($stmt->fetchAll() as $row) {
            $cache[$row['cle']] = $row['valeur'];
        }
    }
    return $cache[$cle] ?? $defaut;
}

function getServicesActifs() {
    $stmt = getDB()->query("SELECT * FROM services WHERE actif = 1 ORDER BY ordre_affichage ASC");
    return $stmt->fetchAll();
}

function getServiceBySlug($slug) {
    $stmt = getDB()->prepare("SELECT * FROM services WHERE slug = ? AND actif = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getFlotte() {
    $stmt = getDB()->query("SELECT * FROM flotte ORDER BY id DESC");
    return $stmt->fetchAll();
}

function getRealisations($limit = null) {
    $sql = "SELECT * FROM realisations ORDER BY date_realisation DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return getDB()->query($sql)->fetchAll();
}

function getPartenaires() {
    return getDB()->query("SELECT * FROM partenaires WHERE actif = 1 ORDER BY ordre_affichage ASC")->fetchAll();
}

function getActualites($limit = null, $publieUniquement = true) {
    $sql = "SELECT * FROM actualites";
    if ($publieUniquement) $sql .= " WHERE publie = 1";
    $sql .= " ORDER BY date_publication DESC";
    if ($limit) $sql .= " LIMIT " . (int)$limit;
    return getDB()->query($sql)->fetchAll();
}

function getActualiteBySlug($slug) {
    $stmt = getDB()->prepare("SELECT * FROM actualites WHERE slug = ? AND publie = 1");
    $stmt->execute([$slug]);
    return $stmt->fetch();
}

function getStatistiques() {
    return getDB()->query("SELECT * FROM statistiques ORDER BY ordre_affichage ASC")->fetchAll();
}

function formatDateFr($date) {
    $mois = ['01'=>'janvier','02'=>'février','03'=>'mars','04'=>'avril','05'=>'mai','06'=>'juin',
             '07'=>'juillet','08'=>'août','09'=>'septembre','10'=>'octobre','11'=>'novembre','12'=>'décembre'];
    $timestamp = strtotime($date);
    return date('d', $timestamp) . ' ' . $mois[date('m', $timestamp)] . ' ' . date('Y', $timestamp);
}

// Génère un slug propre à partir d'un texte
function slugify($text) {
    $text = strtolower(trim($text));
    $text = str_replace(['é','è','ê','ë','à','â','î','ï','ô','ö','ù','û','ü','ç'],
                         ['e','e','e','e','a','a','i','i','o','o','u','u','u','c'], $text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function redirect($url) {
    header("Location: $url");
    exit;
}
