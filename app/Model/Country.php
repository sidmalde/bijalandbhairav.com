<?php
class Country extends AppModel {
	var $name = 'Country';
	var $order = 'position, name';
	var $actsAs =  array('Containable');
	var $displayField = 'name';
	
	public function getIsoNameList() {
		$options = array(
			'fields' => array(
				'Country.iso',
				'Country.name',
			),
		);
		return $this->find('list', $options);
	}
}
