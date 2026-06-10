<?php
if (!defined('SALAO_NOME')) {
    require_once __DIR__ . '/../config.php';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e(SALAO_NOME) ?> — Salão de Beleza</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

  <nav class="nav">
    <div class="nav__logo"><?= e(explode(' ', SALAO_NOME)[0]) ?> <span><?= e(explode(' ', SALAO_NOME)[1] ?? '') ?></span></div>
    <ul class="nav__links">
      <li><a href="#sobre">Sobre</a></li>
      <li><a href="#servicos">Serviços</a></li>
      <li><a href="#galeria">Galeria</a></li>
      <li><a href="#contato">Contato</a></li>
    </ul>
    <button class="btn btn--primary nav__cta" id="btnAgendarNav">Agendar</button>
  </nav>
