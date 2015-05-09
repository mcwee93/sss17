<?php
class UsersController extends AppController {

	var $name = 'Users';
	
	
  public function isAuthorized($user) {
      if($user['role']=='admin') {
             return true;
      }
      if ( in_array($this->action, array('edit','delete')) ) {
	        if($user['id']!=$this->request->params['pass'][0]) {
             return false;
          }
	    }
      return true;
	}
  
  
  public function login() {
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	            $this->redirect($this->Auth->redirect());   
	        } else {
	            $this->Session->setFlash('Your username/password combination was incorrect');
	        }
	    }
	}
	
  public function logout() {
	    $this->redirect($this->Auth->logout());
	}  
  
	function index() {

		
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		
		
	}

	function view($id = null) {

		$this->set('user', $this->User->read(null, $id));
	}

	function add() {

		if (!empty($this->request->data)) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid user'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->User->read(null, $id);
		}
	}

	function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>