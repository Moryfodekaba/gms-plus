<?php
require_once __DIR__ . '/includes/functions.php';
$slug = $_GET['slug'] ?? '';
$actualite = $slug ? getActualiteBySlug($slug) : null;

if (!$actualite) {
    header("HTTP/1.0 404 Not Found");
    $pageTitle = "Article introuvable";
    require __DIR__ . '/includes/header.php';
    echo '<section class="section container"><h1>Article introuvable</h1><p><a href="actualites.php">Retour aux actualités</a></p></section>';
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $actualite['titre'];
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1><?= e($actualite['titre']) ?></h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / <a href="actualites.php">Actualités</a> / <?= e($actualite['titre']) ?></p>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width:820px;">
    <img src="<?= e($actualite['image']) ?>" alt="<?= e($actualite['titre']) ?>" style="border-radius:6px; margin-bottom:24px;" onerror="this.src='assets/images/placeholder.jpg'">
    <p style="color:var(--gold-dark); font-weight:700; font-size:.85rem; text-transform:uppercase;">
      <?= formatDateFr($actualite['date_publication']) ?> &middot; Par <?= e($actualite['auteur']) ?>
    </p>
    <div style="margin-top:18px; color:var(--gray-text); font-size:1.02rem; line-height:1.8;">
      <?= nl2br(e($actualite['contenu'])) ?>
    </div>
    <a href="actualites.php" class="btn btn-navy" style="margin-top:30px;"><i class="fa-solid fa-arrow-left"></i> Retour aux actualités</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
