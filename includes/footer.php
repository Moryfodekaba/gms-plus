<footer>
  <div class="container footer-grid">
    <div>
      <div class="footer-logo">GMS<span style="color:var(--gold)">+</span></div>
      <p style="font-size:.82rem; margin-bottom:6px;">GLOBALE MULTI-SERVICE PLUS</p>
      <p style="font-size:.85rem;">Votre satisfaction est notre engagement au quotidien.</p>
      <div class="footer-social">
        <a href="<?= e(getParametre('facebook','#')) ?>"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="<?= e(getParametre('linkedin','#')) ?>"><i class="fa-brands fa-linkedin-in"></i></a>
        <a href="<?= e(getParametre('instagram','#')) ?>"><i class="fa-brands fa-instagram"></i></a>
      </div>
    </div>
    <div>
      <h4>Liens rapides</h4>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="a-propos.php">À propos</a></li>
        <li><a href="nos-services.php">Nos services</a></li>
        <li><a href="notre-flotte.php">Notre flotte</a></li>
        <li><a href="realisations.php">Réalisations</a></li>
        <li><a href="actualites.php">Actualités</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>
    <div>
      <h4>Nos services</h4>
      <ul>
        <li><a href="nos-services.php#transport-camion-plateau">Transport Camion Plateau</a></li>
        <li><a href="nos-services.php#transport-port-char">Transport Port-Char</a></li>
        <li><a href="nos-services.php#transport-logistique">Transport Logistique</a></li>
        <li><a href="nos-services.php#transport-national-international">Transport National</a></li>
        <li><a href="nos-services.php#transport-national-international">Transport International</a></li>
        <li><a href="notre-flotte.php">Location d'engins</a></li>
      </ul>
    </div>
    <div>
      <h4>Contact</h4>
      <ul>
        <li><i class="fa-solid fa-phone"></i> <?= e(getParametre('telephone')) ?></li>
        <li><i class="fa-solid fa-envelope"></i> <?= e(getParametre('email')) ?></li>
        <li><i class="fa-solid fa-location-dot"></i> <?= e(getParametre('adresse')) ?></li>
        <li><i class="fa-solid fa-clock"></i> <?= e(getParametre('horaires')) ?></li>
      </ul>
    </div>
    <div>
      <h4>Newsletter</h4>
      <p style="font-size:.85rem;">Abonnez-vous pour recevoir nos actualités et offres.</p>
      <form class="newsletterForm footer-newsletter">
        <div class="footer-newsletter-form">
          <input type="email" name="email" placeholder="Votre e-mail" required>
          <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </div>
        <div class="form-msg" style="margin-top:8px;"></div>
      </form>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; <?= date('Y') ?> Globale Multi-Service Plus. Tous droits réservés.
  </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>
