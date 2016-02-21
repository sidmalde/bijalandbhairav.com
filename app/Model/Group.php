<?php
App::uses('AppModel', 'Model');

class Group extends AppModel {
	var $name = 'Group';
	var $displayField = 'name';
	var $actsAs = array('Containable', 'Acl' => array('type' => 'requester'));
	var $order = 'created ASC';
	// Relations
	var $hasMany = array('User');
	
	var $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'This is a required field and cannot be left empty.'
		),
	);

    public function parentNode() {
        return null;
    }
	
}