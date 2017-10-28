<?php

namespace Letscodehu;


class Application
{
    private static $instance;
    private $container;

    private function __construct(callable $config)
    {
        $this->container = new ServiceContainer($config);
    }

    public static function init(callable $config) {
        if (self::$instance == null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function start() {
        // some routing logic
        $controller = $this->container->get(ProfileController::class);
        var_dump($controller->showProfile(1));
    }

}