<?php
class Upload extends AppModel {
	
	var $name = 'Upload';
	var $displayField = 'label';
	var $actsAs = array('Containable');
	var $order = array('Upload.display_order' => 'ASC');
	
	var $belongsTo = array('User');
}
