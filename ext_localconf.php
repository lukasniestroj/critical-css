<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Core\Page\PageRenderer::class] = [
    'className' => \LukasNiestroj\CriticalCss\XClass\PageRenderer::class
];
