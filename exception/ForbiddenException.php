<?php
/*** User: Zaz */

namespace app\core\exception;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core\exception
 */

class ForbiddenException extends \Exception{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}