<?php
App::uses('Controller', 'Controller');
App::uses('Sanitize', 'Utility');

class AppController extends Controller {
	public $components = array(
		'Security' => array(
			'setHash' => 'md5',
			'validatePost' => false,
			'csrfCheck' => false,
		),
		'Acl',
		'Auth' => array(
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers')
			),
			// 'loginAction' => array('controller' => 'users', 'action' => 'login', 'admin' => null),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email'),
				),
			),
			'userScope' => array(
				'User.active' => true,
				'User.deleted' => false,
			),
			'autoRedirect' => false,
		),
		'Session',
		'Email',
		'DebugKit.Toolbar',
	);
	public $helpers = array('Html', 'Form', 'Session', 'Number', 'Time', 'Text');
	
	public $userGenders = array(
		'Male' => 'Male',
		'Female' => 'Female',
	);
	
	public $userTitles = array(
		'Mr' => 'Mr',
		'Mrs' => 'Mrs',
		'Miss' => 'Miss',
		'Dr' => 'Dr',
	);
	
	public $allowedUploadExtensions = array(
		'doc' => 'doc',
		'docx' => 'docx',
		'xls' => 'xls',
		'xlsx' => 'xlsx',
		'pdf' => 'pdf',
		'jpg' => 'jpg',
		'jpeg' => 'jpeg',
		'gif' => 'gif',
		'png' => 'png',
		'tiff' => 'tiff',
	);
	
	function beforeFilter() {
		//Configure SecurityComponent
		// Security::setHash('md5');
		
		if ($this->Auth->user()) {
			$this->currentUser = $this->Auth->user();
			$this->set('currentUser', $this->currentUser);
		}

		$boxes = array();
		$boxes[] = array(
			'img-source' =>  '/img/Backgrounds/Bird and flower.png',
			'label' => 'Getting There',
			'link' => '/how-to-get-to-cordoba'
		);
		$boxes[] = array(
			'img-source' =>  '/img/Backgrounds/Dog and people.png',
			'label' => 'Accommodation',
			'link' => '/accommodation'
		);
		$boxes[] = array(
			'img-source' =>  '/img/Backgrounds/Pomegranates.png',
			'label' => 'Wedding Schedule',
			'link' => '/wedding-schedule'
		);
		$boxes[] = array(
			'img-source' =>  '/img/Backgrounds/Flowers2.png',
			'label' => 'Places to Visit',
			'link' => '/places-to-visit'
		);
		$boxes[] = array(
			'img-source' =>  '/img/Backgrounds/IMG_0099.JPG',
			'label' => 'Gift List',
			'link' => '/gift-list'
		);
		$boxes[] = array(
			'img-source' =>  '/img/Backgrounds/IMG_0097.JPG',
			'label' => 'Upload Your Media',
			'link' => '/upload-your-media'
		);
		
		if ($this->Auth->user()) {
			App::import('Model', 'User');
			$this->User = new User();

			$this->User->contain();
			$this->currentUser = $this->User->findById($this->Auth->user('id'));
			Configure::write('currentLoggedInUser', $this->currentUser);
		}

		$this->set('boxes', $boxes);
		$this->set('backgroundSongPath', $this->getPlaylist());
		$this->set('userGenders', $this->userGenders);
		$this->set('userTitles', $this->userTitles);
		$this->set('currentUser', $this->currentUser);
	}
	
	function getPlaylist() {
		$mediaPath = APP . WEBROOT_DIR . DS . 'media';
		$songs = scandir($mediaPath);
		$count = 0;
		$fullSongPaths = array();
		foreach ($songs as $songName) {
			if (substr($songName, -3) == 'mp3') {
				$fullSongPaths[] = DS . 'media' . DS . $songName;
			}
		}
		shuffle($fullSongPaths);
		return $fullSongPaths[0];
	}

	function generateRandomString($type = 'username', $length = 10) {
		if ($type == 'username') {
			$string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		} elseif ($type == 'password') {
			$string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ[]()!@^,~|=-+_{}#";
		} elseif ($type == 'verificationCode') {
			$string = "0123456789abcdefghijklmnopqrstuvwxyz";
		} else {
			$string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		}
		return substr(str_shuffle($string), 0, $length);
	}
}