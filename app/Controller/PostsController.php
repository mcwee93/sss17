<?php
class PostsController extends AppController {

	var $name = 'Posts';

	// allow add, edit, delete for admin only

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny('add','edit','delete');
		if ( $this->Auth->user('role')=='admin' ) {
     $this->Auth->allow('add','edit','delete');
    }
		$this->Auth->allow('view');
	}
  
	
	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid post'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function add() {
		if ($this->Auth->user('role')!='admin') {
			$this->Session->setFlash(__('You are not authorised to make a post'));
			$this->redirect(array('action' => 'index'));
		}
    if (!empty($this->request->data)) {
			$this->Post->create();
			// section edited by MD starts
			$this->request->data['Post']['user_id'] = $this->Auth->user('id'); // record creator of post
			if ($this->request->data['Post']['submittedfile']['size']>0 and $this->request->data['Post']['submittedfile']['name']!='') {
				$tmp_location = $this->request->data['Post']['submittedfile']['tmp_name'];
				$stored_location = $this->request->data['Post']['submittedfile']['name'];
  			$this->request->data['Post']['file_name'] = $this->request->data['Post']['submittedfile']['name'];
  			$this->request->data['Post']['file_type'] = $this->request->data['Post']['submittedfile']['type'];
  			$this->request->data['Post']['file_size'] = $this->request->data['Post']['submittedfile']['size'];
			} else {
			 	$this->request->data['Post']['file_name'] = '';
  			$this->request->data['Post']['file_type'] = '';
  			$this->request->data['Post']['file_size'] = 0;
			}
			unset($this->request->data['Post']['submittedfile']);
			// section edited by MD ends
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved' . '<br/>' . $tmp_location . '<br/>' . $stored_location ));
				if (isset($stored_location)) {
  				$stored_location = WWW_ROOT. 'cms_uploads' . DS . 'id_' . $this->Post->id . '_' . $stored_location;
  				move_uploaded_file( $tmp_location, $stored_location );
  			}	
  			$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		}
		/* modification by MD - user is unable to masquerade as somebody else so don't need to allow id selection in view
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
		*/ 
	}

	function edit($id = null) {
  	if ($this->Auth->user('role')!='admin') {
			$this->Session->setFlash(__('You are not authorised'));
			$this->redirect(array('action' => 'index'));
		}
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid post'));
			$this->redirect(array('action' => 'index'));
		}
    $this->Post->id = $id; // select Post by id 
		if (!empty($this->request->data)) {
			// section edited by MD starts
			if ($this->request->data['Post']['submittedfile']['size']>0) {
				$tmp_location = $this->request->data['Post']['submittedfile']['tmp_name'];
				$current_location = $this->Post->field('file_name');
				$stored_location = $this->request->data['Post']['submittedfile']['name'];
  			$this->request->data['Post']['file_name'] = $this->request->data['Post']['submittedfile']['name'];
  			$this->request->data['Post']['file_type'] = $this->request->data['Post']['submittedfile']['type'];
  			$this->request->data['Post']['file_size'] = $this->request->data['Post']['submittedfile']['size'];
			} else {
			 	// no upload so retain existing file
			}
			unset($this->request->data['Post']['submittedfile']);
			// section edited by MD ends
			$this->request->data['Post']['user_id'] = $this->Auth->user('id'); // record most recent editor of post
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been saved'));
				// section added by MD starts
				if (isset($stored_location)) { // if a file was uploaded
         $current_location = WWW_ROOT . 'cms_uploads'. DS . 'id_' . $id . '_' . $current_location;
         if (file_exists($current_location) ) { // delete any existing file 
        			 chmod(  $current_location ,0666); 
        				unlink( $current_location );
         }
         // store the uploaded file
      			$stored_location = WWW_ROOT. 'cms_uploads' . DS . 'id_' . $this->Post->id . '_' . $stored_location;
      			move_uploaded_file( $tmp_location, $stored_location );	
				}
				// section added by MD ends
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Post->read(null, $id);
		}
		/* modification by MD - user is unable to masquerade as somebody else so don't need to allow id selection in view
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
		*/ 
	}

	function delete($id = null) {
     		if ($this->Auth->user('role')!='admin') {
    			$this->Session->setFlash(__('You are not authorised'));
    			$this->redirect(array('action' => 'index'));
    		}
     		if (!$id) {
    			$this->Session->setFlash(__('Invalid id for post'));
    			$this->redirect(array('action'=>'index'));
    		}
				$this->Post->id = $id;
      // section added by MD starts to delete an optional file attached to the post
			 $stored_location = WWW_ROOT . 'cms_uploads'. DS . 'id_' . $id . '_' . $this->Post->field('file_name');
      if (file_exists($stored_location) ) {
    			 chmod(  $stored_location ,0666); 
    				unlink( $stored_location );
      }
				// section added by MD ends				
    		if ($this->Post->delete($id)) {
    			$this->Session->setFlash(__('Post deleted'));
					$this->redirect(array('action'=>'index'));
    		}
    		$this->Session->setFlash(__('Post was not deleted'));
    		$this->redirect(array('action' => 'index'));
	}
	
	
	function serve($id =  null) {
		$this->Post->id = $id;
		$this->response->file(WWW_ROOT . 'cms_uploads'. DS . 'id_' . $id . '_' . $this->Post->field('file_name'));
		return $this->response;
	} 
	
		public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
  



}

?>