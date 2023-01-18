<?php

declare(strict_types = 1);

namespace Framework;

use Framework\View;

abstract class Controller
{
	protected Request $request;
	protected Response $response;

	public function __construct()
	{
		$this->request = App::load()->request();
		$this->response = App::load()->response();
	}

	public function view(string $view, array $data = []): View
	{
		return new View($view, $data);
	}
}
