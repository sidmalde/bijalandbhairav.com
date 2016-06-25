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

		if (!empty($this->request->data)) {
			debug($this->request->data);

			$this->_checkAndUploadFile('img/uploads', $this->request->data['Upload']['filename']);

			die;
		}
		
	}
	
	public function admin_edit($id = null) {
		
	}

	public function admin_delete($id = null) {
		
	}

	function _checkAndUploadFile($folder, $file, $filename = null){
		if(!is_array($file)){
			return $file;
		} elseif($file['size']){
			if($filename){
				$file['name'] = $filename;
			} else {
				$file['name'] = basename(Sanitize::paranoid($file['name'],array('.', '-', '_')));
			}

			if (!file_exists($folder)) {
				$pathToCreate = $folder;
				mkdir($pathToCreate, 0777, true);
			}

			move_uploaded_file($file['tmp_name'], $folder.'/'.$file['name']);
			return '/'.$folder.'/'.$file['name'];
		} else {
			return NULL;
		}
	}
}
