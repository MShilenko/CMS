<?php

namespace App\CoreClasses;

use Illuminate\Database\Capsule\Manager as Capsule;
use \App\Interfaces\Renderable;

class Application
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->initialize();
        $this->router = $router;
    }

    /**
     * Initialize the connection to the database for ORM
     */
    public function initialize()
    {
        $config  = Config::getInstance();
        $capsule = new Capsule;

        try {
            $capsule->addConnection([
                'driver'    => 'mysql',
                'host'      => $config->get('db.mysql.host'),
                'database'  => $config->get('db.mysql.name'),
                'username'  => $config->get('db.mysql.login'),
                'password'  => $config->get('db.mysql.password'),
                'charset'   => 'utf8',
                'collation' => 'utf8_general_ci',
                'prefix'    => '',
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

    }

    /**
     * Print the result of routing
     * @return view
     */
    public function run()
    {
        try {
            $dispatch = $this->router->dispatch();

            if ($dispatch instanceof Renderable) {
                return $dispatch->render();
            }

            echo $dispatch;
        } catch (\Exception $e) {
            return $this->renderException($e);
        }
    }

    /**
     * handle the exception and print
     * @param  \Exception $e
     * @return view
     */
    public function renderException(\Exception $e)
    {
        if ($e instanceof Renderable) {
            return $e->render();
        }

        http_response_code(is_int($e->getCode()) ?? INTERNAL_SERVER_ERROR);
        echo 'Ошибка: ' . $e->getMessage();
    }
}
