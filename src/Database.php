<?php

namespace Framework;

use Framework\Config;
use PDO;
use PDOException;

final class Database
{
	private function __clone()
	{
	}
	private function __wakeup()
	{
	}

	private static $instance = null;
	private $connection; 

	public static function load()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->connection = new PDO(
			Config::get('DB_DSN'),
			Config::get('DB_USER') ?? null,
			Config::get('DB_PASSOWORD') ?? null
		);
		
	}
	public function init()
	{
		return $this->connection;
	}
}
