<?php

/*** User: Zaz */

namespace app\core\form;

use app\core\Model;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core
 */

abstract class BaseField{

    public $model;
    public $attribute;

    public function __construct($model, string $attribute){
        $this->model = $model;
        $this->attribute = $attribute;
    }

    abstract public function renderInput(): string;

    public function __toString(){
        return sprintf('
            <div class="mb-3">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',  
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}