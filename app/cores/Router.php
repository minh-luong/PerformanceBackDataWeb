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

    protected function addRoute($method, $path, $handler) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function get($path, $handler) {
        $this->addRoute('GET', $path, $handler);
    }

    public function post($path, $handler) {
        $this->addRoute('POST', $path, $handler);
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

                if (is_string($route['handler']) && strpos($route['handler'], '@') !== false) {
                    list($controller, $method) = explode('@', $route['handler']);

                    require_once "../app/controllers/$controller.php";
                    $controllerClass = "App\\Controllers\\$controller";
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