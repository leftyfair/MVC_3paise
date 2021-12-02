<?php

namespace app\core\form;

use app\models\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';

    public Model $model;
    public string $attribute;
    public string $fieldName;
    public string $type;

    public function __construct(Model $model, string $attribute, string $fieldName)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
        $this->fieldName = $fieldName;
    }

    public function __toString()
    {
        $value = '';
        if ($this->type !== self::TYPE_PASSWORD) {
            $value = $this->model->{$this->attribute} ?? '';
        }
        $hasError = $this->model->hasError($this->attribute) ? 'is-invalid' : '';
        $feedback = $this->model->getFirstError($this->attribute);

        return "
        <tr>
            <td>{$this->fieldName}</td>
            <td>
                <input type='{$this->type}' name='{$this->attribute}' value='{$value}' class='{$hasError}'>
                <span class='invalid-feedback'>{$feedback}</span>
            </td>
        </tr>
        ";
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
}
?>

<style>
    .invalid-feedback {
        font-size: 12px;
        color: red;
    }

    .is-invalid {
        border: 1px solid pink;
    }
</style>