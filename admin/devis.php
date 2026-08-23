<?php
require_once __DIR__ . '/includes/auth_check.php';
$pageTitle = "Demandes de devis";
$db = getDB();

// Changer le statut
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'statut') {
    $statutsValides = ['nouveau','en_cours','traite','annule'];
    $nouveauStatut = $_GET['statut'] ?? 'nouveau';
    if (in_array($nouveauStatut, $statutsValides)) {
        $stmt = $db->prepare("UPDATE demandes_devis SET statut = ? WHERE id = ?");
        $stmt->execute([$nouveauStatut, (int)$_GET['id']]);
    }
    header('Location: devis.php'); exit;
}

// Supprimer
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'supprimer') {
    $stmt = $db->prepare("DELETE FROM demandes_devis WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    header('Location: devis.php'); exit;
}

$devisList = $db->query("SELECT * FROM demandes_devis ORDER BY date_demande DESC")->fetchAll();
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);">Toutes les demandes de devis (<?= count($devisList) ?>)</h3>
  <table>
    <tr><th>Nom</th><th>Contact</th><th>Service</th><th>Message</th><th>Date</th><th>Statut</th><th>Actions</th></tr>
    <?php foreach ($devisList as $d): ?>
    <tr>
      <td><?= e($d['nom']) ?></td>
      <td><?= e($d['email']) ?><br><?= e($d['telephone']) ?></td>
      <td><?= e($d['type_service']) ?></td>
      <td style="max-width:220px;"><?= e(mb_strimwidth($d['message'] ?? '', 0, 80, '...')) ?></td>
      <td><?= date('d/m/Y H:i', strtotime($d['date_demande'])) ?></td>
      <td>
        <form method="GET" style="display:inline;">
          <input type="hidden" name="action" value="statut">
          <input type="hidden" name="id" value="<?= $d['id'] ?>">
          <select name="statut" onchange="this.form.submit()" style="padding:4px; border-radius:4px;">
            <option value="nouveau" <?= $d['statut']=='nouveau'?'selected':'' ?>>Nouveau</option>
            <option value="en_cours" <?= $d['statut']=='en_cours'?'selected':'' ?>>En cours</option>
            <option value="traite" <?= $d['statut']=='traite'?'selected':'' ?>>Traité</option>
            <option value="annule" <?= $d['statut']=='annule'?'selected':'' ?>>Annulé</option>
          </select>
        </form>
      </td>
      <td><a href="devis.php?action=supprimer&id=<?= $d['id'] ?>" class="btn btn-red btn-sm" onclick="return confirm('Supprimer cette demande ?')"><i class="fa-solid fa-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($devisList)): ?>
    <tr><td colspan="7">Aucune demande de devis.</td></tr>
    <?php endif; ?>
  </table>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
