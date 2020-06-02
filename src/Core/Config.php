<?php

namespace App\Core;

final class Config
{
    // Implementation of the Singltone pattern

    /** @var Config */
    private static $instance;

    public static function getInstance(): Config
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    private function __clone()
    {}
    private function __wakeup()
    {}

    // Logic to build configurations

    private $configs = [];

    private function __construct()
    {
        $this->configs = $this->getConfigs();
    }

    /**
     * Get the key value from the array
     * @param  string $key
     * @param  $default
     * @return string|$default
     */
    public function get($config, $default = null)
    {
        return array_get($this->configs, $config) ?? $default;
    }

    /**
     * Collect array of configuration files
     * @return array $result
     */
    private function getConfigs(): array
    {
        $result = [];
        $files  = scandir(CONFIG_DIR);

        foreach ($files as $file) {
            if (preg_match('#^(.*)\.php$#', $file, $fileName)) {
                $result[$fileName[1]] = include_once CONFIG_DIR . "/$file";
            }
        }

        return $result;
    }
}
