<?php

function hello(): void {
    var_dump("Hello, World!");
}
hello();

function helloName(string $name, int $age): void {
    var_dump("Hello, $name! You are $age years old.");
}
helloName("Alice", 30);

function square(int $number): int {
    if ($number < 0) {
        $number = -$number;
    }

    return $number * $number;
}
$answer = square(5);
var_dump($answer);

function recursion($i) {
    if ($i < 20) {
        var_dump($i);
        recursion($i + 1);
    }
    }

    recursion(0);