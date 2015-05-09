<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	
	
 
  function login () {
    
  }

  function logout () {
    $this->redirect($this->Auth->logout());
  }	
	
	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid comment'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add() {
  
		if( !$this->Auth->user('id') ) {  // modification by MD - require login by any user to add a comment
			$this->Session->setFlash(__('You are not authorised '));
			$this->redirect(array('action' => 'index'));
		} 
    
		if (!empty($this->request->data)) {
			$this->Comment->create();
			$this->request->data['Comment']['user_id'] = $this->Auth->user('id'); //  modification by MD  - record creator of comment
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		$posts = $this->Comment->Post->find('list');
		/* modification by MD - user is unable to masquerade as somebody else so don't need to allow id selection in view
		$users = $this->Post->User->find('list');
		*/ 
		$this->set(compact('posts'));
	}

	function edit($id = null) {
		// modification by MD - reject if user does not own comment and is not an admin
		 
    $this->Comment->id = $id; // select Comment by id 
		$commentOwnerUserId = $this->Comment->field('user_id'); // obtain ID of user who made the comment
		if($this->Auth->user('role')!='admin' and $this->Auth->user('id') !=  $commentOwnerUserId ) { // if not admin and not owner of comment
			$this->Session->setFlash(__('You are not authorised' ));
			$this->redirect(array('action' => 'index'));
		} 		 
    
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid comment'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->request->data['Comment']['user_id'] = $this->Auth->user('id'); //  modification by MD  - record editor of post
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Comment->read(null, $id);
		}
		// modification by MD - user is unable to masquerade as somebody else so don't need to allow id selection in view
		//$users = $this->Post->User->find('list');
		
		$title =  $this->Comment->Post->field('title'); // extract title from post that the comment belongs to
		$this->set('title',$title); // send to view
		$this->set(compact('posts'));
	}

	function delete($id = null) {
	  // modification by MD - reject if user does not own comment and is not an admin
		 
    $this->Comment->id = $id; // select Comment by id and check 
		$commentOwnerUserId = $this->Comment->field('user_id'); // obtain ID of user who made the comment
		if($this->Auth->user('role')!='admin' and $this->Auth->user('id') !=  $commentOwnerUserId ) { // if not admin and not owner of comment
			$this->Session->setFlash(__('You are not authorised' ));
			$this->redirect(array('action' => 'index'));
		} 	
    
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for comment'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash(__('Comment deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Comment was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>