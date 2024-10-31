<?php

# This Router is based on https://github.com/phprouter/main

namespace App\Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    private bool $routeMatched = false;

    /**
     * This method is designed to handle GET requests
     * @param string $route Wanted route (/about for example)
     * @param callable|string $callback
     * @return void
     */
    public function get(string $route, callable | string $callback): void
    {
        if ($this->determineMethod('GET')) {
            $this->execute($route, $callback);
        }
    }

    /**
     * This method is designed to handle POST requests
     * @param string $route Wanted route (/about for example)
     * @param callable|string $callback
     * @return void
     */
    public function post(string $route, callable | string $callback): void
    {
        if ($this->determineMethod('POST')) {
            $this->execute($route, $callback);
        }
    }

    /**
     * This method is designed to handle PUT requests
     * @param string $route Wanted route (/about for example)
     * @param callable|string $callback
     * @return void
     */
    public function put(string $route, callable | string $callback): void
    {
        if ($this->determineMethod('PUT')) {
            $this->execute($route, $callback);
        }
    }

    /**
     * This method is designed to handle DELETE requests
     * @param string $route Wanted route (/about for example)
     * @param callable|string $callback
     * @return void
     */
    public function delete(string $route, callable | string $callback): void
    {
        if ($this->determineMethod('DELETE')) {
            $this->execute($route, $callback);
        }
    }

    /**
     * This method is designed to handle PATCH requests
     * @param string $route Wanted route (/about for example)
     * @param callable|string $callback
     * @return void
     */
    public function patch(string $route, callable | string $callback): void
    {
        if ($this->determineMethod('PATCH')) {
            $this->execute($route, $callback);
        }
    }

    /**
     * This method is designed to handle undefined requests
     * @param string $route Wanted route (/about for example)
     * @param callable|string $callback
     * @return void
     */
    public function any(string $route, callable | string $callback): void
    {
        $this->execute($route, $callback);
    }

    /**
     * This method is designed to throw a 404 error
     * @param callable|string|null $callback
     * @return void
     */
    #[NoReturn] public function noMatch(callable | string $callback = null): void
    {
        http_response_code(404);

        if (!is_callable($callback)) {
            $this->errorCallback(404);
            exit();
        }

        call_user_func($callback);
        exit();
    }

    /**
     * This method is designed to get routeMatched property.
     * @return bool
     */
    public function routeMatched(): bool
    {
        return $this->routeMatched;
    }

    /**
     * This method is designed to execute the request.
     * @param string $route
     * @param callable|string $callback
     * @return void
     */
    private function execute(string $route, callable | string $callback): void
    {
        if (!is_callable($callback)) {
            exit();
        }

        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = strtok($requestUri, '?');
        $requestUri = rtrim($requestUri, '/');
        $requestUri = explode('/', $requestUri);

        $route = rtrim($route, '/');
        $route = explode('/', $route);

        array_shift($requestUri);
        array_shift($route);

        // if route is / and request uri is empty too
        if (count($requestUri) === 0 && count($route) === 0) {
            $this->routeMatched = true;
            call_user_func($callback);
            exit();
        }

        // if routes doesn't correspond
        if (count($route) != count($requestUri)) {
            return;
        }

        if (count($route) === count($requestUri)) {
            $params = [];

            foreach ($route as $index => $element) {
                if (preg_match('/{(\w)*}/', $element)) {
                    $element = str_replace(['{', '}'], '', $element);
                    $params[$element] = $requestUri[$index];

                    $element = $requestUri[$index];
                }

                // if routes doesn't correspond
                if ($element != $requestUri[$index]) {
                    return;
                }
            }

            $this->routeMatched = true;
            call_user_func_array($callback, $params);
            exit();
        }
    }

    /**
     * This method is designed to determine which HTTP method has been requested.
     * @param string $method    Wanted method
     * @return bool
     */
    private function determineMethod(string $method): bool
    {
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if ($httpMethod === 'POST') {
            if (isset($_POST['_method'])) {
                $httpMethod = $_POST['_method'];
            }
        }

        if ($httpMethod === $method) {
            return true;
        }

        return false;
    }

    /**
     * This method is a premaid error show
     * @param int $errorCode
     * @return void
     */
    private function errorCallback(int $errorCode): void
    {
        echo "<h1>Error - " . $errorCode . "</h1>";
    }
}
