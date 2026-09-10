<?php

$test = function (){
  var_dump('test');
};

var_dump($test);
$test();
call_user_func($test);

$numbers = [1, 2, 3, 4, 5];
$squares = array_map(function ($n) {
  return $n * $n;
}, $numbers);
var_dump($squares);

$squares2 = array_map(fn($n) => $n * $n, $numbers);
var_dump($squares2);