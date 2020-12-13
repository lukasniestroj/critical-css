<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'critical css',
    'description' => 'load css asynchronously for better mobile performance',
    'category' => 'fe',
    'author' => 'Lukas Niestroj',
    'author_email' => '',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-10.9.99'
        ]
    ]
);