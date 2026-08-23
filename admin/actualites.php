<?php
require_once __DIR__ . '/includes/auth_check.php';
$pageTitle = "Actualités";
$db = getDB();
$edit = null;
$msg = '';

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'supprimer') {
    $stmt = $db->prepare("DELETE FROM actualites WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    header('Location: actualites.php'); exit;
}

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'modifier') {
    $stmt = $db->prepare("SELECT * FROM actualites WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    $edit = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $extrait = trim($_POST['extrait'] ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $image = trim($_POST['image'] ?? 'assets/images/placeholder.jpg');
    $publie = isset($_POST['publie']) ? 1 : 0;
    $slug = slugify($titre);

    if ($titre !== '') {
        if (!empty($_POST['id'])) {
            $stmt = $db->prepare("UPDATE actualites SET titre=?, slug=?, extrait=?, contenu=?, image=?, publie=? WHERE id=?");
            $stmt->execute([$titre, $slug, $extrait, $contenu, $image, $publie, (int)$_POST['id']]);
            $msg = "Article mis à jour avec succès.";
        } else {
            $stmt = $db->prepare("INSERT INTO actualites (titre, slug, extrait, contenu, image, publie) VALUES (?,?,?,?,?,?)");
            $stmt->execute([$titre, $slug, $extrait, $contenu, $image, $publie]);
            $msg = "Article publié avec succès.";
        }
    }
    $edit = null;
}

$actualites = $db->query("SELECT * FROM actualites ORDER BY date_publication DESC")->fetchAll();
require __DIR__ . '/includes/admin-header.php';
?>
<?php if ($msg): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>

<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);"><?= $edit ? "Modifier l'article" : 'Publier un article' ?></h3>
  <form method="POST" class="admin-form">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= e($edit['titre'] ?? '') ?>" required>
    <label>Extrait (résumé court)</label>
    <input type="text" name="extrait" value="<?= e($edit['extrait'] ?? '') ?>">
    <label>Contenu complet</label>
    <textarea name="contenu" rows="6"><?= e($edit['contenu'] ?? '') ?></textarea>
    <label>Chemin de l'image (ex: assets/images/actu-1.jpg)</label>
    <input type="text" name="image" value="<?= e($edit['image'] ?? '') ?>">
    <label><input type="checkbox" name="publie" style="width:auto;" <?= (!$edit || $edit['publie']) ? 'checked' : '' ?>> Publié (visible sur le site)</label>
    <button type="submit" class="btn btn-gold"><?= $edit ? 'Mettre à jour' : 'Publier' ?></button>
    <?php if ($edit): ?><a href="actualites.php" class="btn btn-navy">Annuler</a><?php endif; ?>
  </form>
</div>

<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);">Tous les articles</h3>
  <table>
    <tr><th>Titre</th><th>Date</th><th>Statut</th><th>Actions</th></tr>
    <?php foreach ($actualites as $a): ?>
    <tr>
      <td><?= e($a['titre']) ?></td>
      <td><?= date('d/m/Y', strtotime($a['date_publication'])) ?></td>
      <td><span class="badge <?= $a['publie']?'badge-done':'badge-new' ?>"><?= $a['publie']?'Publié':'Brouillon' ?></span></td>
      <td>
        <a href="actualites.php?action=modifier&id=<?= $a['id'] ?>" class="btn btn-navy btn-sm">Modifier</a>
        <a href="actualites.php?action=supprimer&id=<?= $a['id'] ?>" class="btn btn-red btn-sm" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
