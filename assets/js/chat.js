const { salao, whatsapp, servicos, datas } = window.CHAT_CONFIG;

let estado = 'inicio';
let servicoSelecionado = null;
let dataSelecionada = null;

const chatOverlay = document.getElementById('chatOverlay');
const chatBody = document.getElementById('chatBody');
const chatFooter = document.getElementById('chatFooter');
const chatClose = document.getElementById('chatClose');

function horaAtual() {
  return new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
}

function limparOpcoes() {
  chatBody.querySelectorAll('.chat-options, .price-card').forEach((el) => el.remove());
}

function desabilitarOpcoes() {
  chatBody.querySelectorAll('.chat-option').forEach((btn) => {
    btn.disabled = true;
  });
}

function scrollBottom() {
  requestAnimationFrame(() => {
    chatBody.scrollTop = chatBody.scrollHeight;
  });
}

function addMensagem(texto, tipo = 'bot') {
  const div = document.createElement('div');
  div.className = `msg msg--${tipo}`;
  div.innerHTML = `${texto}<span class="msg__time">${horaAtual()}</span>`;
  chatBody.appendChild(div);
  scrollBottom();
  return div;
}

function addDigitando() {
  const div = document.createElement('div');
  div.className = 'typing';
  div.id = 'typingIndicator';
  div.innerHTML = '<span></span><span></span><span></span>';
  chatBody.appendChild(div);
  scrollBottom();
  return div;
}

function removerDigitando() {
  const el = document.getElementById('typingIndicator');
  if (el) el.remove();
}

function botResponder(texto, callback, delay = 1200) {
  addDigitando();
  setTimeout(() => {
    removerDigitando();
    addMensagem(texto, 'bot');
    if (callback) setTimeout(callback, 400);
    scrollBottom();
  }, delay);
}

function addOpcoes(opcoes, callback) {
  const container = document.createElement('div');
  container.className = 'chat-options';

  opcoes.forEach((op) => {
    const btn = document.createElement('button');
    btn.className = 'chat-option';
    if (op.classe) btn.classList.add(op.classe);
    btn.textContent = op.label;
    btn.addEventListener('click', () => {
      desabilitarOpcoes();
      addMensagem(op.label, 'user');
      callback(op);
    });
    container.appendChild(btn);
  });

  chatBody.appendChild(container);
  scrollBottom();
}

function addCardPrecos(servico) {
  const card = document.createElement('div');
  card.className = 'price-card';
  let html = `<h4>${servico.emoji} ${servico.nome} — Tabela de preços</h4>`;
  servico.precos.forEach((p) => {
    html += `<div class="price-card__item"><span>${p.item}</span><span>${p.valor}</span></div>`;
  });
  card.innerHTML = html;
  chatBody.appendChild(card);
  scrollBottom();
}

function setFooter(texto, encerrado = false) {
  chatFooter.className = encerrado ? 'chat-footer chat-footer--ended' : 'chat-footer';
  chatFooter.innerHTML = `<p class="chat-footer__hint">${texto}</p>`;
}

function iniciarFluxo() {
  estado = 'inicio';
  servicoSelecionado = null;
  dataSelecionada = null;
  chatBody.innerHTML = '';
  setFooter('Selecione uma opção acima para continuar');

  botResponder(`Olá! 👋 Sou a <strong>assistente virtual</strong> do ${salao}.`, () => {
    botResponder('Como posso ajudar?', () => {
      mostrarEnqueteServicos();
    }, 800);
  });
}

function mostrarEnqueteServicos() {
  estado = 'escolhendo_servico';
  const opcoes = Object.entries(servicos).map(([key, s]) => ({
    id: key,
    label: `${s.emoji} ${s.nome}`,
  }));
  opcoes.push({ id: 'nao', label: '❌ Não quero agendar agora', classe: 'chat-option--decline' });

  addOpcoes(opcoes, (op) => {
    if (op.id === 'nao') {
      encerrarAtendimento();
    } else {
      servicoSelecionado = servicos[op.id];
      mostrarPrecosEDatas();
    }
  });
}

function mostrarPrecosEDatas() {
  estado = 'vendo_precos';

  botResponder(`Ótima escolha! ✨ Aqui estão os preços de <strong>${servicoSelecionado.nome}</strong>:`, () => {
    addCardPrecos(servicoSelecionado);

    botResponder('Agora, escolha uma <strong>data e horário</strong> disponível:', () => {
      estado = 'escolhendo_data';

      const opcoes = datas.map((d) => ({
        id: d.id,
        label: `📅 ${d.label}`,
        data: d,
      }));
      opcoes.push({ id: 'voltar', label: '↩️ Escolher outro serviço', classe: 'chat-option--decline' });
      opcoes.push({ id: 'nao', label: '❌ Desistir do agendamento', classe: 'chat-option--decline' });

      addOpcoes(opcoes, (op) => {
        if (op.id === 'nao') {
          encerrarAtendimento();
        } else if (op.id === 'voltar') {
          servicoSelecionado = null;
          mostrarEnqueteServicos();
        } else {
          dataSelecionada = op.data;
          confirmarAgendamento();
        }
      });
    }, 600);
  });
}

function confirmarAgendamento() {
  estado = 'confirmando';

  const msg = `Perfeito! 🎉 Você escolheu:<br><br>
    <strong>${servicoSelecionado.emoji} ${servicoSelecionado.nome}</strong><br>
    📅 ${dataSelecionada.label}`;

  botResponder(msg, () => {
    botResponder('Para <strong>finalizar seu agendamento</strong>, vou te direcionar ao WhatsApp oficial do salão. Nossa equipe confirmará seu horário por lá! 💬', () => {
      estado = 'redirecionando';

      addOpcoes(
        [{ id: 'whatsapp', label: '💬 Continuar no WhatsApp', classe: 'chat-option--whatsapp' }],
        () => redirecionarWhatsApp()
      );

      setFooter('Clique no botão acima para ir ao WhatsApp');
    });
  });
}

async function redirecionarWhatsApp() {
  botResponder('Redirecionando você para o WhatsApp... 🚀', async () => {
    setFooter('Atendimento encerrado — obrigada pela visita! 💕', true);
    estado = 'finalizado';

    try {
      const formData = new FormData();
      formData.append('servico', servicoSelecionado.nome);
      formData.append('data', dataSelecionada.label);

      const res = await fetch('api/whatsapp.php', { method: 'POST', body: formData });
      const json = await res.json();

      if (json.url) {
        setTimeout(() => window.open(json.url, '_blank'), 800);
      } else {
        const texto = encodeURIComponent(
          `Olá! Gostaria de agendar:\n\n✨ Serviço: ${servicoSelecionado.nome}\n📅 Data: ${dataSelecionada.label}\n\nAguardo confirmação! 😊`
        );
        setTimeout(() => window.open(`https://wa.me/${whatsapp}?text=${texto}`, '_blank'), 800);
      }
    } catch {
      const texto = encodeURIComponent(
        `Olá! Gostaria de agendar:\n\n✨ Serviço: ${servicoSelecionado.nome}\n📅 Data: ${dataSelecionada.label}\n\nAguardo confirmação! 😊`
      );
      setTimeout(() => window.open(`https://wa.me/${whatsapp}?text=${texto}`, '_blank'), 800);
    }
  }, 600);
}

function encerrarAtendimento() {
  estado = 'encerrado';
  limparOpcoes();

  botResponder(`Sem problemas! 😊 Agradecemos seu interesse no <strong>${salao}</strong>.`, () => {
    botResponder('Quando quiser se cuidar, estaremos aqui esperando por você. Até logo! 💕✨', () => {
      setFooter('Atendimento encerrado — volte sempre!', true);
    }, 800);
  });
}

function abrirChat() {
  chatOverlay.classList.add('active');
  chatOverlay.setAttribute('aria-hidden', 'false');
  document.body.style.overflow = 'hidden';
  iniciarFluxo();
}

function fecharChat() {
  chatOverlay.classList.remove('active');
  chatOverlay.setAttribute('aria-hidden', 'true');
  document.body.style.overflow = '';
}

['btnAgendarNav', 'btnAgendarHero', 'btnAgendarServicos', 'btnAgendarContato'].forEach((id) => {
  document.getElementById(id).addEventListener('click', abrirChat);
});

chatClose.addEventListener('click', fecharChat);

chatOverlay.addEventListener('click', (e) => {
  if (e.target === chatOverlay) fecharChat();
});

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && chatOverlay.classList.contains('active')) {
    fecharChat();
  }
});
