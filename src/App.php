<?php

declare(strict_types = 1);

namespace Framework;

use Throwable;

class App
{
	private static App $instance;
	private Request $request;
	private Response $response;
	private Router $router;

	public function __construct()
	{
		self::$instance = $this;
		$this->request = new Request;
		$this->response = new Response;
		$this->router = new Router;
	}

	public static function load(): App
	{
		return self::$instance;
	}

	public function request(): Request
	{
		return $this->request;
	}

	public function response(): Response
	{
		return $this->response;
	}

	public function get(string $path, $callback): void
	{
		$this->router->get($path, $callback);
	}

	public function post(string $path, $callback): void
	{
		$this->router->post($path, $callback);
	}

	public function run(): void
	{
		try {
			echo $this->router->dispatch(self::$request, self::$response);
		} catch (Throwable $e) {
			App::load()->response()->setStatus((int)$e->getCode());
			echo new View('_error', ['error' => $e]);
		}
	}
}
