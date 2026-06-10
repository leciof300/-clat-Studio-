<?php

function gerarDatasDisponiveis(int $diasUteis = 8, array $horarios = ['09:00', '11:00', '14:00', '16:00']): array
{
    $diasSemana = ['dom', 'seg', 'ter', 'qua', 'qui', 'sex', 'sáb'];
    $datas = [];
    $hoje = new DateTime();
    $offset = 1;
    $count = 0;

    while ($count < $diasUteis) {
        $data = clone $hoje;
        $data->modify("+{$offset} days");

        if ((int) $data->format('w') === 0) {
            $offset++;
            continue;
        }

        $dataStr = $data->format('Y-m-d');
        $diaLabel = $diasSemana[(int) $data->format('w')];
        $dataFormatada = $data->format('d/m');

        foreach ($horarios as $hora) {
            $datas[] = [
                'id' => "{$dataStr}-{$hora}",
                'label' => "{$diaLabel}, {$dataFormatada} às {$hora}",
                'data' => $dataStr,
                'hora' => $hora,
            ];
        }

        $count++;
        $offset++;
    }

    return $datas;
}

function montarUrlWhatsApp(string $servico, string $dataLabel): string
{
    $mensagem = "Olá! Gostaria de agendar:\n\n"
        . "✨ Serviço: {$servico}\n"
        . "📅 Data: {$dataLabel}\n\n"
        . "Aguardo confirmação! 😊";

    return 'https://wa.me/' . WHATSAPP_NUMERO . '?text=' . rawurlencode($mensagem);
}

function servicosParaChat(array $servicos): array
{
    $mapa = [];
    foreach ($servicos as $s) {
        $mapa[$s['id']] = [
            'nome' => $s['nome'],
            'emoji' => $s['emoji'],
            'precos' => $s['precos'],
        ];
    }
    return $mapa;
}

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}
