<?php

declare(strict_types=1);

namespace Framework;

class View
{
	private string $layout = '';
	private string $title = '';

	public function __construct(
		private string $view,
		private array $data = [],
	) {
	}

	public function __toString()
	{
		$pageContent = $this->content($this->view, $this->data);
		$layoutContent = property_exists($this, 'layout') ? $this->layout($this->layout) : null;

		return str_replace('{{ content }}', $pageContent, $layoutContent);
	}

	private function layout(string $layout): bool|string
	{
		ob_start();
		include_once(LAYOUTS . "$layout.phtml");

		return ob_get_clean();
	}

	private function content(string $view, array $data): bool|string
	{
		foreach ($data as $key => $value) {
			$$key = $value;
		}

		ob_start();
		include_once(VIEWS . "$view.phtml");

		return ob_get_clean();
	}
}
