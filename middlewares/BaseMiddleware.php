<?php

/*** User: Zaz */

namespace app\core\middlewares;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core\middlewares
 */

abstract class BaseMiddleware{
    abstract public function execute();
}