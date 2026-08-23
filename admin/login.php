<?php
require_once __DIR__ . '/../includes/functions.php';

if (!empty($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = trim($_POST['nom_utilisateur'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = getDB()->prepare("SELECT * FROM admin_users WHERE nom_utilisateur = ?");
    $stmt->execute([$nom_utilisateur]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['mot_de_passe'])) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nom'] = $admin['nom_utilisateur'];
        $_SESSION['admin_role'] = $admin['role'];

        $upd = getDB()->prepare("UPDATE admin_users SET derniere_connexion = NOW() WHERE id = ?");
        $upd->execute([$admin['id']]);

        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion Admin - GMS Plus</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body{font-family:Arial,sans-serif;background:#0b1f3f;display:flex;align-items:center;justify-content:center;min-height:100vh;margin:0;}
.box{background:#fff;padding:40px;border-radius:8px;max-width:380px;width:90%;box-shadow:0 20px 50px rgba(0,0,0,.3);}
h1{color:#0b1f3f;font-size:1.4rem;margin-bottom:20px;text-align:center;}
h1 span{color:#f5a623;}
input{width:100%;padding:11px;margin-bottom:14px;border:1px solid #ddd;border-radius:4px;box-sizing:border-box;}
button{width:100%;padding:12px;background:#f5a623;border:none;border-radius:4px;font-weight:700;cursor:pointer;}
.error{background:#fdecec;color:#b91c1c;padding:10px;border-radius:4px;margin-bottom:14px;font-size:.85rem;}
a.back{display:block; text-align:center; margin-top:16px; font-size:.85rem; color:#0b1f3f;}
</style>
</head>
<body>
<div class="box">
  <h1>GMS<span>+</span> Administration</h1>
  <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="POST">
    <input type="text" name="nom_utilisateur" placeholder="Nom d'utilisateur" required autofocus>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
  </form>
  <a class="back" href="../index.php">&larr; Retour au site</a>
</div>
</body>
</html>
