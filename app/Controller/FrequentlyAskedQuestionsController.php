<?php
App::uses('AppController', 'Controller');

class FrequentlyAskedQuestionsController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->set('bodyClass', 'faqs');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function admin_index() {
		$faqs = $this->FrequentlyAskedQuestion->find('all');

		$title_for_layout = __('FAQs');
		$this->set(compact(array('faqs', 'title_for_layout')));
	}
	
	public function admin_view() {
		
	}
	
	public function admin_add() {
		if (!empty($this->request->data)) {
			if ($this->FrequentlyAskedQuestion->save($this->request->data)) {
				$this->Session->setFlash('Question Saved.', 'flash_success');
				$this->redirect($this->referer());
			} else {
				$this->Session->setFlash('Question not saved.', 'flash_failure');
			}
		}
		$title_for_layout = __('FAQs :: Add Question');
		$this->set(compact(array('title_for_layout')));
	}
	
	public function admin_edit($id = null) {
		
	}

	public function admin_delete($id = null) {
		if (empty($this->params['group'])) {
			$this->session->setFlash(__('Invalid Group'), 'flash_failure');
			$this->redirect(array('action' => 'index'));
		}
		
		if ($this->Group->delete($this->params['group'])) {
			$this->Session->setFlash(__('Group deleted'), 'flash_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group was not deleted'), 'flash_failure');
		$this->redirect(array('action' => 'index'));
	}

	function index() {
		$this->layout = 'default';

		$title_for_layout = __('Ask us a Question');
		$this->set(compact(array('faqs', 'title_for_layout')));
	}
}
