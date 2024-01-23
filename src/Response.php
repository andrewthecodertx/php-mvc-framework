<?php

declare(strict_types=1);

namespace Framework;

class Response
{
  public function __construct(
    private int $status = 200,
    private array $headers = [],
    private string $content = ''
  ) {
  }

  public function setStatus(int $code): Response
  {
    http_response_code($code);
    $this->status = $code;

    return $this;
  }

  public function status(): int
  {
    return $this->status;
  }

  public function setContent($content): Response
  {
    $this->content = $content;

    return $this;
  }

  public function content(): string
  {
    return $this->content;
  }

  public function addHeader(string $name, string $value): Response
  {
    $this->headers[$name] = $value;

    return $this;
  }

  public function headers(): array
  {
    return $this->headers;
  }

  public function send(): void
  {
    http_response_code($this->status);

    foreach ($this->headers as $name => $value) {
      header("$name, $value");
    }

    echo $this->content;
  }

  public function redirect($url, $status = 302)
  {
    $this->setStatus($status);
    $this->addHeader('Location', $url);
    $this->send();

    exit;
  }
}
