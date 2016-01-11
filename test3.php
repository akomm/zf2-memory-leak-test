<?php

include_once __DIR__ . '/vendor/autoload.php';

$appConfig = $appConfig = array(
    'modules' => array(),
    'module_listener_options' => array(
        'module_paths' => array(
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
    )
);

if (!is_dir(__DIR__ . '/trace')) {
    mkdir(__DIR__ . '/trace');
}

ini_set('xdebug.show_mem_delta', '1');

for ($t = 0; $t < 5; $t++) {
    xdebug_start_trace(sprintf('%s/trace/%d', __DIR__ , $t + 1));
    $app = \Zend\Mvc\Application::init($appConfig);
    xdebug_stop_trace();
    \Zend\EventManager\StaticEventManager::resetInstance();
    $app = null;
}