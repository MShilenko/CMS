<?php

namespace App\Modules\AccessControl;

use \App\Exceptions\AccessException;

class Access
{
    private $class;
    private $method;
    private $userId;
    private $behaviors;

    public function __construct(string $route)
    {
        $path            = explode('@', $route);
        $this->class     = $path[0];
        $this->method    = $path[1];
        $this->userId    = $_SESSION['userId'] ?? 0;
        $this->behaviors = $this->getBehaviors();
    }

    /**
     * Check user rights regarding class method
     * @return \AccessException|true
     */
    public function check()
    {
        if ($this->behaviors && $this->methodHasBehavior()) {
            $this->checkUserRights();
        }

        return true;
    }

    /**
     * Get the rules of behavior from the main controller
     * @param  string $class
     * @return array
     */
    private function getBehaviors(): array
    {
        $behaviors = call_user_func(['\App\Core\Controller', 'behaviors']);

        return $behaviors[$this->class] ?? [];
    }

    /**
     * Check if method has behavior
     * @return boolean
     */
    private function methodHasBehavior(): bool
    {
        return array_key_exists($this->method, $this->behaviors);
    }

    /**
     * Check user rights
     * @return \AccessException|void
     */
    private function checkUserRights()
    {
        if (!in_array($this->userId, $this->behaviors[$this->method])) {
            throw new AccessException('Доступ в данный раздел запрещен!', 503);
        }
    }
}
