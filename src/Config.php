<?php

namespace Framework;

final class Config
{
  private function __clone()
  {
  }
  private function __wakeup()
  {
  }

  private static $instance = null;
  private static $values = null;

  private function __construct()
  {
    // $param['DB']['DSN'] = "mysql:host=db;port=3306;dname=database";
    $param['DB_DSN'] = "sqlite:".DB."phpmvc.sqlite";
    $param['DB']['USER'] = "dbuser";
    $param['DB']['PASSWORD'] = "password";

    self::$values = $param;
  }

  private static function load()
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public static function get($key)
  {
    self::load();

    return self::$values[$key];
  }
}
