<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "Actualités";
$actualites = getActualites();
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1>Actualités</h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / Actualités</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="card-grid-3">
      <?php foreach ($actualites as $a): ?>
      <div class="simple-card">
        <img src="<?= e($a['image']) ?>" alt="<?= e($a['titre']) ?>" onerror="this.src='assets/images/placeholder.jpg'">
        <div class="body">
          <div class="meta"><?= formatDateFr($a['date_publication']) ?></div>
          <h3><?= e($a['titre']) ?></h3>
          <p><?= e($a['extrait']) ?></p>
          <a href="actualite-detail.php?slug=<?= urlencode($a['slug']) ?>" class="link" style="color:var(--gold-dark); font-weight:700; display:inline-block; margin-top:10px;">Lire la suite <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($actualites)): ?>
        <p>Aucune actualité publiée pour le moment.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
