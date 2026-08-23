<?php
require_once __DIR__ . '/includes/auth_check.php';
$pageTitle = "Tableau de bord";

$db = getDB();
$nbDevis = $db->query("SELECT COUNT(*) n FROM demandes_devis")->fetch()['n'];
$nbDevisNouveaux = $db->query("SELECT COUNT(*) n FROM demandes_devis WHERE statut='nouveau'")->fetch()['n'];
$nbMessages = $db->query("SELECT COUNT(*) n FROM messages_contact")->fetch()['n'];
$nbNewsletter = $db->query("SELECT COUNT(*) n FROM newsletter WHERE actif=1")->fetch()['n'];
$nbActualites = $db->query("SELECT COUNT(*) n FROM actualites")->fetch()['n'];
$derniersDevis = $db->query("SELECT * FROM demandes_devis ORDER BY date_demande DESC LIMIT 5")->fetchAll();

require __DIR__ . '/includes/admin-header.php';
?>
<div class="stat-cards">
  <div class="stat-card"><div class="icon"><i class="fa-solid fa-file-invoice"></i></div><div><div class="value"><?= $nbDevis ?></div><div class="label">Demandes de devis</div></div></div>
  <div class="stat-card"><div class="icon"><i class="fa-solid fa-bell"></i></div><div><div class="value"><?= $nbDevisNouveaux ?></div><div class="label">Devis non traités</div></div></div>
  <div class="stat-card"><div class="icon"><i class="fa-solid fa-envelope"></i></div><div><div class="value"><?= $nbMessages ?></div><div class="label">Messages de contact</div></div></div>
  <div class="stat-card"><div class="icon"><i class="fa-solid fa-users"></i></div><div><div class="value"><?= $nbNewsletter ?></div><div class="label">Abonnés newsletter</div></div></div>
</div>

<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);">Dernières demandes de devis</h3>
  <table>
    <tr><th>Nom</th><th>Service</th><th>Téléphone</th><th>Date</th><th>Statut</th><th></th></tr>
    <?php foreach ($derniersDevis as $d): ?>
    <tr>
      <td><?= e($d['nom']) ?></td>
      <td><?= e($d['type_service']) ?></td>
      <td><?= e($d['telephone']) ?></td>
      <td><?= date('d/m/Y H:i', strtotime($d['date_demande'])) ?></td>
      <td>
        <?php
        $badges = ['nouveau'=>'badge-new','en_cours'=>'badge-progress','traite'=>'badge-done','annule'=>'badge-progress'];
        $labels = ['nouveau'=>'Nouveau','en_cours'=>'En cours','traite'=>'Traité','annule'=>'Annulé'];
        ?>
        <span class="badge <?= $badges[$d['statut']] ?>"><?= $labels[$d['statut']] ?></span>
      </td>
      <td><a href="devis.php" class="btn btn-navy btn-sm">Voir tout</a></td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($derniersDevis)): ?>
    <tr><td colspan="6">Aucune demande de devis pour le moment.</td></tr>
    <?php endif; ?>
  </table>
</div>

<?php require __DIR__ . '/includes/admin-footer.php'; ?>
