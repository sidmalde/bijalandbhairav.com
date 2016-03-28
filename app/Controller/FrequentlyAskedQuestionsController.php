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
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Question not saved.', 'flash_failure');
			}
		}
		$title_for_layout = __('FAQs :: Add Question');
		$this->set(compact(array('title_for_layout')));
	}
	
	public function admin_edit($id = null) {
		if (!empty($this->request->data)) {
			if ($this->FrequentlyAskedQuestion->save($this->request->data)) {
				$this->Session->setFlash('Question Saved.', 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Question not saved.', 'flash_failure');
			}
		}

		if (empty($this->request->params['faq'])) {
			$this->Session->setFlash('Invalid Request', 'flash_failure');
			$this->redirect($this->referer());
		}

		$this->request->data = $faq = $this->FrequentlyAskedQuestion->find('first', array('conditions' => array('FrequentlyAskedQuestion.id' => $this->request->params['faq'])));

		$title_for_layout = __('FAQs :: Add Question');
		$this->set(compact(array('faq', 'title_for_layout')));
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

		if (!empty($this->request->data)) {
			$this->FrequentlyAskedQuestion->create();
			if ($this->FrequentlyAskedQuestion->save($this->request->data)) {
				$this->Session->setFlash(__('Thank you for your question, we will get back to you shortly.'), 'flash_success');
			} else {
				$this->Session->setFlash(__('Unfortunately there was a problem sending your question, please try again.'), 'flash_failure');
			}
		}

		$this->FrequentlyAskedQuestion->contain();
		$options = array(
			'conditions' => array(
				'FrequentlyAskedQuestion.display' => true
			),
		);
		$faqs = $this->FrequentlyAskedQuestion->find('all', $options);

		$title_for_layout = __('Ask us a Question');
		$this->set(compact(array('faqs', 'title_for_layout')));
	}
}
