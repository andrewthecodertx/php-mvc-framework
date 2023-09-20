<?php

declare(strict_types=1);

namespace Framework;

use Exception;
use Framework\Database;

abstract class Model
{
	public array $values = [];
	private $db;

	public function __construct()
	{
		$this->db = Database::connect();
	}

	public function get(array $args = []): array|false
	{
		if ($args && count($args) !== 2) {
			throw new Exception("MUST FORMAT ARRAY CORRECTLY");
		}

		$table = $this->table;
		$sql = "SELECT * FROM $table";

		if ($args) {
			if (gettype($args[1]) === 'string') {
				$sql .= " WHERE $args[0] = '$args[1]'";
			} else {
				$sql .= " WHERE $args[0] = $args[1]";
			}
		}

		$query = $this->db->query($sql);

		return $query->fetchAll();
	}

	public function create(): bool
	{
		$table = $this->table;
		$fields = $this->fields;
		$params = array_map(fn ($val) => ":$val", $fields);

		$sql = $this->db->prepare("INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")");

		foreach ($fields as $key => $field) {
			$sql->bindValue(":$field", $this->values[$key]);
		}

		return $sql->execute();
	}
}
