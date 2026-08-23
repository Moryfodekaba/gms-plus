<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "À propos";
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1>À propos de GMS Plus</h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / À propos</p>
  </div>
</section>

<section class="section">
  <div class="container about-devis-grid" style="grid-template-columns:1fr 1fr;">
    <img src="assets/images/about-trucks.jpg" alt="GMS Plus">
    <div>
      <p class="section-tag" style="text-align:left;">Qui sommes-nous</p>
      <h2 style="color:var(--navy); font-size:1.7rem; font-weight:800;">Globale Multi-Service Plus</h2>
      <p style="color:var(--gray-text); margin:16px 0;">Basée à Conakry, en République de Guinée, Globale Multi-Service Plus (GMS Plus) est une entreprise de transport spécialisée dans l'acheminement de marchandises générales, d'engins lourds et de véhicules, au moyen de camions plateaux et de porte-chars.</p>
      <p style="color:var(--gray-text); margin-bottom:16px;">Depuis notre création, nous avons bâti notre réputation sur la sécurité, la ponctualité et le professionnalisme. Nous accompagnons aujourd'hui des entreprises minières, industrielles et commerciales à travers toute la Guinée et la sous-région ouest-africaine.</p>
      <ul class="check-list">
        <li>Sécurité garantie</li>
        <li>Équipe expérimentée</li>
        <li>Respect des délais</li>
        <li>Tarifs compétitifs</li>
        <li>Matériel performant</li>
        <li>Service client réactif</li>
      </ul>
    </div>
  </div>
</section>

<section class="section bg-light">
  <div class="container">
    <p class="section-tag">Notre mission &amp; vision</p>
    <h2 class="section-title">Ce qui nous anime</h2>
    <div class="section-underline"></div>
    <div class="card-grid-3">
      <div class="simple-card"><div class="body">
        <h3><i class="fa-solid fa-bullseye" style="color:var(--gold-dark);"></i> Notre mission</h3>
        <p>Offrir des solutions de transport fiables, sécurisées et adaptées aux besoins spécifiques de chaque client, en Guinée et dans la sous-région.</p>
      </div></div>
      <div class="simple-card"><div class="body">
        <h3><i class="fa-solid fa-eye" style="color:var(--gold-dark);"></i> Notre vision</h3>
        <p>Devenir la référence du transport de marchandises et d'engins lourds en Afrique de l'Ouest, reconnue pour son excellence opérationnelle.</p>
      </div></div>
      <div class="simple-card"><div class="body">
        <h3><i class="fa-solid fa-handshake" style="color:var(--gold-dark);"></i> Nos valeurs</h3>
        <p>Sécurité, intégrité, ponctualité, professionnalisme et satisfaction client sont au cœur de chacune de nos interventions.</p>
      </div></div>
    </div>
  </div>
</section>

<section class="stats-bar">
  <div class="container stats-grid">
    <?php foreach (getStatistiques() as $st): ?>
    <div class="stat-item">
      <i class="fa-solid <?= e($st['icone']) ?> icon"></i>
      <div><div class="value"><?= e($st['valeur']) ?></div><div class="label"><?= e($st['libelle']) ?></div></div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
