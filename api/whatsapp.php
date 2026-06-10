<?php

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['erro' => 'Método não permitido']);
    exit;
}

$servico = trim($_POST['servico'] ?? '');
$dataLabel = trim($_POST['data'] ?? '');

if ($servico === '' || $dataLabel === '') {
    http_response_code(400);
    echo json_encode(['erro' => 'Serviço e data são obrigatórios']);
    exit;
}

echo json_encode([
    'url' => montarUrlWhatsApp($servico, $dataLabel),
], JSON_UNESCAPED_UNICODE);
