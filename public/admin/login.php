<?php
require_once __DIR__ . '/../../config/config.php';
if (!empty($_SESSION['admin_id'])) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $stmt = db()->prepare('SELECT * FROM admins WHERE email=? LIMIT 1');
    $stmt->execute([trim($_POST['email'] ?? '')]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($_POST['password'] ?? '', $admin['password_hash'])) {
        session_regenerate_id(true); $_SESSION['admin_id'] = $admin['id']; $_SESSION['admin_name'] = $admin['name'];
        header('Location: index.php'); exit;
    }
    $error = 'Adresse email ou mot de passe incorrect.';
}
?><!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Connexion admin · GMS PLUS</title><link rel="stylesheet" href="../assets/css/style.css"></head><body class="login-page">
<form class="login-card" method="post"><div class="brand-mark">GMS+</div><h1>Administration</h1><p>Connectez-vous pour gérer votre plateforme.</p><?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>
<input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><label>Email<input type="email" name="email" required autocomplete="username"></label><label>Mot de passe<input type="password" name="password" required autocomplete="current-password"></label><button class="btn full" type="submit">Se connecter</button><a class="back-link" href="../index.php">← Retour au site</a></form></body></html>
