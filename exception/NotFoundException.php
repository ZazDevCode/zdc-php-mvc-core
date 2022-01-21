<?php

/*** User: Zaz */

namespace app\core\exception;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core\exception
 */

class NotFoundException extends \Exception{
    protected $message = 'Page not found';
    protected $code = 404;  
}