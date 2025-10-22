<?php

return [
    'title' => 'Réglages',
    'subtitle' => 'Gérez vos préférences et paramètres',

    'language' => [
        'title' => 'Langue',
        'description' => 'Choisissez votre langue préférée',
        'label' => 'Langue de l\'interface',
        'help' => 'Cette langue sera utilisée pour l\'ensemble de l\'application',
    ],

    'account' => [
        'title' => 'Compte',
        'description' => 'Gérez votre compte et votre session',
        'user_info' => 'Utilisateur connecté',
        'edit_profile' => 'Modifier le profil',
        'logout' => [
            'title' => 'Déconnexion',
            'description' => 'Se déconnecter de votre compte',
            'button' => 'Se déconnecter',
            'confirm' => 'Êtes-vous sûr de vouloir vous déconnecter ?',
        ],
    ],

    'notifications' => [
        'title' => 'Notifications',
        'description' => 'Gérez vos préférences de notifications',
        'email' => [
            'label' => 'Notifications par email',
            'description' => 'Recevoir des emails pour les mises à jour importantes',
        ],
        'creation' => [
            'label' => 'Notifications de création',
            'description' => 'Être notifié quand une vidéo est prête',
        ],
    ],

    'danger_zone' => [
        'title' => 'Zone de danger',
        'description' => 'Actions irréversibles sur votre compte',
        'delete_account' => [
            'title' => 'Supprimer mon compte',
            'description' => 'Supprimer définitivement votre compte et toutes vos données',
            'button' => 'Supprimer le compte',
        ],
    ],
];
