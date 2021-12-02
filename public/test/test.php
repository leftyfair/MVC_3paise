<?php
class Test
{
    public $productName;
    public $color;

    private function __construct($productName, $color)
    {
        $this->productName = $productName;
        $this->color = $color;
    }

    public function __toString()
    {
        return "
        productName: {$this->productName} <br>
        color: {$this->color} <br>
        ";
    }

    public static function GenerateObj($productName, $color)
    {
        return new Test($productName, $color);
    }
}

$test = Test::GenerateObj('자동차', 'red');
echo $test;
