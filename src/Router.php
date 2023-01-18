<?php

declare(strict_types = 1);

namespace Framework;

class Router
{
	private array $routes = [];
	private Request $request;
	private Response $response;

	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
	}

	public function get(string $path, string|callable|array $callback): void
	{
		$this->routes['GET'][$path] = $callback;
	}

	public function post(string $path, string|callable|array $callback): void
	{
		$this->routes['POST'][$path] = $callback;
	}

	public function dispatch(): mixed
	{
		$method = $this->request->method();
		$path = $this->request->path();
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
