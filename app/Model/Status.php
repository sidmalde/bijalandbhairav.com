<?php
class Status extends AppModel {
	var $name = 'Status';
	var $order = 'status';
	var $actsAs =  array('Containable');
	var $displayField = 'status';
	
	var $hasMany = array(
		'Offer'
	);
}
