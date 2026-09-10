<?php

class box {
  public $width;
  public $height;
  public $depth;
  public $isopen = false;
  public $hasbeemopened = false;

  public function open() {
    $this->isopen = true;
  }

  $num1 = 5;
  $num2 = 10;
  $num1 = $num2;
  var_dump($num1, $num2);

  $box1 = new box();
  $box1->width = 1;
  $box2 = clone $box1;
  $box1->width = 2;
  var_dump($box1, $box2);

$numbers = [1, 2, 3, 4, 5];

foreach ($numbers as $number) {
  $number+=1;
  var_dump($number);
}