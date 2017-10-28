<?php

namespace Letscodehu;


class ServiceContainer {

    private $container = [];

    public function __construct(callable $config) {
        $config($this);
    }

    public function get($serviceName) {
        if (array_key_exists($serviceName, $this->container)) {
            $service = $this->container[$serviceName];
            if (is_callable($service)) {
                $this->container[$serviceName] = $service($this);
            }
            return $this->container[$serviceName];
        } else throw new \InvalidArgumentException("Error getting '$serviceName', no such service bound!");
    }

    public function put($serviceName, $instance) {
        if (!is_object($instance)) {
            throw new \InvalidArgumentException("You must provide an instance!");
        }
        $this->container[$serviceName] = $instance;
    }

    public function bind($serviceName, $serviceDefinition) {
        if (!is_callable($serviceDefinition)) {
            throw new \InvalidArgumentException("You must provide a callable!");
        }
        $this->container[$serviceName] = $serviceDefinition;
    }

}
