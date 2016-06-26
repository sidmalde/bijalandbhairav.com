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
		$this->contain(array(
			'Upload' => array(
				'order' => array(
					'Upload.filename'
				),
			) 
		));
		$options = array(
			'conditions' => array(
				'Album.slug' => $slug,
			),
		);
		return $this->find('first', $options);
	}
}
