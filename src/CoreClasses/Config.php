<?php

namespace App\CoreClasses;

final class Config
{
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
        $result = '';

        if($result = array_get($this->configs, $config)) {
            return $result;
        }

        throw new \Exception('Элемент ' . $config . ' не найден в конфигурационных файлах.');
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
}
