<?php

declare(strict_types = 1);

namespace Framework;

class Router
{
	private static array $routes = [];

	public static function get(string $path, string|callable|array $callback): void
	{
		self::$routes['GET'][$path] = $callback;
	}

	public static function post(string $path, string|callable|array $callback): void
	{
		self::$routes['POST'][$path] = $callback;
	}

	public function dispatch(Request $request, Response $response): mixed
	{
		$method = $request->method();
		$path = $request->path();
		$callback = $this->routes[$method][$path];

		if (is_null($callback)) {
			throw new Exception\NotFoundException;
		}

		if (is_string($callback)) {
			return new View($callback);
		}

		if (is_array($callback)) {
			$callback[0] = new $callback[0];
		}

		return call_user_func($callback);
	}
}
