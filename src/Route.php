<?php
namespace App;

use InvalidArgumentException;

class Route {

    public function __construct(private string $method, private string $path, private $action)
    {
        if (!in_array($this->method, ['GET', 'POST'], true)) {
            throw new InvalidArgumentException('Invalid route method ' . $this->method);
        }
    }

    public function getPath() {
        return $this->path;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getAction() {
        return $this->action;
    }

    public static function get(string $path, callable|array $action) {
        Router::addRoute('GET', $path, $action);
    }

    public static function post(string $path, callable|array $action) {
        Router::addRoute('POST', $path, $action);
    }
}