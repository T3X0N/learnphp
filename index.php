<?php
$test = array(1, 2, 3);
$test = [1, 2, 3, 4];
$test = ['name', true, [1,2,3], 25];
$test = [
    'name' => 'John',
    'age' => 25,
    'is_student' => true,
    'grades' => [90, 85, 92]
];
var_dump($test);
var_dump($test['name']);
