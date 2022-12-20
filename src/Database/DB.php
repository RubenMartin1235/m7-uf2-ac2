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

	function appendToQuery(string $s) {
		$this->query[] = $s;
		return $this;
	}

	function select(array $fields = ["*"]):self {
		$sql = "SELECT ";
		$fieldsStr = implode(',', $fields);

		$this->appendToQuery($sql . $fieldsStr);
		return $this;
	}
	function insert(string $table, array $entries):self {
		$sql = "INSERT INTO $table VALUES ";
		$entries_count = count($entries);
		for ($i=0; $i < $entries_count; $i++) {
			$sql += "(";
			$entry = $entries[$i];
			$fields_count = count($entry);
			for ($j=0; $j < $fields_count; $j++) {
				$fieldval = $entry[$j];
				$fieldval_out = $fieldval;
				if (is_string($fieldval_out)) {
					$fieldval_out = "'$fieldval_out'";
				}
				if ($j < $fields_count - 1) {
					$sql += ",";
				}
			}
			$sql += ")";
			if ($i < $entries_count - 1) {
				$sql += ",";
			}
		}
		return $this;
	}
	function delete(array $data):self {
		$sql = "DELETE ";

		$this->appendToQuery($sql);
		return $this;
	}

	function from(string $table):self {
		$this->appendToQuery(" FROM $table");
		return $this;
	}

	function where(string $condition):self {
		$this->appendToQuery(" WHERE $condition");
		return $this;
	}
	function and_cond(array $conditions, bool $or=false):string {
		$result = "(";
		$i = 0;
		$cond_count = count($conditions);
		foreach ($conditions as $k => $v) {
			$result .= "$k = '$v'";
			if ($i < $cond_count-1) {
				$result .= ($or) ? " OR " : " AND ";
			}
			$i++;
		}
		$result .= ")";
		return $result;
	}
	

	function limit(int $n):self {
		$this->appendToQuery(" LIMIT {$n}");
		return $this;
	}

	function __toString() {
		return join($this->query);
	}

	function exec($queryArray=null):self {
		$sql = join($this->query);

		$this->stmt = $this->query($sql);
		
		$this->stmt->execute();
		return $this;
	}

	function fetch(){
		$rows = $this->stmt->fetchAll(\PDO::FETCH_OBJ);
		return $rows;
	}

	function query($sql){
		return $stmt = $this->pdo->query($sql);
	}
}