document.addEventListener('DOMContentLoaded', function () {

  // Menu burger (mobile)
  var burger = document.querySelector('.burger');
  var nav = document.querySelector('.main-nav');
  if (burger && nav) {
    burger.addEventListener('click', function () {
      nav.classList.toggle('open');
    });
  }

  // Formulaire de devis (AJAX)
  var devisForm = document.getElementById('devisForm');
  if (devisForm) {
    devisForm.addEventListener('submit', function (e) {
      e.preventDefault();
      submitAjaxForm(devisForm, 'traitement_devis.php', 'devisMsg');
    });
  }

  // Formulaire de contact (AJAX)
  var contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
      e.preventDefault();
      submitAjaxForm(contactForm, 'traitement_contact.php', 'contactMsg');
    });
  }

  // Formulaire newsletter (footer) - peut apparaître plusieurs fois
  document.querySelectorAll('.newsletterForm').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var msgBox = form.querySelector('.form-msg');
      var formData = new FormData(form);
      fetch('traitement_newsletter.php', { method: 'POST', body: formData })
        .then(function (r) { return r.json(); })
        .then(function (data) {
          if (msgBox) {
            msgBox.textContent = data.message;
            msgBox.className = 'form-msg ' + (data.success ? 'success' : 'error');
          }
          if (data.success) form.reset();
        })
        .catch(function () {
          if (msgBox) {
            msgBox.textContent = "Une erreur est survenue. Réessayez.";
            msgBox.className = 'form-msg error';
          }
        });
    });
  });

  function submitAjaxForm(form, endpoint, msgId) {
    var msgBox = document.getElementById(msgId);
    var formData = new FormData(form);
    var btn = form.querySelector('button[type="submit"]');
    var originalText = btn ? btn.innerHTML : '';
    if (btn) { btn.disabled = true; btn.innerHTML = 'Envoi en cours...'; }

    fetch(endpoint, { method: 'POST', body: formData })
      .then(function (r) { return r.json(); })
      .then(function (data) {
        if (msgBox) {
          msgBox.textContent = data.message;
          msgBox.className = 'form-msg ' + (data.success ? 'success' : 'error');
        }
        if (data.success) form.reset();
      })
      .catch(function () {
        if (msgBox) {
          msgBox.textContent = "Une erreur est survenue. Veuillez réessayer.";
          msgBox.className = 'form-msg error';
        }
      })
      .finally(function () {
        if (btn) { btn.disabled = false; btn.innerHTML = originalText; }
      });
  }
});
