<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Méthode non autorisée.']);
    exit;
}

$email = trim($_POST['email'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide.']);
    exit;
}

try {
    $stmt = getDB()->prepare("SELECT id FROM newsletter WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Cette adresse est déjà inscrite.']);
        exit;
    }

    $stmt = getDB()->prepare("INSERT INTO newsletter (email) VALUES (?)");
    $stmt->execute([$email]);

    echo json_encode(['success' => true, 'message' => 'Merci ! Vous êtes désormais inscrit(e) à notre newsletter.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => "Une erreur est survenue. Veuillez réessayer."]);
}
