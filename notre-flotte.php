<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "Notre flotte";
$flotte = getFlotte();
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1>Notre flotte</h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / Notre flotte</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <p class="section-tag">150+ véhicules</p>
    <h2 class="section-title">Un parc moderne à votre service</h2>
    <div class="section-underline"></div>
    <div class="card-grid-3">
      <?php foreach ($flotte as $v): ?>
      <div class="simple-card">
        <img src="<?= e($v['image']) ?>" alt="<?= e($v['nom']) ?>" onerror="this.src='assets/images/placeholder.jpg'">
        <div class="body">
          <div class="meta"><?= e($v['type_vehicule']) ?></div>
          <h3><?= e($v['nom']) ?></h3>
          <p><?= e($v['description']) ?></p>
          <p style="margin-top:10px; font-weight:700; color:var(--navy);"><i class="fa-solid fa-weight-hanging"></i> Capacité : <?= e($v['capacite']) ?></p>
          <?php if ($v['disponible']): ?>
          <span style="display:inline-block; margin-top:10px; background:#e8f7ec; color:#1c7c3c; padding:4px 10px; border-radius:20px; font-size:.75rem; font-weight:700;">Disponible</span>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
