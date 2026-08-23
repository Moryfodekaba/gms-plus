<?php
require_once __DIR__ . '/includes/auth_check.php';
$pageTitle = "Newsletter";
$db = getDB();

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'supprimer') {
    $stmt = $db->prepare("DELETE FROM newsletter WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    header('Location: newsletter.php'); exit;
}

$abonnes = $db->query("SELECT * FROM newsletter ORDER BY date_inscription DESC")->fetchAll();
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);">Abonnés à la newsletter (<?= count($abonnes) ?>)</h3>
  <p style="margin-bottom:16px; color:#8792a3; font-size:.85rem;">Vous pouvez copier ces adresses pour envoyer votre newsletter via votre outil d'e-mailing habituel.</p>
  <table>
    <tr><th>E-mail</th><th>Date d'inscription</th><th>Actions</th></tr>
    <?php foreach ($abonnes as $ab): ?>
    <tr>
      <td><?= e($ab['email']) ?></td>
      <td><?= date('d/m/Y H:i', strtotime($ab['date_inscription'])) ?></td>
      <td><a href="newsletter.php?action=supprimer&id=<?= $ab['id'] ?>" class="btn btn-red btn-sm" onclick="return confirm('Désinscrire cette adresse ?')"><i class="fa-solid fa-trash"></i></a></td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($abonnes)): ?>
    <tr><td colspan="3">Aucun abonné pour le moment.</td></tr>
    <?php endif; ?>
  </table>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
