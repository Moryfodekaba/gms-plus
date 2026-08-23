<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "Nos services";
$services = getServicesActifs();
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1>Nos services</h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / Nos services</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php foreach ($services as $i => $s): ?>
    <div id="<?= e($s['slug']) ?>" style="display:grid; grid-template-columns:<?= $i % 2 === 0 ? '1fr 1fr' : '1fr 1fr' ?>; gap:40px; align-items:center; margin-bottom:60px; scroll-margin-top:100px;">
      <?php if ($i % 2 === 0): ?>
        <img src="<?= e($s['image']) ?>" alt="<?= e($s['titre']) ?>" style="border-radius:6px;" onerror="this.src='assets/images/placeholder.jpg'">
        <div>
          <div class="service-icon" style="margin-top:0;"><i class="fa-solid <?= e($s['icone']) ?>"></i></div>
          <h2 style="color:var(--navy); margin-bottom:14px;"><?= e($s['titre']) ?></h2>
          <p style="color:var(--gray-text);"><?= e($s['description_longue']) ?></p>
          <a href="contact.php#devis" class="btn btn-gold" style="margin-top:20px;">Demander un devis <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      <?php else: ?>
        <div>
          <div class="service-icon" style="margin-top:0;"><i class="fa-solid <?= e($s['icone']) ?>"></i></div>
          <h2 style="color:var(--navy); margin-bottom:14px;"><?= e($s['titre']) ?></h2>
          <p style="color:var(--gray-text);"><?= e($s['description_longue']) ?></p>
          <a href="contact.php#devis" class="btn btn-gold" style="margin-top:20px;">Demander un devis <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <img src="<?= e($s['image']) ?>" alt="<?= e($s['titre']) ?>" style="border-radius:6px;" onerror="this.src='assets/images/placeholder.jpg'">
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
