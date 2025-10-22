<?php

return [
    'title' => 'Brand Template',
    'subtitle' => 'Configure your visual identity for your videos',

    'form' => [
        'brand_name' => [
            'label' => 'Brand Name',
            'placeholder' => 'Ex: Dot Creator',
        ],

        'primary_color' => [
            'label' => 'Primary Color',
        ],

        'secondary_color' => [
            'label' => 'Secondary Color',
        ],

        'preview' => [
            'label' => 'Color Preview',
            'primary' => 'Primary',
            'secondary' => 'Secondary',
            'gradient' => 'Gradient',
        ],

        'logo' => [
            'label' => 'Logo (optional)',
            'drag_drop' => 'Drag your logo here or click to browse',
            'file_types' => 'PNG, JPG, SVG (max. 2MB)',
        ],

        'buttons' => [
            'reset' => 'Reset',
            'save' => 'Save',
        ],
    ],
];
