<?php

declare(strict_types = 1);

namespace Framework;

class Router
{
	private static array $routes = [];

	public static function get(string $path, callable|array $callback): void
	{
		self::$routes['GET'][$path] = $callback;
	}

	public static function post(string $path, callable|array $callback): void
	{
		self::$routes['POST'][$path] = $callback;
	}


	public static function dispatch(Request $request): mixed
	{
		$method = $request->method();
		$path = $request->path();
		$callback = self::$routes[$method][$path];

		if (is_null($callback)) {
            /* check to see if route is using a wildcard */
                        
            
			throw new Exception\NotFoundException;
		}

		if (is_array($callback)) {
			$callback[0] = new $callback[0];
		}

		return call_user_func($callback);
	}
}
