<?php

namespace app\controllers;

use app\core\Registry;

abstract class Controller
{
    protected Registry $registry;

    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }
}