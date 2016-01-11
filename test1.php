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

for ($t = 0; $t < 50; $t++) {
    echo sprintf("%.3f start\n", memory_get_usage(true) / pow(1024, 2));
    $app = \Zend\Mvc\Application::init($appConfig);
    echo sprintf("%.3f end\n", memory_get_usage(true) / pow(1024, 2));
    \Zend\EventManager\StaticEventManager::resetInstance();
    $app = null;
}