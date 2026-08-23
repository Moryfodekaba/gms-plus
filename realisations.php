<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "Réalisations";
$realisations = getRealisations();
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1>Nos réalisations</h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / Réalisations</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <p class="section-tag">10 000+ livraisons réalisées</p>
    <h2 class="section-title">Quelques-unes de nos missions</h2>
    <div class="section-underline"></div>
    <div class="card-grid-3">
      <?php foreach ($realisations as $r): ?>
      <div class="simple-card">
        <img src="<?= e($r['image']) ?>" alt="<?= e($r['titre']) ?>" onerror="this.src='assets/images/placeholder.jpg'">
        <div class="body">
          <div class="meta"><?= e($r['client']) ?> &middot; <?= $r['date_realisation'] ? formatDateFr($r['date_realisation']) : '' ?></div>
          <h3><?= e($r['titre']) ?></h3>
          <p><?= e($r['description']) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($realisations)): ?>
        <p>Aucune réalisation publiée pour le moment.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
