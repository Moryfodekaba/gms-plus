<?php
require_once __DIR__ . '/functions.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? e($pageTitle) . ' - ' : '' ?>GMS Plus | Globale Multi-Service Plus</title>
<meta name="description" content="GMS Plus - Transport de marchandises, engins et véhicules en toute sécurité en Guinée et dans la sous-région.">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="topbar">
  <div class="container">
    <div class="topbar-left">
      <a href="tel:<?= e(str_replace(' ', '', getParametre('telephone'))) ?>"><i class="fa-solid fa-phone"></i> <?= e(getParametre('telephone')) ?></a>
      <a href="mailto:<?= e(getParametre('email')) ?>"><i class="fa-solid fa-envelope"></i> <?= e(getParametre('email')) ?></a>
      <span><i class="fa-solid fa-location-dot"></i> <?= e(getParametre('adresse')) ?></span>
    </div>
    <div class="social">
      Suivez-nous :
      <a href="<?= e(getParametre('facebook','#')) ?>"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="<?= e(getParametre('linkedin','#')) ?>"><i class="fa-brands fa-linkedin-in"></i></a>
      <a href="<?= e(getParametre('instagram','#')) ?>"><i class="fa-brands fa-instagram"></i></a>
    </div>
  </div>
</div>

<header class="main-header">
  <div class="container nav-wrap">
    <a href="index.php" class="logo">
      GMS<span class="plus">+</span>
      <span class="logo-sub">GLOBALE MULTI-SERVICE PLUS</span>
    </a>
    <nav class="main-nav">
      <ul>
        <li><a href="index.php" class="<?= $currentPage=='index.php'?'active':'' ?>">Accueil</a></li>
        <li><a href="a-propos.php" class="<?= $currentPage=='a-propos.php'?'active':'' ?>">À propos</a></li>
        <li><a href="nos-services.php" class="<?= $currentPage=='nos-services.php'?'active':'' ?>">Nos services</a></li>
        <li><a href="notre-flotte.php" class="<?= $currentPage=='notre-flotte.php'?'active':'' ?>">Notre flotte</a></li>
        <li><a href="realisations.php" class="<?= $currentPage=='realisations.php'?'active':'' ?>">Réalisations</a></li>
        <li><a href="actualites.php" class="<?= $currentPage=='actualites.php'?'active':'' ?>">Actualités</a></li>
        <li><a href="contact.php" class="<?= $currentPage=='contact.php'?'active':'' ?>">Contact</a></li>
      </ul>
    </nav>
    <div class="nav-actions">
      <a href="contact.php#devis" class="btn btn-gold btn-gold-header">Demander un devis <i class="fa-solid fa-arrow-right"></i></a>
      <button class="burger" aria-label="Menu"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
