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
    $app = \Zend\Mvc\Application::init($appConfig);
    \Zend\EventManager\StaticEventManager::resetInstance();
    $app = null;
}


class Foo
{
    private static $bar;
}

class Bar
{
    private static $bar;
}

var_dump(array_map(
    function ($symbol) {
        return array_map(
            function (\ReflectionProperty $property) {
                return ($property->getDeclaringClass()->getName()) . '::$' . $property->getName();
            },
            array_filter(
                (new \ReflectionClass($symbol))->getProperties(),
                function (\ReflectionProperty $property) {
                    return $property->isStatic();
                }
            )
        );
    },
    array_filter(
        array_merge(get_declared_classes(), get_declared_traits()),
        function ($symbol) {
            return ! (new \ReflectionClass($symbol))->isInternal();
        }
    )
));