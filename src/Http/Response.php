<?php

declare(strict_types=1);

namespace Framework\Http;

class Response
{
  protected array $headers = [];
  protected string $content = '';
  protected int $statusCode;
  protected string $contentType = 'text/html';
  protected ?string $charset = 'UTF-8';

  protected const STATUS_TEXTS = [
    200 => 'OK',
    201 => 'Created',
    204 => 'No Content',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    422 => 'Unprocessable Entity',
    500 => 'Internal Server Error',
  ];

  public function __construct(string|array $content = '', int $status = 200, array $headers = [])
  {
    $this->statusCode = $status;
    $this->headers = $headers;

    if (is_array($content)) {
      $this->json($content);
    } else {
      $this->content = $content;
    }
  }

  public function setContent(string $content): self
  {
    $this->content = $content;
    return $this;
  }

  public function json(array $data): self
  {
    $this->content = json_encode($data, JSON_THROW_ON_ERROR);
    $this->contentType = 'application/json';
    return $this;
  }

  public function setStatus(int $status): self
  {
    $this->statusCode = $status;
    return $this;
  }

  public function setHeader(string $key, string|array $value): self
  {
    $this->headers[$key] = is_array($value) ? $value : [$value];
    return $this;
  }

  public function setHeaders(array $headers): self
  {
    foreach ($headers as $key => $value) {
      $this->setHeader($key, $value);
    }
    return $this;
  }

  public function removeHeader(string $key): self
  {
    unset($this->headers[$key]);
    return $this;
  }

  public function setContentType(string $contentType, ?string $charset = null): self
  {
    $this->contentType = $contentType;
    if ($charset !== null) {
      $this->charset = $charset;
    }
    return $this;
  }

  public function redirect(string $url, int $status = 302): self
  {
    $this->statusCode = $status;
    $this->setHeader('Location', $url);
    return $this;
  }

  public function setCookie(
    string $name,
    string $value,
    int $expires = 0,
    string $path = '/',
    string $domain = '',
    bool $secure = false,
    bool $httpOnly = true,
    string $sameSite = 'Lax'
  ): self {
    $cookie = sprintf(
      '%s=%s; path=%s; HttpOnly=%s; SameSite=%s',
      urlencode($name),
      urlencode($value),
      $path,
      $httpOnly ? 'true' : 'false',
      $sameSite
    );

    if ($expires > 0) {
      $cookie .= '; expires=' . gmdate('D, d-M-Y H:i:s T', $expires);
    }
    if ($domain) {
      $cookie .= '; domain=' . $domain;
    }
    if ($secure) {
      $cookie .= '; secure';
    }

    $this->setHeader('Set-Cookie', $cookie);
    return $this;
  }

  public function noCache(): self
  {
    return $this->setHeaders([
      'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
      'Pragma' => 'no-cache',
      'Expires' => '0',
    ]);
  }

  protected function sendHeaders(): void
  {
    if (headers_sent()) {
      return;
    }

    // Send status header
    header(sprintf(
      'HTTP/1.1 %s %s',
      $this->statusCode,
      self::STATUS_TEXTS[$this->statusCode] ?? ''
    ));

    // Set content type with charset
    if ($this->charset) {
      header("Content-Type: {$this->contentType}; charset={$this->charset}");
    } else {
      header("Content-Type: {$this->contentType}");
    }

    // Send custom headers
    foreach ($this->headers as $name => $values) {
      foreach ((array)$values as $value) {
        header("$name: $value", false);
      }
    }
  }

  public function send(): never
  {
    $this->sendHeaders();
    echo $this->content;
    exit;
  }

  // Helper methods for common responses
  public static function ok(string|array $content = ''): self
  {
    return new self($content, 200);
  }

  public static function created(string|array $content = ''): self
  {
    return new self($content, 201);
  }

  public static function notFound(string|array $content = 'Not Found'): self
  {
    return new self($content, 404);
  }

  public static function error(string|array $content = 'Internal Server Error'): self
  {
    return new self($content, 500);
  }
}
