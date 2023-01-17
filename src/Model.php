<?php

namespace Framework;

use Framework\Config;
use Framework\Database;
use PDOException;

abstract class Model
{
	public array $values = [];
	private $db;

	public function __construct()
	{
		$this->db = Database::load()->init();
	}

	public function get(int $id = null)
	{
		$table = $this->table;

		$sql = "SELECT * FROM $table";

		if (!is_null($id)) {
			$sql .= " WHERE id = $id";
		}

		$query = $this->db->query($sql);

		return $query->fetchAll();
	}

	public function create(): void
	{
		$table = $this->table;
		$fields = $this->fields;
		$params = array_map(fn ($val) => ":$val", $fields);

		$sql = $this->db->prepare("INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" . implode(',', $params) . ")");

		foreach ($fields as $key => $field) {
			$sql->bindValue(":$field", $this->values[$key]);
		}

		$sql->execute();
	}
}
