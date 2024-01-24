<?php

declare(strict_types=1);

namespace Framework;

class Request
{
	public function path(): string
	{
		$path = $_SERVER['REQUEST_URI'] ?? '/';
		$pos = strpos($path, '?');

		if (!$pos) {
			return $path;
		}

		return substr($path, 0, $pos);
	}

	public function method(): mixed
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public function cookie(): string
	{
		return session_id();
	}

	/**
	 * @return array
	 */
	public function body(): array
	{
		$body = [];

		if ($this->method() === 'GET') {
			foreach ($_GET as $key => $value) {
				$body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		if ($this->method() === 'POST') {
			foreach ($_POST as $key => $value) {
				$body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		return $body;
	}
}
