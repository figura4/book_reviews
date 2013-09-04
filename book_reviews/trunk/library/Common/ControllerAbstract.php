<?php

/**
 * Abstract class representing a controller.
*
*/

class Common_ControllerAbstract extends Zend_Controller_Action {
	// Properties to be initialized in controller init method
	protected $_model;  // model class
	protected $_mapper; // MapperInterface
	protected $_form = array();   // form class
	
	public function createAction() {
    	$this->view->form = $this->setFormProperties('create');
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$this->_mapper->save($data);
    		return $this->_helper->redirector('admin');
    	}    	
    }
	
	public function editAction() {
    	$this->view->form = $this->setFormProperties('edit');
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$this->_mapper->save($data);
    		return $this->_helper->redirector('admin');
    	}
    }
	
	public function deleteAction() {
		$this->_mapper->delete($this->getRequest()->getParam('id'));
		return $this->_helper->redirector('admin');
	}
	
	public function adminAction() {
		$this->view->form = $this->setFormProperties('admin');
		
		$filter = null;
		$sort = 'createdOn DESC';
		
		if($this->FormPostedAndValid($this->view->form)) {
			$sort = $this->view->form->getValue('sort');
			$filterFieldValue = $this->view->form->getValue('filter_field');
			$filter[$filterFieldValue] = $this->view->form->getValue('filter');
		}
		
		$page = $this->getRequest()->getParam('page', 1);
		$paginator = $this->_mapper->fetchAll($filter, $sort, null, true, 15);
		$paginator->setCurrentPageNumber($page);
		
		$this->view->paginator = $paginator;
	}
	
	protected function getList($filters = array(), $order = null, $limit = null, $paginated = false, $itemsPerPage = 7) {
		$this->view->headScript()->appendFile('/js/jquery.tablesorter/jquery.tablesorter.js');
		$this->view->headLink()->prependStylesheet(Zend_Registry::get('cssRelPath') . 'tablesorter.css');
		$this->view->items = $this->_mapper->fetchAll($filters, $order, $limit, $paginated, $itemsPerPage);
	}
	
	protected function setFormProperties($action) {
		$form = new $this->_form[$action]();
		
		switch ($action) {
			case 'create':
				$form->setAction('create');
				$form->removeElement('id');
				break;
				
			case 'edit':
				$request = $this->getRequest();
				$controller = $request->getControllerName();
				$action = $request->getActionName();
				$form->setAction('/' . $controller . '/' . $action . '/id/' . $this->getRequest()->getParam('id'));
				$this->populateForm($form);
				break;
				
			case 'list':
				$form->setAction('list');
				break;
				
			case 'admin':
				$form->setAction('admin');
				break;
				
			case 'login':
				$form->setAction('login');
				break;
				
			default:
		}
		
		return $form;
	}
	
	protected function populateForm($form) {
		$model = $this->_mapper->find($this->getRequest()->getParam('id'));
		if (is_object($model))
			$form->populate($model->toArray());
		return $form;
	}
	
	protected function FormPostedAndValid($form) {
		$request = $this->getRequest();
		if ($request->isPost()) {
			if ($form->isValid($request->getPost())) {
				return true;	
			}	
		}
		return false;
	}
	
	protected function spamCheck($items){
		$url = "http://www.figura4.com"; // url associated with API key
		$api = "fe1bd8f73d4f"; // Akismet API key
		$spam = new Zend_Service_Akismet($api, $url ); // create new instance of our Akismet Service class
		if ($spam->verifyKey()){ // make sure the API key if valid before performing check
			$params = array(); // check the comments for the isSpam() method in Zend/Service/Askismet.php for more information on available parameters
			$params["user_ip"] = $_SERVER['REMOTE_ADDR']; // required by Akismet
			$params["user_agent"] = $_SERVER['HTTP_USER_AGENT']; // required by Akismet
			$params["referrer"] = $_SERVER[ 'HTTP_REFERER'];
			$params["comment_type"] = "comment";
			$params["comment_author"] = $items["name"];
			$params["comment_author_email"] = $items["email"];
			$params["comment_content"] = $items["comments"];
			return $spam->isSpam($params); // submits api call and returns true if spam, false if clean
		} else {
			return false;
		}
	}
	
}