<?php

namespace app\core\form;

use app\models\Model;

class Form
{
    public static function begin($action, $method)
    {
        echo "<form action='{$action}' method='{$method}'>";
        return new Form();
    }

    public function end()
    {
        echo "</form>";
    }

    public function field(Model $model, string $attribute, string $fieldName)
    {
        return new Field($model, $attribute, $fieldName);
    }
}
