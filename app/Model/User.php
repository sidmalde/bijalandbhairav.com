<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	var $name = 'User';
	var $displayField = 'fullname';
	var $actsAs = array('Containable', 'Acl' => array('type' => 'requester', 'enabled' => false));
	var $hasMany = array(
		'Upload'
	);
	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
		),
	);
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		$this->virtualFields['fullname'] = sprintf('CONCAT(%s.firstname, " ", %s.lastname)', $this->alias, $this->alias);
	}
	
	public function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
		} else {
			$groupId = $this->field('group_id');
		}
		if (!$groupId) {
			return null;
		} else {
			return array('Group' => array('id' => $groupId));
		}
	}
	
	public function bindNode($user) {
		return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}
	
	function wasRegistered($check){
		$this->contain();
		$deleted = $this->field('deleted', array('User.email' => $check));
		if($deleted == 1){
			return false;
		} else {
			return true;
		}
	}
	function isRegistered($check, $id){
		$this->contain();
		$id = $this->field('id', array('User.email' => $check));
		if($id){
			return false;
		} else {
			return true;
		}
	}
	
	var $validate = array(
		'group_id' => array(
			'rule' => 'notEmpty',
			'message' => 'This is a required field and cannot be left empty'
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'This is a required field and cannot be left empty',
			),
			'validEmail' => array(
				'rule' => 'email',
				'message' => 'Please supply a valid email address' 
			),
			'isRegistered' => array(
				'rule' => 'isRegistered',
				'message' => 'This email address is already registered with us.',
				'on' => 'create'
			),
			'wasRegistered' => array(
				'rule' => 'wasRegistered',
				'message' => 'This email address was registered with us, please contact us to reactivate',
				'on' => 'create'
			)
		),
		'firstname' => array(
			'rule' => 'notEmpty',
			'message' => 'This is a required field and cannot be left empty'
		),
		'lastname' => array(
			'rule' => 'notEmpty',
			'message' => 'This is a required field and cannot be left empty'
		),
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return true;
    }
}