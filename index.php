<?php

class box {
  public $width;
  public $height;
  public $depth;
  public $isopen = false;
  public $hasbeemopened = false;

  public function open() {
    if ($this->isopen) {
      echo "The box is already open.";
    } else {
      $this->isopen = true;
      $this->hasbeemopened = true;
      echo "The box is now open.";
    }
  }
}

$box1 = new box();
$box1->width = 10;
$box1->height = 5;
$box1->depth = 8;
$box1->open();
var_dump($box1);

$box2 = new box();
$box2->width = 12;
$box2->height = 6;
$box2->depth = 10;
$box2->open();
var_dump($box2);