<?php

declare(strict_types=1);

namespace Framework\Http;

class Response
{
  public function __construct(
    private array $headers = [],
    private string $content = '',
    private int $status = 200
  ) {
  }

  public function setStatus(int $code): Response
  {
    $this->status = $code;

    return $this;
  }

  public function getStatus(): int
  {
    return $this->status;
  }

  public function setContent(string $content): Response
  {
    $this->content = $content;

    return $this;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function addHeader(string $name, string $value): Response
  {
    $this->headers[$name] = $value;

    return $this;
  }

  public function getHeaders(): array
  {
    return $this->headers;
  }

  public function send(): void
  {
    foreach ($this->headers as $name => $value) {
      header("$name: $value");
    }

    echo $this->content;
  }

  public function redirect($url, $status = 302): Response
  {
    $response = clone $this;
    $this->setStatus($status);
    $this->addHeader('Location', $url);
    $this->send();

    return $response;
  }

  /* these are for testing and debugging */
  public function getOutput()
  {
    ob_start();
    $this->send();
    $output = ob_get_clean();

    return $output;
  }
}
