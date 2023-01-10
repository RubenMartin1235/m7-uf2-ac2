<?php

namespace App\Models;

use App\Database\DB;
use App\Container;

abstract class Model {
	protected DB $qb;
	protected string $table;
	protected array $data;
	protected int $id;

	public function __construct(array $data=null){
		$reflect = new \ReflectionClass($this);
		$this->table = strtoupper($reflect->getShortName()) . 'S';

		$this->qb = Container::get('database');
		$this->qb->setTable($this->table);
		if ($data) {
			$this->data = $data;
		}
	}

	public function get():array {
		return $this->data;
	}

	function save(){
		$this->qb->update($this->table, $this->data);
	}
	function persist(){
		if ($this->data){
				$this->qb->insert($this->data)->exec();
		}
	}
}