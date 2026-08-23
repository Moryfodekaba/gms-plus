<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "Accueil";
$services = getServicesActifs();
$stats = getStatistiques();
$realisationImg = getRealisations(1);
$partenaires = getPartenaires();
require __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-text">
      <h1>LE TRANSPORT<br>EN TOUTE CONFIANCE
        <span class="accent">CAMION PLATEAU &amp; PORT-CHAR</span>
      </h1>
      <p>Globale Multi-Service Plus vous accompagne dans le transport de vos marchandises, engins et véhicules en toute sécurité, partout en Guinée et dans la sous-région.</p>
      <div class="hero-actions">
        <a href="nos-services.php" class="btn btn-gold">Nos services <i class="fa-solid fa-arrow-right"></i></a>
        <a href="contact.php#devis" class="btn btn-outline">Demander un devis <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="hero-image">
      <img src="assets/images/hero-truck.jpg" alt="Camion GMS Plus Astra">
    </div>
  </div>
</section>

<!-- FEATURES BAR -->
<section class="features-bar">
  <div class="container features-grid">
    <div class="feature-item">
      <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
      <div><h4>Sécurité</h4><p>Des opérations sécurisées à chaque étape.</p></div>
    </div>
    <div class="feature-item">
      <div class="icon"><i class="fa-regular fa-clock"></i></div>
      <div><h4>Ponctualité</h4><p>Livraison dans les délais, partout, à tout moment.</p></div>
    </div>
    <div class="feature-item">
      <div class="icon"><i class="fa-solid fa-user-tie"></i></div>
      <div><h4>Professionnalisme</h4><p>Une équipe qualifiée à votre service 24h/24 et 7j/7.</p></div>
    </div>
    <div class="feature-item">
      <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
      <div><h4>Couverture étendue</h4><p>Interventions en Guinée et dans la sous-région.</p></div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="section">
  <div class="container">
    <p class="section-tag">Nos services</p>
    <h2 class="section-title">Des solutions de transport adaptées à vos besoins</h2>
    <div class="section-underline"></div>
    <div class="services-grid">
      <?php foreach ($services as $s): ?>
      <div class="service-card">
        <img src="<?= e($s['image']) ?>" alt="<?= e($s['titre']) ?>" onerror="this.src='assets/images/placeholder.jpg'">
        <div class="body">
          <div class="service-icon"><i class="fa-solid <?= e($s['icone']) ?>"></i></div>
          <h3><?= e($s['titre']) ?></h3>
          <p><?= e($s['description_courte']) ?></p>
          <a class="link" href="nos-services.php#<?= e($s['slug']) ?>">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats-bar">
  <div class="container stats-grid">
    <?php foreach ($stats as $st): ?>
    <div class="stat-item">
      <i class="fa-solid <?= e($st['icone']) ?> icon"></i>
      <div>
        <div class="value"><?= e($st['valeur']) ?></div>
        <div class="label"><?= e($st['libelle']) ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ABOUT + DEVIS -->
<section class="section">
  <div class="container about-devis-grid">
    <div>
      <img src="assets/images/about-trucks.jpg" alt="Flotte GMS Plus">
    </div>
    <div>
      <p class="section-tag" style="text-align:left;">À propos de nous</p>
      <h2 style="color:var(--navy); font-size:1.7rem; font-weight:800;">Un partenaire de confiance pour aller plus loin</h2>
      <p style="color:var(--gray-text); margin:16px 0;">Globale Multi-Service Plus est une société de transport professionnel spécialisée dans le transport de marchandises, d'engins lourds et de véhicules. Notre mission est d'offrir des services fiables, sécurisés et adaptés aux besoins de nos clients.</p>
      <ul class="check-list">
        <li>Sécurité garantie</li>
        <li>Équipe expérimentée</li>
        <li>Respect des délais</li>
        <li>Tarifs compétitifs</li>
        <li>Matériel performant</li>
        <li>Service client réactif</li>
      </ul>
      <a href="a-propos.php" class="btn btn-navy">Découvrir l'entreprise <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="devis-box" id="devis">
      <h3>Demander un devis</h3>
      <p style="font-size:.85rem; color:#c7d0e2; margin-bottom:16px;">Recevez une offre personnalisée adaptée à vos besoins.</p>
      <div class="form-msg" id="devisMsg"></div>
      <form id="devisForm">
        <input type="text" name="nom" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Votre e-mail" required>
        <input type="tel" name="telephone" placeholder="Votre téléphone" required>
        <select name="type_service" required>
          <option value="">Type de service</option>
          <?php foreach ($services as $s): ?>
          <option value="<?= e($s['titre']) ?>"><?= e($s['titre']) ?></option>
          <?php endforeach; ?>
          <option value="Autre">Autre</option>
        </select>
        <textarea name="message" placeholder="Votre message"></textarea>
        <button type="submit" class="btn btn-gold btn-block">Envoyer ma demande <i class="fa-solid fa-arrow-right"></i></button>
      </form>
    </div>
  </div>
</section>

<!-- PARTNERS -->
<section class="section bg-light" style="padding-top:30px; padding-bottom:40px;">
  <div class="container">
    <p class="section-tag">Ils nous font confiance</p>
    <div class="partners-strip">
      <?php foreach ($partenaires as $p): ?>
      <div class="partner">
        <img src="<?= e($p['logo']) ?>" alt="<?= e($p['nom']) ?>" onerror="this.style.display='none'">
        <span><?= e($p['nom']) ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
