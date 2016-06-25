<?php
App::uses('AppController', 'Controller');

class AlbumsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'albums');
		$this->Auth->allow();
		$this->layout = 'admin';
	}

	function index() {
		$this->layout = 'default';
		$albums = $this->Album->getAllAlbumsAndImages();

		$title_for_layout = __('Gallery');
		$this->set(compact(array('title_for_layout', 'albums')));
	}

	function view() {
		$this->layout = 'default';
		if (empty($this->request->params['slug'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		}

		$album = $this->Album->getAlbum($this->request->params['slug']);
		if (!empty($album)) {
			$title_for_layout = __('Albums :: %s', $album['Album']['title']);
			$this->set(compact(array('album', 'title_for_layout')));
		} else {
			$this->Session->setFlash('Album could not be found, please try again', 'flash_failure');
			$this->redirect($this->referer());
		}
	}

	function admin_index() {

		$albums = $this->Album->getAllAlbums();

		$title_for_layout = __('Albums');

		$this->set(compact(array('title_for_layout', 'albums')));
	}

	function admin_add() {

		if (!empty($this->request->data)) {
			$this->request->data['Album']['slug'] = Inflector::slug(strtolower($this->request->data['Album']['title']), '-');

			if ($this->Album->save($this->request->data)) {
				$this->Session->setFlash(__('Album has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Album could not be saved, please try again'), 'flash_failure');
			}
		}

		$title_for_layout = __('Albums :: New');
		$this->set(compact(array('title_for_layout')));
	}

	function admin_edit() {
		if (empty($this->request->params['album'])) {
			$this->Session->setFlash(__('Invalid Request'), 'flash_failure');
			$this->redirect($this->referer());
		} elseif (!empty($this->request->data)) {
			$albumId = $this->request->params['album'];
			$selectedCount = $savedCount = 0;
			foreach ($this->request->data['Album'] as $uploadId => $selected) {
				if ($selected == 'on') {
					$selectedCount++;

					$this->Album->Upload->id = $uploadId;
					if ($this->Album->Upload->saveField('album_id', $albumId)) {
						$savedCount++;
					}
				}
			}
			if ($selectedCount == $savedCount) {
				$this->Session->setFlash(__('All Selected images have been moved to Album %s', $this->Album->field('title', array('id' => $albumId))), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Some images could not be moved to Album %s, please try again'), 'flash_success');
			}
		} else {
			$this->Album->contain(array('Upload'));
			$this->request->data = $album = $this->Album->findById($this->request->params['album']);
			if (!empty($album)) {
				$options = array(
					'conditions' => array(
						'Upload.album_id' => null,
					),
					'order' => array(
						'Upload.display_order' => 'ASC',
					)
				);
				$this->Album->Upload->contain('User.fullname');
				$unassignedImages = $this->Album->Upload->find('all', $options);
			} else {
				$this->Session->setFlash(__('The album you requested does not exist, please try again.'), 'flash_failure');
				$this->redirect($this->referer());
			}
		}

		$this->set(compact(array('album', 'unassignedImages')));
	}

	function admin_delete() {

	}
}