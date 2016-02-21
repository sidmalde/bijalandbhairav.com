<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'title';
	var $order = 'Page.position ASC';
	var $actsAs = array('Containable');
	
	var $validate = array(
		'label' => array(
			'rule' => array('notempty'),
			'message' => 'This is a required field and cannot be left empty'
		),
		'meta_description' => array(
			'rule' => array('notempty'),
			'message' => 'This is a required field and cannot be left empty'
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array('ParentPage' => array('className' => 'Page', 'foreignKey' => 'parent_page_id'));
	var $hasMany = array('ChildPage' => array('className' => 'Page', 'foreignKey' => 'parent_page_id', 'order' => 'ChildPage.position ASC'));
	
	
	function beforeSave($options = array()){
		if(!empty($this->data['Page']['parent_page_id']) && !empty($this->data['Page']['url'])){
			$this->data['Page']['url'] = $this->_formatPageUrl($this->data['Page']['url'], $this->data['Page']['parent_page_id']); //Format the URL for the record
		}
		return true;
	}
	
	
	// Used during the add/edit of a page
	function _formatPageUrl($url, $parentId = NULL){
		if(substr($url,0,1) == '/'){
			$url = 	substr($url, 1);
		}
		if($parentId == ('' || NULL)){	
			return '/'.$url;	
		} else {
			$parentPage = $this->findById($this->data['Page']['parent_page_id']);
			if($parentPage){
				return $parentPage['Page']['url'].'/'.$this->data['Page']['url'];	
			}
		}	
		return NULL;
	}
}
