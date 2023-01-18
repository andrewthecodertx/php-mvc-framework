<?php

declare(strict_types = 1);

namespace Framework;

use Framework\Config;
use Throwable;

class App
{
	private static App $instance;
	private static Config $config;
	private Request $request;
	private Response $response;
	private Router $router;

	public function __construct()
	{
		self::$instance = $this;
		$this->request = new Request;
		$this->response = new Response;
		$this->router = new Router($this->request, $this->response);
	}

	public static function config(): Config
	{
		return self::$config;
	}

	public static function load(): self
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
			echo $this->router->dispatch();
		} catch (Throwable $e) {
			App::load()->response()->setStatus((int)$e->getCode());
			echo new View('_error', ['error' => $e]);
		}
	}
}
