<?php
require_once __DIR__ . '/includes/auth_check.php';
$pageTitle = "Messages de contact";
$db = getDB();

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'lu') {
    $stmt = $db->prepare("UPDATE messages_contact SET lu = 1 WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    header('Location: messages.php'); exit;
}
if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'supprimer') {
    $stmt = $db->prepare("DELETE FROM messages_contact WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    header('Location: messages.php'); exit;
}

$messages = $db->query("SELECT * FROM messages_contact ORDER BY date_envoi DESC")->fetchAll();
require __DIR__ . '/includes/admin-header.php';
?>
<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);">Messages reçus (<?= count($messages) ?>)</h3>
  <table>
    <tr><th>Nom</th><th>Contact</th><th>Sujet</th><th>Message</th><th>Date</th><th>Statut</th><th>Actions</th></tr>
    <?php foreach ($messages as $m): ?>
    <tr>
      <td><?= e($m['nom']) ?></td>
      <td><?= e($m['email']) ?><br><?= e($m['telephone']) ?></td>
      <td><?= e($m['sujet']) ?></td>
      <td style="max-width:220px;"><?= e(mb_strimwidth($m['message'], 0, 90, '...')) ?></td>
      <td><?= date('d/m/Y H:i', strtotime($m['date_envoi'])) ?></td>
      <td><span class="badge <?= $m['lu'] ? 'badge-done' : 'badge-new' ?>"><?= $m['lu'] ? 'Lu' : 'Non lu' ?></span></td>
      <td>
        <?php if (!$m['lu']): ?><a href="messages.php?action=lu&id=<?= $m['id'] ?>" class="btn btn-navy btn-sm">Marquer lu</a><?php endif; ?>
        <a href="messages.php?action=supprimer&id=<?= $m['id'] ?>" class="btn btn-red btn-sm" onclick="return confirm('Supprimer ce message ?')"><i class="fa-solid fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
    <?php if (empty($messages)): ?>
    <tr><td colspan="7">Aucun message reçu.</td></tr>
    <?php endif; ?>
  </table>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
