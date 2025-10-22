<?php

return [
    'title' => 'Modèle de marque',
    'subtitle' => 'Configurez votre identité visuelle pour vos vidéos',

    'form' => [
        'brand_name' => [
            'label' => 'Nom de la marque',
            'placeholder' => 'Ex: Dot Creator',
        ],

        'primary_color' => [
            'label' => 'Couleur principale',
        ],

        'secondary_color' => [
            'label' => 'Couleur secondaire',
        ],

        'preview' => [
            'label' => 'Aperçu des couleurs',
            'primary' => 'Primaire',
            'secondary' => 'Secondaire',
            'gradient' => 'Dégradé',
        ],

        'logo' => [
            'label' => 'Logo (optionnel)',
            'drag_drop' => 'Glissez votre logo ici ou cliquez pour parcourir',
            'file_types' => 'PNG, JPG, SVG (max. 2MB)',
        ],

        'buttons' => [
            'reset' => 'Réinitialiser',
            'save' => 'Enregistrer',
        ],
    ],
];
