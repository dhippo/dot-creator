<?php

return [
    'title' => 'Credits',
    'subtitle' => 'Manage your download credits',

    'current' => [
        'available' => 'Available Credits',
        'download_credit' => 'Download Credit',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Starter Pack',
            'credits' => 'credits',
            'features' => [
                'downloads' => ':count downloads',
                'quality_hd' => 'HD Quality',
                'validity' => 'Valid for :days days',
            ],
        ],
        'pro' => [
            'name' => 'Pro Pack',
            'badge' => 'Popular',
            'credits' => 'credits',
            'features' => [
                'downloads' => ':count downloads',
                'quality_hd' => 'HD Quality',
                'validity' => 'Valid for :days days',
                'priority_support' => 'Priority Support',
            ],
        ],
        'business' => [
            'name' => 'Business Pack',
            'credits' => 'credits',
            'features' => [
                'downloads' => ':count downloads',
                'quality_4k' => '4K Quality',
                'validity' => 'Valid for :days days',
                'priority_support' => 'Priority Support',
            ],
        ],
    ],

    'buy_button' => 'Buy',

    'history' => [
        'title' => 'Transaction History',
        'empty' => 'No transactions yet',
    ],
];
