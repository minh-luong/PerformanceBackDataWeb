<?php
namespace App\Cores;
class Router 
{
    private $routes = [];

    public function __construct($handler = null)
    {
        if($handler !== null)
        {
            $this->get('/', $handler);
        }
    }

    protected function addRoute($method, $path, $handler, $middlewares = []) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler,
            'middlewares' => $middlewares
        ];
    }

    public function get($path, $handler, $middlewares = []) {
        $this->addRoute('GET', $path, $handler, $middlewares);
    }

    public function post($path, $handler, $middlewares = []) {
        $this->addRoute('POST', $path, $handler, $middlewares);
    }

    public function dispatch($method, $path) {
        foreach($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }
    
            // Convert route path to regex
            $pattern = preg_replace('#\{([^}]+)\}#', '([^/]+)', $route['path']);
            $pattern = "#^" . $pattern . "$#";
    
            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // remove full match
                // echo "Matched route: " . $route['path'] . " with parameters: " . implode(', ', $matches) . "\n";

                // middlewares
                foreach($route['middlewares'] as $middleware) {
                    require_once "../app/middlewares/$middleware.php";
                    $middlewareClass = "App\\Middlewares\\$middleware";
                    if (class_exists($middlewareClass)) {
                        $middlewareInstance = new $middlewareClass();
                        if (method_exists($middlewareInstance, 'handle')) {
                            $middlewareInstance->handle();
                        } else {
                            http_response_code(500);
                            echo "Middleware $middleware does not have a handle method";
                            return;
                        }
                    } else {
                        http_response_code(500);
                        echo "Middleware class $middlewareClass not found";
                        return;
                    }
                }

                // controller
                if (is_array($route['handler'])) {
                    [$controllerClass, $method] = $route['handler'];
                   
                    $parts = explode('\\', $controllerClass);
                    $controllerClassName = end($parts);
                    require_once "../app/controllers/$controllerClassName.php";

                    if (class_exists($controllerClass)) {
                        $controllerInstance = new $controllerClass();
                        if (method_exists($controllerInstance, $method)) {
                            return call_user_func_array([$controllerInstance, $method], $matches);
                        } else {
                            http_response_code(500);
                            echo "Method $method not found in controller $controllerClass";
                            return;
                        }
                    } else {
                        http_response_code(500);
                        echo "Controller class $controllerClass not found";
                        return;
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
?>