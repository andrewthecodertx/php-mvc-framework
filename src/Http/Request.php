<?php

declare(strict_types=1);

namespace Framework\Http;

class Request
{
  protected string $method;
  protected string $uri;
  protected array $headers;
  protected array $query;
  protected array $post;
  protected array $files;
  protected array $cookies;
  protected ?string $content;
  protected array $json;

  public function __construct()
  {
    $this->method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
    $this->uri = $_SERVER['REQUEST_URI'] ?? '/';
    $this->headers = $this->parseHeaders();
    $this->query = $_GET;
    $this->post = $_POST;
    $this->files = $_FILES;
    $this->cookies = $_COOKIE;
    $this->content = file_get_contents('php://input');
    $this->json = $this->parseJson();
  }

  protected function parseHeaders(): array
  {
    $headers = [];
    foreach ($_SERVER as $key => $value) {
      if (str_starts_with($key, 'HTTP_')) {
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
      }
    }
    return $headers;
  }

  protected function parseJson(): array
  {
    if ($this->isJson()) {
      try {
        return json_decode($this->content, true, 512, JSON_THROW_ON_ERROR);
      } catch (\JsonException) {
        return [];
      }
    }
    return [];
  }

  public function method(): string
  {
    return $this->method;
  }

  public function uri(): string
  {
    return $this->uri;
  }

  public function path(): string
  {
    return parse_url($this->uri, PHP_URL_PATH) ?? '/';
  }

  public function isMethod(string $method): bool
  {
    return strtoupper($this->method) === strtoupper($method);
  }

  public function isGet(): bool
  {
    return $this->isMethod('GET');
  }

  public function isPost(): bool
  {
    return $this->isMethod('POST');
  }

  public function isPut(): bool
  {
    return $this->isMethod('PUT');
  }

  public function isDelete(): bool
  {
    return $this->isMethod('DELETE');
  }

  public function isAjax(): bool
  {
    return $this->header('X-Requested-With') === 'XMLHttpRequest';
  }

  public function isJson(): bool
  {
    return str_contains($this->header('Content-Type', ''), 'application/json');
  }

  public function header(string $key, ?string $default = null): ?string
  {
    return $this->headers[$key] ?? $default;
  }

  public function headers(): array
  {
    return $this->headers;
  }

  public function input(string $key, mixed $default = null): mixed
  {
    if ($this->isJson()) {
      return $this->json[$key] ?? $default;
    }

    return $this->post[$key] ?? $this->query[$key] ?? $default;
  }

  public function query(string $key, mixed $default = null): mixed
  {
    return $this->query[$key] ?? $default;
  }

  public function post(string $key, mixed $default = null): mixed
  {
    return $this->post[$key] ?? $default;
  }

  public function json(?string $key = null, mixed $default = null): mixed
  {
    if ($key === null) {
      return $this->json;
    }
    return $this->json[$key] ?? $default;
  }

  public function file(string $key): ?array
  {
    return $this->files[$key] ?? null;
  }

  public function cookie(string $key, mixed $default = null): mixed
  {
    return $this->cookies[$key] ?? $default;
  }

  public function ip(): ?string
  {
    return $_SERVER['REMOTE_ADDR'] ?? null;
  }

  public function userAgent(): ?string
  {
    return $_SERVER['HTTP_USER_AGENT'] ?? null;
  }

  public function bearerToken(): ?string
  {
    $header = $this->header('Authorization', '');
    if (str_starts_with($header, 'Bearer ')) {
      return substr($header, 7);
    }
    return null;
  }

  public function all(): array
  {
    if ($this->isJson()) {
      return $this->json;
    }
    return array_merge($this->query, $this->post);
  }

  public function only(array $keys): array
  {
    return array_intersect_key($this->all(), array_flip($keys));
  }

  public function except(array $keys): array
  {
    return array_diff_key($this->all(), array_flip($keys));
  }

  public function has(string $key): bool
  {
    return array_key_exists($key, $this->all());
  }

  public function hasAny(array $keys): bool
  {
    foreach ($keys as $key) {
      if ($this->has($key)) {
        return true;
      }
    }
    return false;
  }
}
