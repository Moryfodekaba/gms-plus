<?php
require_once __DIR__ . '/../config/config.php';
$services = db()->query("SELECT * FROM services WHERE is_active=1 ORDER BY category, sort_order, id")->fetchAll();
$vehicles = db()->query("SELECT * FROM vehicles ORDER BY id DESC LIMIT 6")->fetchAll();
$company = setting('company_name', APP_NAME);
?>
<!doctype html><html lang="fr"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($company) ?> | Transport & Sécurité</title><link rel="stylesheet" href="assets/css/style.css">
</head><body>
<header class="site-header"><a class="brand" href="index.php"><span class="brand-mark">GMS+</span><span><?= e($company) ?></span></a>
<nav><a href="#apropos">À propos</a><a href="#transport">Transport</a><a href="#securite">Sécurité</a><a href="#flotte">Notre flotte</a><a href="#contact">Contact</a></nav>
<a class="btn btn-small" href="#devis">Demander un devis</a></header>
<main>
<section class="hero"><div class="hero-content"><span class="eyebrow">GMS PLUS · GUINÉE</span>
<h1><?= e(setting('hero_title','Transport & Sécurité : un partenaire de confiance')) ?></h1>
<p><?= e(setting('hero_text','Des solutions professionnelles pour vos opérations et vos sites.')) ?></p>
<div class="hero-actions"><a class="btn" href="#devis">Demander un devis</a><a class="btn btn-outline" href="#services">Découvrir nos services</a></div></div>
<div class="hero-card"><div class="hero-icon">GMS+</div><strong>TRANSPORT</strong><span>LOGISTIQUE · SÉCURITÉ</span></div></section>
<section class="section intro" id="apropos"><div><span class="eyebrow">QUI SOMMES-NOUS ?</span><h2>Un partenaire engagé à vos côtés</h2></div><p><?= nl2br(e(setting('about_text'))) ?></p></section>
<section class="section shaded" id="services"><div class="section-heading"><span class="eyebrow">NOS EXPERTISES</span><h2>Des services adaptés à vos besoins</h2></div>
<div class="grid-3">
<?php foreach ($services as $s): ?>
<article class="service-card" id="<?= e($s['category']) ?>"><span class="card-tag"><?= $s['category']==='transport'?'TRANSPORT':'SÉCURITÉ' ?></span><h3><?= e($s['title']) ?></h3><p><?= e($s['description']) ?></p></article>
<?php endforeach; ?>
</div></section>
<section class="section" id="flotte"><div class="section-heading"><span class="eyebrow">NOS MOYENS</span><h2>Une flotte au service de vos projets</h2></div><div class="grid-3">
<?php foreach ($vehicles as $v): ?><article class="vehicle-card"><div class="vehicle-placeholder">GMS+</div><div class="vehicle-info"><h3><?= e($v['name']) ?></h3><p><?= e($v['brand'] ?? '') ?> · <?= e($v['capacity'] ?? '') ?></p><span class="status"><?= e($v['status']) ?></span></div></article><?php endforeach; ?>
<?php if (!$vehicles): ?><p>Les véhicules seront bientôt présentés ici.</p><?php endif; ?>
</div></section>
<section class="cta"><div><span class="eyebrow">PARLONS DE VOTRE PROJET</span><h2>Besoin d'une solution de transport ou de sécurité ?</h2></div><a class="btn btn-light" href="#devis">Parler à notre équipe</a></section>
<section class="section contact-layout" id="contact"><div><span class="eyebrow">CONTACT</span><h2>Contactez GMS PLUS</h2><p>Téléphone : <?= e(setting('phone')) ?><br>Email : <?= e(setting('email')) ?><br><?= e(setting('address')) ?></p></div>
<form class="form-card" method="post" action="submit_request.php"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><input type="hidden" name="form_kind" value="contact"><h3>Envoyez-nous un message</h3>
<label>Nom complet<input name="full_name" required maxlength="150"></label><label>Email<input type="email" name="email"></label><label>Téléphone<input name="phone" maxlength="50"></label><label>Message<textarea name="details" required rows="4"></textarea></label><button class="btn" type="submit">Envoyer le message</button></form></section>
<section class="section shaded" id="devis"><div class="contact-layout"><div><span class="eyebrow">DEMANDE DE DEVIS</span><h2>Décrivez votre besoin</h2><p>Notre équipe pourra étudier votre demande et vous recontacter.</p></div>
<form class="form-card" method="post" action="submit_request.php"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><input type="hidden" name="form_kind" value="quote"><h3>Nouvelle demande</h3>
<label>Nom complet<input name="full_name" required maxlength="150"></label><label>Téléphone<input name="phone" required maxlength="50"></label><label>Email<input type="email" name="email"></label><label>Type de service<select name="service_type"><option>Transport</option><option>Sécurité</option><option>Autre</option></select></label><label>Lieu de départ / site<input name="origin" maxlength="180"></label><label>Destination<input name="destination" maxlength="180"></label><label>Votre besoin<textarea name="details" rows="4"></textarea></label><button class="btn" type="submit">Soumettre la demande</button></form></div></section>
</main><footer><strong><?= e($company) ?></strong><span><?= e(setting('tagline')) ?></span><small>© <?= date('Y') ?> GMS PLUS · Tous droits réservés.</small></footer>
</body></html>
