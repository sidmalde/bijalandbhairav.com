<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
		$this->set('bodyClass', 'users');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function index() {
	
	}
}