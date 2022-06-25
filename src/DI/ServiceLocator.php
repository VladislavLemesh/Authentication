<?php

namespace App\DI;

class ServiceLocator
{
    private array $services;

    public function set(string $name, $service)
    {
        $this->services[$name] = $service;
    }

    public function get(string $name)
    {
        if (is_callable($this->services[$name])) {
            $this->services[$name] = $this->services[$name]($this);
        }

        return $this->services[$name];
    }
}
