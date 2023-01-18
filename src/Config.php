<?php

declare(strict_types = 1);

namespace Framework;

final class Config
{
  private static $instance = null;
  private static $values = null;

  private function __construct()
  {
    // $param['DB']['DSN'] = "mysql:host=db;port=3306;dname=database";
    $param['DB_DSN'] = "sqlite:".DB."phpmvc.sqlite";
    $param['DB_USER'] = "dbuser";
    $param['DB_PASSWORD'] = "password";

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
