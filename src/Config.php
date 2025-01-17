<?php

declare(strict_types=1);

namespace Framework;

final class Config
{
  private static $instance = null;
  private static $values = null;

  private function __construct()
  {
    $param = [];

    $param['DB_DSN'] = sprintf(
      '%s:host=%s;port=%s;dbname=%s',
      $_ENV['DB_PROVIDER'],
      $_ENV['DB_HOST'],
      $_ENV['DB_PORT'],
      $_ENV['DB_NAME']
    );

    $param['DB_USER'] = $_ENV['DB_USER'];
    $param['DB_PASSWORD'] = $_ENV['DB_PASSWORD'];

    self::$values = $param;
  }

  private static function load(): Config
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public static function get($key): string|null
  {
    self::load();

    return self::$values[$key];
  }
}
