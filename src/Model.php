<?php namespace Framework;

use Framework\Database;
use PDOException;

abstract class Model
{
    protected Database $db;
    public array $values = [];

    public function __construct()
    {
        $this->db = new Database(App::load()->config());
        
    }

    public function get(int $id = null)
    {
        $table = $this->table;

        $sql = "SELECT * FROM $table";
        
        if(!is_null($id))
        {
            $sql .= " WHERE id = $id";
        }

        $query = $this->db->pdo->query($sql);

        return $query->fetchAll();
    }

    /*
    public static function get(int $id): self
    {

    }
    */
    
    public function create(): void
    {
        $table = $this->table;
        $fields = $this->fields;
        $params = array_map(fn($val) => ":$val", $fields);

        $sql = $this->db->pdo->prepare("INSERT INTO $table (".implode(',', $fields).") VALUES (".implode(',', $params).")");
        
        foreach ($fields as $key => $field)
        {
            $sql->bindValue(":$field", $this->values[$key]);
        }

        $sql->execute();
        
    }
}