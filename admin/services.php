<?php
require_once __DIR__ . '/includes/auth_check.php';
$pageTitle = "Services";
$db = getDB();
$edit = null;
$msg = '';

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'supprimer') {
    $stmt = $db->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    header('Location: services.php'); exit;
}

if (isset($_GET['action'], $_GET['id']) && $_GET['action'] === 'modifier') {
    $stmt = $db->prepare("SELECT * FROM services WHERE id = ?");
    $stmt->execute([(int)$_GET['id']]);
    $edit = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description_courte = trim($_POST['description_courte'] ?? '');
    $description_longue = trim($_POST['description_longue'] ?? '');
    $icone = trim($_POST['icone'] ?? 'fa-truck');
    $image = trim($_POST['image'] ?? 'assets/images/placeholder.jpg');
    $ordre_affichage = (int)($_POST['ordre_affichage'] ?? 0);
    $actif = isset($_POST['actif']) ? 1 : 0;
    $slug = slugify($titre);

    if ($titre !== '') {
        if (!empty($_POST['id'])) {
            $stmt = $db->prepare("UPDATE services SET titre=?, slug=?, description_courte=?, description_longue=?, icone=?, image=?, ordre_affichage=?, actif=? WHERE id=?");
            $stmt->execute([$titre, $slug, $description_courte, $description_longue, $icone, $image, $ordre_affichage, $actif, (int)$_POST['id']]);
            $msg = "Service mis à jour avec succès.";
        } else {
            $stmt = $db->prepare("INSERT INTO services (titre, slug, description_courte, description_longue, icone, image, ordre_affichage, actif) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->execute([$titre, $slug, $description_courte, $description_longue, $icone, $image, $ordre_affichage, $actif]);
            $msg = "Service ajouté avec succès.";
        }
    }
    $edit = null;
}

$services = $db->query("SELECT * FROM services ORDER BY ordre_affichage ASC")->fetchAll();
require __DIR__ . '/includes/admin-header.php';
?>
<?php if ($msg): ?><div class="alert alert-success"><?= e($msg) ?></div><?php endif; ?>

<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);"><?= $edit ? 'Modifier le service' : 'Ajouter un service' ?></h3>
  <form method="POST" class="admin-form">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
    <label>Titre</label>
    <input type="text" name="titre" value="<?= e($edit['titre'] ?? '') ?>" required>
    <label>Description courte (carte d'accueil)</label>
    <input type="text" name="description_courte" value="<?= e($edit['description_courte'] ?? '') ?>">
    <label>Description longue (page services)</label>
    <textarea name="description_longue" rows="4"><?= e($edit['description_longue'] ?? '') ?></textarea>
    <label>Icône Font Awesome (ex: fa-truck)</label>
    <input type="text" name="icone" value="<?= e($edit['icone'] ?? 'fa-truck') ?>">
    <label>Chemin de l'image (ex: assets/images/service-plateau.jpg)</label>
    <input type="text" name="image" value="<?= e($edit['image'] ?? '') ?>">
    <label>Ordre d'affichage</label>
    <input type="number" name="ordre_affichage" value="<?= e($edit['ordre_affichage'] ?? 0) ?>">
    <label><input type="checkbox" name="actif" style="width:auto;" <?= (!$edit || $edit['actif']) ? 'checked' : '' ?>> Actif (visible sur le site)</label>
    <button type="submit" class="btn btn-gold"><?= $edit ? 'Mettre à jour' : 'Ajouter' ?></button>
    <?php if ($edit): ?><a href="services.php" class="btn btn-navy">Annuler</a><?php endif; ?>
  </form>
</div>

<div class="card">
  <h3 style="margin-bottom:16px; color:var(--navy);">Liste des services</h3>
  <table>
    <tr><th>Ordre</th><th>Titre</th><th>Statut</th><th>Actions</th></tr>
    <?php foreach ($services as $s): ?>
    <tr>
      <td><?= $s['ordre_affichage'] ?></td>
      <td><?= e($s['titre']) ?></td>
      <td><span class="badge <?= $s['actif']?'badge-done':'badge-new' ?>"><?= $s['actif']?'Actif':'Inactif' ?></span></td>
      <td>
        <a href="services.php?action=modifier&id=<?= $s['id'] ?>" class="btn btn-navy btn-sm">Modifier</a>
        <a href="services.php?action=supprimer&id=<?= $s['id'] ?>" class="btn btn-red btn-sm" onclick="return confirm('Supprimer ce service ?')">Supprimer</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php require __DIR__ . '/includes/admin-footer.php'; ?>
