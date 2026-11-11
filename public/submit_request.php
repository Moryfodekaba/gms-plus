<?php
require_once __DIR__ . '/../config/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
verify_csrf();
$name = trim((string)($_POST['full_name'] ?? ''));
$phone = trim((string)($_POST['phone'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$details = trim((string)($_POST['details'] ?? ''));
if ($name === '' || mb_strlen($name) > 150 || mb_strlen($phone) > 50 || ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL))) {
    http_response_code(422); exit('Veuillez vérifier les informations saisies.');
}
if (($_POST['form_kind'] ?? '') === 'contact') {
    if ($details === '') { http_response_code(422); exit('Le message est obligatoire.'); }
    $stmt = db()->prepare('INSERT INTO contact_messages(full_name,email,phone,message) VALUES(?,?,?,?)');
    $stmt->execute([$name, $email ?: null, $phone ?: null, $details]);
} else {
    $type = $_POST['service_type'] ?? 'Autre';
    if (!in_array($type, ['Transport','Sécurité','Autre'], true)) $type = 'Autre';
    $stmt = db()->prepare('INSERT INTO quote_requests(full_name,phone,email,service_type,origin,destination,details) VALUES(?,?,?,?,?,?,?)');
    $stmt->execute([$name,$phone,$email ?: null,$type,trim($_POST['origin'] ?? '') ?: null,trim($_POST['destination'] ?? '') ?: null,$details ?: null]);
}
header('Location: index.php?sent=1#contact'); exit;
