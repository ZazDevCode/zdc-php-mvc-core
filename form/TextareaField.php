<?php
/*** User: Zaz */

namespace app\core\form;

/**
 *
 * @author Zaz <s@scha.nl>
 * @package app\core
 */

class TextareaField extends BaseField{
    public function renderInput(): string{
        return sprintf('<textarea name"%s" class="form-control%s">%s</textarea>',
            $this->attribute, 
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->model->{$this->attribute},
        );
    }
}