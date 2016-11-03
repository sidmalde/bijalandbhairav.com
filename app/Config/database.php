<?php

class DATABASE_CONFIG {
	
	// public $staging = array(
	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'bijalandbhairav',
	);

	public $live = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'sidmalde',
		'password' => 'F3rrari1',
		'database' => 'bijalandbhairav',
		'prefix' => '',
	);
	
	function __construct(){
		if (strpos($_SERVER['HTTP_HOST'],'dev.') !== false) {
			$this->default = $this->default;
		} else {
			$this->default = $this->live;
		}
		// $this->default = $this->default;
	}
	
	function DATABASE_CONFIG(){
		$this->__construct();
	}
}
