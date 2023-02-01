<?php

declare(strict_types = 1);

namespace Framework;

abstract class Controller
{
	public function view(string $view, array $data = []): View {
		return new View($view, $data);
	}
}
