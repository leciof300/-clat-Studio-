<?php

define('SALAO_NOME', 'Éclat Studio');
define('SALAO_TAGLINE', 'Beleza & Bem-estar');
define('WHATSAPP_NUMERO', '5511999887766'); // fictício para teste

define('SALAO_ENDERECO', 'Rua das Flores, 123 — Centro, São Paulo');
define('SALAO_TELEFONE', '(11) 3456-7890');
define('SALAO_HORARIO', 'Seg–Sáb: 9h às 19h');
define('SALAO_EMAIL', 'contato@eclatstudio.com.br');

$servicos = [
    [
        'id' => 'corte',
        'nome' => 'Corte & Escova',
        'emoji' => '✂️',
        'descricao' => 'Cortes modernos, escovas modeladoras e finalizações impecáveis para qualquer ocasião.',
        'preco_de' => 'R$ 80',
        'precos' => [
            ['item' => 'Corte feminino', 'valor' => 'R$ 80'],
            ['item' => 'Corte masculino', 'valor' => 'R$ 50'],
            ['item' => 'Escova modeladora', 'valor' => 'R$ 60'],
            ['item' => 'Corte + Escova', 'valor' => 'R$ 120'],
        ],
    ],
    [
        'id' => 'coloracao',
        'nome' => 'Coloração',
        'emoji' => '🎨',
        'descricao' => 'Mechas, balayage, tintura e tratamentos de cor com produtos de alta performance.',
        'preco_de' => 'R$ 150',
        'precos' => [
            ['item' => 'Tintura completa', 'valor' => 'R$ 150'],
            ['item' => 'Mechas / Balayage', 'valor' => 'R$ 280'],
            ['item' => 'Luzes', 'valor' => 'R$ 220'],
            ['item' => 'Tonalização', 'valor' => 'R$ 90'],
        ],
    ],
    [
        'id' => 'manicure',
        'nome' => 'Manicure & Pedicure',
        'emoji' => '💅',
        'descricao' => 'Esmaltação em gel, alongamento, spa dos pés e nail art personalizada.',
        'preco_de' => 'R$ 45',
        'precos' => [
            ['item' => 'Manicure tradicional', 'valor' => 'R$ 45'],
            ['item' => 'Pedicure spa', 'valor' => 'R$ 65'],
            ['item' => 'Esmaltação em gel', 'valor' => 'R$ 80'],
            ['item' => 'Combo mão + pé', 'valor' => 'R$ 100'],
        ],
    ],
    [
        'id' => 'maquiagem',
        'nome' => 'Maquiagem',
        'emoji' => '💄',
        'descricao' => 'Maquiagem social, para festas, noivas e ensaios — realçando sua beleza natural.',
        'preco_de' => 'R$ 120',
        'precos' => [
            ['item' => 'Maquiagem social', 'valor' => 'R$ 120'],
            ['item' => 'Maquiagem para festa', 'valor' => 'R$ 180'],
            ['item' => 'Maquiagem de noiva', 'valor' => 'R$ 350'],
            ['item' => 'Apenas olhos', 'valor' => 'R$ 70'],
        ],
    ],
    [
        'id' => 'sobrancelha',
        'nome' => 'Design de Sobrancelhas',
        'emoji' => '👁️',
        'descricao' => 'Design com pinça, henna, micropigmentação e laminação para olhar marcante.',
        'preco_de' => 'R$ 35',
        'precos' => [
            ['item' => 'Design com pinça', 'valor' => 'R$ 35'],
            ['item' => 'Henna', 'valor' => 'R$ 50'],
            ['item' => 'Laminação', 'valor' => 'R$ 80'],
            ['item' => 'Design + Henna', 'valor' => 'R$ 70'],
        ],
    ],
    [
        'id' => 'tratamento',
        'nome' => 'Tratamentos Capilares',
        'emoji' => '🌿',
        'descricao' => 'Hidratação profunda, reconstrução, botox capilar e cronograma capilar.',
        'preco_de' => 'R$ 90',
        'precos' => [
            ['item' => 'Hidratação profunda', 'valor' => 'R$ 90'],
            ['item' => 'Reconstrução', 'valor' => 'R$ 110'],
            ['item' => 'Botox capilar', 'valor' => 'R$ 200'],
            ['item' => 'Cronograma capilar', 'valor' => 'R$ 250'],
        ],
    ],
];

$heroCards = [
    ['emoji' => '✂️', 'texto' => 'Corte & Coloração', 'classe' => 'hero__card--1'],
    ['emoji' => '💅', 'texto' => 'Manicure & Pedicure', 'classe' => 'hero__card--2'],
    ['emoji' => '✨', 'texto' => 'Maquiagem', 'classe' => 'hero__card--3'],
];

$galeria = ['🌸', '💇‍♀️', '💅', '✨'];
