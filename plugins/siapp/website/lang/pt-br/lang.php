<?php return [
    'plugin' => [
        'name' => 'Website',
        'description' => 'Plugin para a gestão da aplicação',
    ],
    'website' => [
        'id' => 'id',
        'sort_order' => 'Número de Ordenação',
        'created_at' => 'Data de criação',
        'update_at' => 'Data de atualização',
        'deleted_at' => 'Data de exclusão',
    ],
    'siapp' => [
        'website' => [
            'name' => 'Nome',
            'description' => 'Descrição',
            'short_description' => 'Descrição Curta',
            'old_value' => 'Valor Antigo',
            'price' => 'Preço',
            'validate' => 'Data de validade',
            'active' => 'Ativo',
            'plans' => [
                'tab' => [
                    'title' => [
                        'general_data' => 'Dados Gerais',
                        'images' => 'Imagens',
                    ],
                ],
                'columns' => [
                    'active' => 'Ativo',
                    'name' => 'Nome do plano',
                    'short_description' => 'Descrição curta',
                    'old_price' => 'Preço Antigo',
                    'new_price' => 'Preço Atual',
                    'validate' => 'Data de validade',
                    'sort_order' => 'Ordenação',
                    'background_plan' => 'Imagem de fundo do Plano',
                    'created_at' => 'Data de criação',
                ],
                'permission' => [
                    'description' => 'Permite gerenciar os planos do site',
                    'webiste' => 'Permite o acesso ao Website',
                ],
            ],
            'menu' => [
                'plans' => 'Planos',
                'website' => 'Website',
            ],
        ],
    ],
];