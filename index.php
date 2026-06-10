<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

require __DIR__ . '/includes/header.php';
?>

  <header class="hero">
    <div class="hero__content">
      <p class="hero__tag"><?= e(SALAO_TAGLINE) ?></p>
      <h1 class="hero__title">Realce sua<br><em>beleza natural</em></h1>
      <p class="hero__desc">No <?= e(SALAO_NOME) ?>, cada detalhe é pensado para você se sentir única. Cabelo, unhas, maquiagem e muito mais — com profissionais apaixonados pelo que fazem.</p>
      <div class="hero__actions">
        <button class="btn btn--primary btn--lg" id="btnAgendarHero">Agendar agora</button>
        <a href="#servicos" class="btn btn--ghost btn--lg">Ver serviços</a>
      </div>
    </div>
    <div class="hero__visual">
      <?php foreach ($heroCards as $card): ?>
      <div class="hero__card <?= e($card['classe']) ?>">
        <span class="hero__card-icon"><?= $card['emoji'] ?></span>
        <span><?= e($card['texto']) ?></span>
      </div>
      <?php endforeach; ?>
      <div class="hero__circle"></div>
    </div>
  </header>

  <section class="section sobre" id="sobre">
    <div class="section__inner">
      <div class="sobre__text">
        <p class="section__tag">Quem somos</p>
        <h2 class="section__title">Um espaço feito<br>para <em>você</em></h2>
        <p>Há mais de 10 anos transformando autoestima em arte. Nosso salão combina técnicas modernas com um atendimento acolhedor, em um ambiente elegante e relaxante no coração da cidade.</p>
        <ul class="sobre__stats">
          <li><strong>10+</strong><span>Anos de experiência</span></li>
          <li><strong>5k+</strong><span>Clientes felizes</span></li>
          <li><strong>12</strong><span>Profissionais</span></li>
        </ul>
      </div>
      <div class="sobre__image">
        <div class="sobre__image-frame">
          <div class="sobre__image-placeholder">
            <span>💆‍♀️</span>
            <p>Ambiente acolhedor<br>e sofisticado</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section servicos" id="servicos">
    <div class="section__inner section__inner--center">
      <p class="section__tag">O que fazemos</p>
      <h2 class="section__title">Nossos <em>serviços</em></h2>
      <p class="section__subtitle">Cuidado completo para cabelo, pele e unhas — com produtos premium e técnicas atualizadas.</p>
      <div class="servicos__grid">
        <?php foreach ($servicos as $servico): ?>
        <article class="servico-card">
          <div class="servico-card__icon"><?= $servico['emoji'] ?></div>
          <h3><?= e($servico['nome']) ?></h3>
          <p><?= e($servico['descricao']) ?></p>
          <span class="servico-card__price">a partir de <?= e($servico['preco_de']) ?></span>
        </article>
        <?php endforeach; ?>
      </div>
      <button class="btn btn--primary btn--lg servicos__cta" id="btnAgendarServicos">Quero agendar</button>
    </div>
  </section>

  <section class="section galeria" id="galeria">
    <div class="section__inner section__inner--center">
      <p class="section__tag">Inspiração</p>
      <h2 class="section__title">Nossos <em>trabalhos</em></h2>
      <div class="galeria__grid">
        <?php foreach ($galeria as $i => $emoji): ?>
        <div class="galeria__item galeria__item--<?= $i + 1 ?>"><span><?= $emoji ?></span></div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section contato" id="contato">
    <div class="section__inner contato__inner">
      <div class="contato__info">
        <p class="section__tag">Fale conosco</p>
        <h2 class="section__title">Venha nos <em>visitar</em></h2>
        <ul class="contato__lista">
          <li>📍 <?= e(SALAO_ENDERECO) ?></li>
          <li>📞 <?= e(SALAO_TELEFONE) ?></li>
          <li>🕐 <?= e(SALAO_HORARIO) ?></li>
          <li>📧 <?= e(SALAO_EMAIL) ?></li>
        </ul>
      </div>
      <div class="contato__cta-box">
        <h3>Pronta para se cuidar?</h3>
        <p>Agende seu horário em segundos pelo nosso assistente virtual.</p>
        <button class="btn btn--primary btn--lg btn--full" id="btnAgendarContato">Agendar pelo chat</button>
      </div>
    </div>
  </section>

<?php require __DIR__ . '/includes/footer.php'; ?>
