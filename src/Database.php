<?php namespace Framework;

use PDO;
use PDOException;

class Database extends PDO
{
    public ?PDO $pdo = null;

    public function __construct(array $conf)
    {
        try
        {
            $this->pdo = new PDO($conf['DB_DSN'], 
                                 $conf['DB_USER'] ?? null, 
                                 $conf['DB_PASSWORD'] ?? null);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)
        {
            throw new Exception\DatabaseException($e->getMessage(), (int)$e->getCode());
        }
    }
}
