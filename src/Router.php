<?php

declare(strict_types = 1);

namespace Framework;

class Router
{
	private static array $routes = [];

	public static function get(string $path, callable|array $callback): void {
		self::$routes['GET'][$path] = $callback;
	}

	public static function post(string $path, callable|array $callback): void {
		self::$routes['POST'][$path] = $callback;
	}


	public static function dispatch(Request $request): mixed {
		$method = $request->method();
		$path = $request->path();

        /**
         * 
         * Check the routes array for the path being passed in
         * If not, check for wildcards (/route/{id})
         *
         */ 

        if (!in_array($path, self::$routes[$method])) {

        }

		$callback = self::$routes[$method][$path];

        print_r($path);
        var_dump(self::$routes);

		if (is_null($callback)) {
			throw new Exception\NotFoundException;
		}

		if (is_array($callback)) {
			$callback[0] = new $callback[0];
		}

		return call_user_func($callback);
	}
}
