<?php

namespace App\Models;

use App\Database\DB;
use App\Container;

abstract class Model {
	protected DB $qb;
	protected string $table;
	protected array $data;
	protected int $id;

	public function __construct(){
		$reflect = new \ReflectionClass($this);
		$this->table = strtolower($reflect->getShortName()) . 's';

		$this->qb = Container::get('query');
		$this->qb->setTable($this->table);
	}

	public function get():array {
		return $this->data;
	}
}