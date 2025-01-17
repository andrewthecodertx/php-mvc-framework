<?php

declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Http\Request;
use Framework\Http\Response;

class Router
{
  private static array $routes = [];

  public static function get(string $path, callable|array $callback): void
  {
    $path = preg_replace('/\{([A-Za-z_]+)\}/', '(?<$1>[^/]+)', $path);
    self::$routes['GET'][$path] = $callback;
  }

  public static function post(string $path, callable|array $callback): void
  {
    self::$routes['POST'][$path] = $callback;
  }

  public static function dispatch(Request $request): mixed
  {
    $response = new Response;
    $method = $request->method();
    $path = $request->path();


    foreach (self::$routes[$method] as $route => $callback) {
      $pattern = '#^' . $route . '$#';
      $matches = [];

      if (preg_match($pattern, $path, $matches)) {
        $params = array_intersect_key($matches, array_flip(array_filter(array_keys($matches), 'is_string')));

        if (is_array($callback)) {
          $callback[0] = new $callback[0];
        }

        if (is_array($callback) && method_exists($callback[0], $callback[1])) {
          return call_user_func_array([$callback[0], $callback[1]], [$request, $params]);
        } elseif (is_callable($callback)) {
          return call_user_func($callback, $request, $params);
        } else {
          throw new Exception("LOOKING FOR A METHOD THAT DOESN'T EXIST!");
        }
      }
    }

    $response->setStatus(404);
    $response->setContent("RESOURCE: $path NOT FOUND!");

    return $response;
  }
}
