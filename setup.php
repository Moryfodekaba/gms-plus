<?php
require_once __DIR__ . '/config/database.php';

$db = getDB();
$count = $db->query("SELECT COUNT(*) AS n FROM admin_users")->fetch()['n'];

$error = '';
$success = '';

if ($count > 0) {
    $error = "Un compte administrateur existe déjà. Supprimez-le dans phpMyAdmin (table admin_users) si vous souhaitez recréer ce script.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = trim($_POST['nom_utilisateur'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($nom_utilisateur === '' || $email === '' || $password === '') {
        $error = "Tous les champs sont obligatoires.";
    } elseif ($password !== $password2) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare("INSERT INTO admin_users (nom_utilisateur, mot_de_passe, email, role) VALUES (?, ?, ?, 'super_admin')");
        $stmt->execute([$nom_utilisateur, $hash, $email]);
        $success = "Compte administrateur créé avec succès ! Vous pouvez maintenant vous connecter.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Installation - GMS Plus</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family:Arial,sans-serif;background:#0b1f3f;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}
.box{background:#fff;padding:40px;border-radius:8px;max-width:420px;width:90%;box-shadow:0 20px 50px rgba(0,0,0,.3);}
h1{color:#0b1f3f;font-size:1.4rem;margin-bottom:6px;}
p.sub{color:#666;font-size:.85rem;margin-bottom:20px;}
input{width:100%;padding:11px;margin-bottom:12px;border:1px solid #ddd;border-radius:4px;box-sizing:border-box;}
button{width:100%;padding:12px;background:#f5a623;border:none;border-radius:4px;font-weight:700;cursor:pointer;}
.msg{padding:12px;border-radius:4px;margin-bottom:16px;font-size:.88rem;}
.error{background:#fdecec;color:#b91c1c;}
.success{background:#e8f7ec;color:#1c7c3c;}
a.login-link{display:block;text-align:center;margin-top:14px;color:#0b1f3f;font-weight:700;}
</style>
</head>
<body>
<div class="box">
  <h1>GMS Plus — Installation</h1>
  <p class="sub">Créez votre compte administrateur pour accéder au panneau de gestion.</p>
  <?php if ($error): ?><div class="msg error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <?php if ($success): ?><div class="msg success"><?= htmlspecialchars($success) ?></div><?php endif; ?>

  <?php if ($count === 0 && !$success): ?>
  <form method="POST">
    <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Mot de passe (min. 6 caractères)" required>
    <input type="password" name="password2" placeholder="Confirmer le mot de passe" required>
    <button type="submit">Créer le compte administrateur</button>
  </form>
  <?php endif; ?>

  <a class="login-link" href="admin/login.php">Aller à la page de connexion &rarr;</a>
</div>
</body>
</html>
