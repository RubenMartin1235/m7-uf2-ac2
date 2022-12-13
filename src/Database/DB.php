<?php

namespace App\Database;

class DB {
	private $query = [];
	private $fields = [];
	private $conditions = [];
	private $from = [];

	protected \PDO $pdo;

	function __construct($pdo) {
		$this->pdo = $pdo;
	}
	
	function select(array $fields):self {
		$sql = "SELECT ";
		$fieldsStr = implode(',', $fields);

		$this->query[] = $sql . $fieldsStr;
		return $this;
	}

	function from(string $table):self {
		$this->query[] = " FROM {$table}";
		return $this;
	}

	function where(array $conditions):self {
		$k = array_keys($conditions);
		$v = array_values($conditions);
		$this->query[] = " WHERE {$this->cond($conditions)}";
		return $this;
	}
	protected function cond(array $conditions):string {
		$k = array_keys($conditions);
		$v = array_values($conditions);
		return "{$k[0]} = '{$v[0]}'";
	}
	function and_cond():self {
		$this->query[] = " AND ";
		return $this;
	}
	function or_cond():self {
		$this->query[] = " OR ";
		return $this;
	}

	function limit(int $n):self {
		$this->query[] = " LIMIT {$n}";
		return $this;
	}

	function __toString() {
		return join($this->query);
	}

	function exec() {
		$sql = join($this->query);

		$stmt = $this->pdo->query($sql);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
		return $rows;
	}
}