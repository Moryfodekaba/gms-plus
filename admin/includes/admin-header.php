<?php $adminPage = basename($_SERVER['PHP_SELF']); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? e($pageTitle) . ' - ' : '' ?>Administration GMS Plus</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root{--navy:#0b1f3f;--navy-dark:#081730;--gold:#f5a623;}
*{box-sizing:border-box;}
body{font-family:'Segoe UI',Arial,sans-serif;margin:0;background:#f4f6fa;color:#232d3f;}
.admin-wrap{display:flex; min-height:100vh;}
.sidebar{width:230px; background:var(--navy-dark); color:#fff; flex-shrink:0;}
.sidebar .logo{padding:22px; font-size:1.3rem; font-weight:800; border-bottom:1px solid #1c2c4d;}
.sidebar .logo span{color:var(--gold);}
.sidebar nav ul{list-style:none; margin:0; padding:14px 0;}
.sidebar nav a{display:flex; align-items:center; gap:10px; padding:12px 22px; color:#b8c2d6; font-size:.9rem; font-weight:600;}
.sidebar nav a:hover, .sidebar nav a.active{background:var(--navy); color:var(--gold); border-left:3px solid var(--gold);}
.main{flex:1; display:flex; flex-direction:column;}
.topbar{background:#fff; padding:14px 26px; display:flex; justify-content:space-between; align-items:center; box-shadow:0 2px 8px rgba(0,0,0,.05);}
.content{padding:26px;}
.card{background:#fff; border-radius:8px; padding:22px; box-shadow:0 2px 10px rgba(0,0,0,.05); margin-bottom:22px;}
table{width:100%; border-collapse:collapse; font-size:.88rem;}
th, td{padding:10px 12px; text-align:left; border-bottom:1px solid #eef1f6;}
th{background:#f4f6fa; color:var(--navy); font-weight:700;}
.badge{padding:3px 10px; border-radius:20px; font-size:.72rem; font-weight:700; display:inline-block;}
.badge-new{background:#fdecec; color:#b91c1c;}
.badge-progress{background:#fff6e0; color:#b98300;}
.badge-done{background:#e8f7ec; color:#1c7c3c;}
.btn{display:inline-flex; align-items:center; gap:6px; padding:9px 16px; border-radius:4px; font-weight:600; font-size:.85rem; border:none; cursor:pointer; text-decoration:none;}
.btn-gold{background:var(--gold); color:var(--navy-dark);}
.btn-navy{background:var(--navy); color:#fff;}
.btn-red{background:#e34a4a; color:#fff;}
.btn-sm{padding:6px 10px; font-size:.78rem;}
.stat-cards{display:grid; grid-template-columns:repeat(4,1fr); gap:18px; margin-bottom:24px;}
.stat-card{background:#fff; border-radius:8px; padding:20px; box-shadow:0 2px 10px rgba(0,0,0,.05); display:flex; align-items:center; gap:14px;}
.stat-card .icon{width:48px; height:48px; border-radius:50%; background:var(--navy); color:var(--gold); display:flex; align-items:center; justify-content:center; font-size:1.2rem;}
.stat-card .value{font-size:1.5rem; font-weight:800; color:var(--navy);}
.stat-card .label{font-size:.78rem; color:#8792a3;}
form.admin-form input, form.admin-form select, form.admin-form textarea{width:100%; padding:10px; margin-bottom:14px; border:1px solid #ddd; border-radius:4px; font-family:inherit;}
form.admin-form label{font-size:.85rem; font-weight:700; color:var(--navy); display:block; margin-bottom:6px;}
.alert{padding:12px 16px; border-radius:4px; margin-bottom:16px; font-size:.88rem;}
.alert-success{background:#e8f7ec; color:#1c7c3c;}
.alert-error{background:#fdecec; color:#b91c1c;}
@media (max-width:800px){.admin-wrap{flex-direction:column;} .sidebar{width:100%;} .stat-cards{grid-template-columns:1fr 1fr;}}
</style>
</head>
<body>
<div class="admin-wrap">
  <aside class="sidebar">
    <div class="logo">GMS<span>+</span> Admin</div>
    <nav>
      <ul>
        <li><a href="dashboard.php" class="<?= $adminPage=='dashboard.php'?'active':'' ?>"><i class="fa-solid fa-gauge"></i> Tableau de bord</a></li>
        <li><a href="devis.php" class="<?= $adminPage=='devis.php'?'active':'' ?>"><i class="fa-solid fa-file-invoice"></i> Demandes de devis</a></li>
        <li><a href="messages.php" class="<?= $adminPage=='messages.php'?'active':'' ?>"><i class="fa-solid fa-envelope"></i> Messages de contact</a></li>
        <li><a href="services.php" class="<?= $adminPage=='services.php'?'active':'' ?>"><i class="fa-solid fa-truck"></i> Services</a></li>
        <li><a href="actualites.php" class="<?= $adminPage=='actualites.php'?'active':'' ?>"><i class="fa-solid fa-newspaper"></i> Actualités</a></li>
        <li><a href="newsletter.php" class="<?= $adminPage=='newsletter.php'?'active':'' ?>"><i class="fa-solid fa-paper-plane"></i> Newsletter</a></li>
        <li><a href="../index.php" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i> Voir le site</a></li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a></li>
      </ul>
    </nav>
  </aside>
  <div class="main">
    <div class="topbar">
      <strong><?= isset($pageTitle) ? e($pageTitle) : 'Administration' ?></strong>
      <span>Bonjour, <?= e($_SESSION['admin_nom'] ?? 'Admin') ?> <i class="fa-solid fa-user-circle"></i></span>
    </div>
    <div class="content">
