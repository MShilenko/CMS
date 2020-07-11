<?php

namespace App\Modules\AccessControl;

use App\Exceptions\AccessException;
use App\Models\User;

class Access
{
    private $class;
    private $method;
    private $userId;
    private $behaviors;

    public function __construct(string $route)
    {
        $path = explode('@', $route);
        $this->class = $path[0];
        $this->method = $path[1];
        $this->userId = $_SESSION['userId'] ?? 0;
        $this->behaviors = $this->getBehaviors();
    }

    /**
     * Check user rights regarding class method
     * @return \AccessException|true
     */
    public function check()
    {
        if ($this->behaviors && $this->functionHasBehavior()) {
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
    private function functionHasBehavior(): bool
    {
        return array_key_exists($this->method, $this->behaviors);
    }

    /**
     * Check user rights
     * @return \AccessException|void
     */
    private function checkUserRights()
    {
        if (!$this->userId || $this->checkRoles()) {
            throw new AccessException(MSG_FORBIDDEN, 403);
        }
    }

    /**
     * Check for the role
     * @return boolean
     */
    private function checkRoles(): bool
    {
        return !(bool) array_intersect(User::findOrFail($this->userId)->roles->pluck('id')->toArray(), $this->behaviors[$this->method]);
    }
}
