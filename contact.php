<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = "Contact";
$services = getServicesActifs();
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
  <div class="container">
    <h1>Contactez-nous</h1>
    <p class="breadcrumb"><a href="index.php">Accueil</a> / Contact</p>
  </div>
</section>

<section class="section" id="devis">
  <div class="container contact-grid">
    <div>
      <p class="section-tag" style="text-align:left;">Nos coordonnées</p>
      <h2 style="color:var(--navy); font-size:1.6rem; font-weight:800; margin-bottom:20px;">Parlons de votre projet</h2>

      <div class="contact-info-card">
        <div class="icon"><i class="fa-solid fa-phone"></i></div>
        <div><strong>Téléphone</strong><p><?= e(getParametre('telephone')) ?></p></div>
      </div>
      <div class="contact-info-card">
        <div class="icon"><i class="fa-solid fa-envelope"></i></div>
        <div><strong>E-mail</strong><p><?= e(getParametre('email')) ?></p></div>
      </div>
      <div class="contact-info-card">
        <div class="icon"><i class="fa-solid fa-location-dot"></i></div>
        <div><strong>Adresse</strong><p><?= e(getParametre('adresse')) ?></p></div>
      </div>
      <div class="contact-info-card">
        <div class="icon"><i class="fa-solid fa-clock"></i></div>
        <div><strong>Horaires</strong><p><?= e(getParametre('horaires')) ?></p></div>
      </div>

      <div class="map-embed">
        <iframe src="https://www.google.com/maps?q=Conakry,Guin%C3%A9e&output=embed" width="100%" height="260" style="border:0;" allowfullscreen loading="lazy"></iframe>
      </div>
    </div>

    <div class="contact-form-box">
      <h3 style="color:var(--navy); margin-bottom:16px;">Demander un devis / Nous écrire</h3>
      <div class="form-msg" id="devisMsg"></div>
      <form id="devisForm">
        <div class="two-col">
          <input type="text" name="nom" placeholder="Votre nom" required>
          <input type="email" name="email" placeholder="Votre e-mail" required>
        </div>
        <div class="two-col">
          <input type="tel" name="telephone" placeholder="Votre téléphone" required>
          <select name="type_service" required>
            <option value="">Type de service</option>
            <?php foreach ($services as $s): ?>
            <option value="<?= e($s['titre']) ?>"><?= e($s['titre']) ?></option>
            <?php endforeach; ?>
            <option value="Autre">Autre</option>
          </select>
        </div>
        <textarea name="message" placeholder="Décrivez votre besoin..." rows="5"></textarea>
        <button type="submit" class="btn btn-gold btn-block">Envoyer ma demande <i class="fa-solid fa-arrow-right"></i></button>
      </form>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
