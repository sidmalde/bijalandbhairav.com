<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
		$this->set('bodyClass', 'users');
		$this->Auth->allow();
		$this->layout = 'admin';
	}
	
	public function admin_index() {
		$this->User->Group->contain(array(
			'User' => array(
				'conditions' => array(
					'User.active' => true,
					'User.deleted' => false,
				)
			),
		));
		$groups = $this->User->Group->find('all');
		
		$title_for_layout = __('Users');
		$this->set(compact(array('title_for_layout', 'groups')));
	}
	
	public function admin_view() {
		if (empty($this->params['user'])) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('index');
		}
		
		$options = array(
			'conditions' => array(
				'User.id' => $this->params['user']
			)
		);
		$this->User->contain(array(
			'Group',
		));
		$this->request->data = $user = $this->User->find('first', $options);
		
		if (empty($user)) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('index');
		}
		$groups = $this->User->Group->find('list');
		$title_for_layout = sprintf(__('%s &#187; %s'), $user['Group']['name'], $user['User']['fullname']);
		
		$this->set(compact(array('users', 'user', 'groups', 'title_for_layout')));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->request->data['User']['active'] = true;
			$this->request->data['User']['deleted'] = false;
			
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_failure');
			}
		}
		$groups = $this->User->Group->find('list');
		$title_for_layout = __('System Maintenance &#187; Users &#187; New');
		
		$this->set(compact(array('groups', 'title_for_layout')));
	}

	public function admin_edit($id = null) {
		if (empty($this->params['user'])) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('dashboard');
		}
		
		$this->User->contain(array(
			'Group'
		));
		$options = array(
			'conditions' => array(
				'User.id' => $this->params['user'],
			)
		);
		
		$user = $this->User->find('first', $options);
		
		if (empty($user)) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
			$this->redirect('dashboard');
		}
		
		if (!empty($this->request->data)) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'flash_success');
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'flash_failure');
			}
		}
		
		$this->redirect(array('action' => 'view', 'user' => $user['User']['id']));
	}

	public function admin_delete($id = null) {
		if (empty($this->params['user'])) {
			$this->Session->setFlash(__('Invalid User Id'), 'flash_failure');
		}
		
		$this->User->contain();
		$user = $this->User->findById($this->params['user']);
		if (!empty($user)) {
			$user['User']['active'] = 0;
			$user['User']['deleted'] = 1;
			
			if ($this->User->save($user)) {
				$this->Session->setFlash(__('User deleted'), 'flash_success');
				$this->redirect($this->referer());
			}
		}
		$this->Session->setFlash(__('User was not deleted'), 'flash_failure');
		$this->redirect($this->referer());
	}
	
	/* public function admin_dashboard() {
		if (!empty($this->params['tab'])) {
			$this->set('selectedTab', $this->params['tab']);
		} else {
			$this->set('selectedTab', 'logs');
		}
		
		$logStartDate = date("Y-m-d", strtotime(date("Y-m-d").' - 15 days'));
		$options = array(
			'conditions' => array(
				'Log.created >' => $logStartDate
			),
			'order' => array(
				'Log.created' => 'DESC'
			),
		);
		$systemLogs = $this->Log->find('all', $options);
		$this->request->data = $this->User->findById($this->Auth->user('id'));
		$title_for_layout = __('Dashboard');
		$bodyClass = 'dashboard';
		$this->set(compact(array('title_for_layout', 'bodyClass', 'systemLogs')));
	} */
	
	public function login() {
		$this->layout = 'login';
		if ($this->Auth->user()) {
			if ($this->Auth->user('group_id') == '526b00e9-2d10-41bd-bf86-1b64d96041f1') {
				$this->redirect('/system-management/users');
			} else {
				$this->redirect(array('controller' => 'pages', 'action' => 'dashboard', 'admin' => true));
			}
		} else {
			if ($this->request->is('post')) {
				if ($this->Auth->login()) {
					if ($this->Auth->user('group_id') == '52c1e2df-87c0-4b14-9ba9-0dc0d96041f1') {
						$this->redirect('/dashboard');
					} else {
						$this->redirect('/myportal');
					}
				} else {
					$this->Session->setFlash(__('Your email or password was incorrect.'), 'flash_failure');
				}
			}
		}
	}

	/* public function register() {
		$this->layout = 'default';
		if (!empty($this->request->data)) {
			if ($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']) {
				//Set Active
				$this->request->data['User']['active'] = true;
				//Set Not Deleted
				$this->request->data['User']['deleted'] = false;
				//Set Group to Users
				$this->request->data['User']['group_id'] = '526b03c3-5f10-4cdb-ade1-1b64d96041f1';
				
				$this->User->create();
				if ($this->User->save($this->request->data)) {
					// Auto Log in
					$this->Session->setFlash(__('Thank you for registering, you are now logged in.'), 'flash_success');
					
				} else {
					$this->Session->setFlash(__('Invalid request'), 'flash_failure');
				}
			} else {
				// Passwords do not match
				$this->Session->setFlash(__('Passwords do not match, please try again'), 'flash_failure');
			}
		}
	} */

	public function logout() {
		$this->Session->setFlash(__('You have now been logged out'), 'flash_success');
		$this->redirect($this->Auth->logout());
	}
	
}
