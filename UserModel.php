<?php
/*** User: Zaz */

namespace app\core;

use app\core\db\DbModel;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core
 */

abstract class UserModel extends DbModel{
    abstract public function getDisplayName(): string;
}