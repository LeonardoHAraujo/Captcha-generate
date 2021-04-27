<?php

class Connection {

	protected $pdo;

	public function __construct($pathSqlite) {
        if ($this->pdo == null) {
            try {
            	$this->pdo = new PDO("sqlite:{$pathSqlite}");
            } catch (PDOException $e) {
            	print($e->getMessage());
            }
        }
        return $this->pdo;
    }
}
