  <div class="chat-overlay" id="chatOverlay" aria-hidden="true">
    <div class="chat-window" role="dialog" aria-label="Assistente virtual de agendamento">
      <header class="chat-header">
        <button class="chat-header__back" id="chatClose" aria-label="Fechar chat">←</button>
        <div class="chat-header__avatar">🤖</div>
        <div class="chat-header__info">
          <strong>Assistente Virtual</strong>
          <span class="chat-header__status">online</span>
        </div>
      </header>
      <div class="chat-body" id="chatBody"></div>
      <footer class="chat-footer" id="chatFooter">
        <p class="chat-footer__hint">Selecione uma opção acima para continuar</p>
      </footer>
    </div>
  </div>

  <script>
    window.CHAT_CONFIG = <?= json_encode([
        'salao' => SALAO_NOME,
        'whatsapp' => WHATSAPP_NUMERO,
        'servicos' => servicosParaChat($servicos),
        'datas' => gerarDatasDisponiveis(),
    ], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS) ?>;
  </script>
  <script src="assets/js/chat.js"></script>
