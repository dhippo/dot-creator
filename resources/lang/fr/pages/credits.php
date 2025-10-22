<?php

return [
    'title' => 'Crédits',
    'subtitle' => 'Gérez vos crédits de téléchargement',

    'current' => [
        'available' => 'Crédits disponibles',
        'download_credit' => 'Crédit de téléchargement',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Pack Starter',
            'credits' => 'crédits',
            'features' => [
                'downloads' => ':count téléchargements',
                'quality_hd' => 'Qualité HD',
                'validity' => 'Valable :days jours',
            ],
        ],
        'pro' => [
            'name' => 'Pack Pro',
            'badge' => 'Populaire',
            'credits' => 'crédits',
            'features' => [
                'downloads' => ':count téléchargements',
                'quality_hd' => 'Qualité HD',
                'validity' => 'Valable :days jours',
                'priority_support' => 'Support prioritaire',
            ],
        ],
        'business' => [
            'name' => 'Pack Business',
            'credits' => 'crédits',
            'features' => [
                'downloads' => ':count téléchargements',
                'quality_4k' => 'Qualité 4K',
                'validity' => 'Valable :days jours',
                'priority_support' => 'Support prioritaire',
            ],
        ],
    ],

    'buy_button' => 'Acheter',

    'history' => [
        'title' => 'Historique des transactions',
        'empty' => 'Aucune transaction pour le moment',
    ],
];
