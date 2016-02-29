<?php
class FrequentlyAskedQuestion extends AppModel {
	var $name = 'FrequentlyAskedQuestion';
	var $order = 'created';
	var $actsAs =  array('Containable');
	var $displayField = 'question';
}
