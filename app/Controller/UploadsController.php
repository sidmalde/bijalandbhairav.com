<?php
App::uses('AppController', 'Controller');

class UploadsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'uploads');
		$this->Auth->allow();
		// $this->layout = 'default';
	}
	
	public function add() {
		$this->autoRender = false;
		$this->layout = false;

		// debug(APP . 'webroot' . DS . 'files');
		// die;

		App::import('Lib', 'Uploader');
		$this->Uploader = new Uploader();

		// $options = array(
		// 	'upload_dir' => 'Your upload directory',        
		// 	'accept_file_types' => '/\.(gif|jpe?g|png)$/i'                     
		// );
		// $this->Uploader = new Uploader($options);

		exit;
	}

	function index() {
		
	}

	public function admin_index() {
		
	}
	
	public function admin_view() {
		
	}
	
	public function admin_add() {
		
	}
	
	public function admin_edit($id = null) {
		
	}

	public function admin_delete($id = null) {
		
	}
}
