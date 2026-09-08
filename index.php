<?php
$number = 10;
if ($number > 0) {
var_dump('bigger');
}
if ($number > 0) {
var_dump('bigger');
}
else {
var_dump('smaller');
}

if ($number > 0) {
var_dump('bigger');
}else if ($number < 10) {
var_dump('smaller');
}else {
var_dump('equal');
}

$day = (int)date('w');
$day = intval(date('w'));
var_dump($day);
if ($day == 0) {
var_dump('Sunday');
}
else if ($day == 1) {
var_dump('Monday');
}
else if ($day == 2) {
var_dump('Tuesday');
}
else if ($day == 3) {
var_dump('Wednesday');
}
else if ($day == 4) {
var_dump('Thursday');
}
else if ($day == 5) {
var_dump('Friday');
}
else if ($day == 6) {
var_dump('Saturday');
}
var_dump('weird');

switch ($day) {
    case 0:
        var_dump('Sunday');
        break;
    case 1:
        var_dump('Monday');
        break;
    case 2:
        var_dump('Tuesday');
        break;
    case 3:
        var_dump('Wednesday');
        break;
    case 4:
        var_dump('Thursday');
        break;
    case 5:
    case 6:
        var_dump('Friday');
        break;
    case 6:
        var_dump('Saturday');
        break;
}