<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$sujet = trim($_POST['sujet'] ?? 'Message depuis le site');
$message = trim($_POST['message'] ?? '');

if ($nom === '' || $email === '' || $message === '') {
    echo json_encode(['success' => false, 'message' => 'Veuillez remplir tous les champs obligatoires.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide.']);
    exit;
}

try {
    $stmt = getDB()->prepare(
        "INSERT INTO messages_contact (nom, email, telephone, sujet, message) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$nom, $email, $telephone, $sujet, $message]);

    echo json_encode(['success' => true, 'message' => 'Merci ' . $nom . ' ! Votre message a bien été envoyé.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "Une erreur est survenue lors de l'envoi de votre message."]);
}
