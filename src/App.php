<?php

declare(strict_types = 1);

namespace Framework;

use Throwable;

class App
{
  private static App $instance;
  private Request $request;

  public function __construct()
	{
    self::$instance = $this;
	}

  public static function init(): App
  {
    return self::$instance;  
  }

  public function request(): Request
  {
    return $this->request;
  }

	public function run(Request $request): void
	{
    $this->request = $request;

		try {
			echo Router::dispatch($request);
		} catch (Throwable $e) {
			echo new View('_error', ['error' => $e]);
		}
	}
}
