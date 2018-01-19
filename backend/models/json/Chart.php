<?php
namespace backend\models\json;

class Chart {

	 public $label;
	 public $data;
	 public $borderDash;

	 public function __construct($year, $data)
	 {
	 	$this->label = $year;
	 	$this->data = $data;
	 	$this->borderDash = [5,5];
	 }
}