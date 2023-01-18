<?php

declare(strict_types = 1);

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

	private static ?Database $instance = null;
	private PDO $connection; 

	private function __construct()
	{
		$this->connection = new PDO(
			Config::get('DB_DSN'),
			Config::get('DB_USER') ?? null,
			Config::get('DB_PASSOWORD') ?? null
		);
	}

	public static function connect(): PDO
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance->connection;
	}
}
