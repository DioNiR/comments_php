<?php

namespace app\core;

use Exception;

class Registry
{
    /**
     * @var array
     */
    private array $params = [];

    /**
     * @param $key
     * @param $var
     * @return bool
     * @throws Exception
     */
    public function set($key, $var)
    {
        if (isset($this->params[$key]) == true) {
            throw new Exception('This Var is Exist');
        }

        $this->params[$key] = $var;
        return true;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (isset($this->params[$key]) == false) {
            return null;
        }

        return $this->params[$key];
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        unset($this->params[$key]);
    }
}