<?php
class Album extends AppModel {
	
	var $name = 'Album';
	var $displayField = 'title';
	var $actsAs = array('Containable');
	
	var $hasMany = array('Upload');
	var $belongsTo = array(
		'Thumbnail' => array(
			'className' => 'Upload',
			'foreignKey' => 'thumbnail_id'
		)
	);

	function getAllAlbums() {
		$this->contain('Thumbnail');
		$options = array(
			'order' => array(
				'Album.display_order' => 'ASC'
			),
		);
		return $this->find('all', $options);
	}

	function getAllAlbumsAndImages() {
		$this->contain('Thumbnail', 'Upload');
		$options = array(
			'order' => array(
				'Album.display_order' => 'ASC'
			),
		);
		return $this->find('all', $options);
	}

	function getAlbum($slug) {
		$this->contain('Upload');
		$options = array(
			'conditions' => array(
				'Album.slug' => $slug,
			),
			'order' => array(
				'Upload.display_order'
			),
		);
		return $this->find('first', $options);
	}
}
