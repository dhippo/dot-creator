<?php

return [
    'title' => 'Settings',
    'subtitle' => 'Manage your preferences and settings',

    'language' => [
        'title' => 'Language',
        'description' => 'Choose your preferred language',
        'label' => 'Interface Language',
        'help' => 'This language will be used throughout the application',
    ],

    'account' => [
        'title' => 'Account',
        'description' => 'Manage your account and session',
        'user_info' => 'Logged in user',
        'edit_profile' => 'Edit Profile',
        'logout' => [
            'title' => 'Logout',
            'description' => 'Sign out of your account',
            'button' => 'Sign Out',
            'confirm' => 'Are you sure you want to sign out?',
        ],
    ],

    'notifications' => [
        'title' => 'Notifications',
        'description' => 'Manage your notification preferences',
        'email' => [
            'label' => 'Email Notifications',
            'description' => 'Receive emails for important updates',
        ],
        'creation' => [
            'label' => 'Creation Notifications',
            'description' => 'Get notified when a video is ready',
        ],
    ],

    'danger_zone' => [
        'title' => 'Danger Zone',
        'description' => 'Irreversible actions on your account',
        'delete_account' => [
            'title' => 'Delete My Account',
            'description' => 'Permanently delete your account and all your data',
            'button' => 'Delete Account',
        ],
    ],
];
