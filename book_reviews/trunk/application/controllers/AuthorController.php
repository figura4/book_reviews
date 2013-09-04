<?php

class AuthorController extends Common_ControllerAbstract {

    public function init() {
    	$this->_model = 'Application_Model_Author';  				
		$this->_mapper = Zend_Registry::get('authorMapper'); 		
		$this->_form['create'] = 'Application_Form_Author';   	
		$this->_form['edit'] = 'Application_Form_Author';   		
		$this->_form['admin'] = 'Application_Form_AuthorList';   
		$this->_form['list'] = 'Application_Form_AuthorList';   	
    }
   
    public function listAction() {
    	$this->view->pageTitle = "Elenco degli autori recensiti da figura4";
    	$this->view->headTitle()->prepend("Elenco degli autori recensiti");
    	$this->view->headMeta()->setName('keywords', Zend_Registry::get('siteKeywords') . ', elenco autori recensiti');
    	$this->view->headMeta()->setName('description', 'Elenco degli autori dei libri, film e serie tv recensiti da figura4');
    	$this->getList(null, 'lastName', null, false);
    }

    public function createAction() {
    	$this->view->pageTitle = "Nuovo autore";
    	$this->view->headTitle()->prepend('Nuovo autore');
    	$this->view->headScript()->appendFile('/js/imagemanager/js/mcimagemanager.js');
    	$this->view->headScript()->appendFile('/js/tiny_mce/tiny_mce.js');
    	$this->view->headScript()->appendFile('/js/mcimagemanager_config.js');
    	
    	$this->view->form = $this->setFormProperties('create');
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['picture'] = basename($this->view->form->picture->getValue());
    		$this->_mapper->save($data);
    		return $this->_helper->redirector('admin');
    	}
    }

    public function editAction() {
    	$this->view->pageTitle = "Modifica autore";
    	$this->view->headTitle()->prepend('Modifica autore');
    	$this->view->headScript()->appendFile('/js/imagemanager/js/mcimagemanager.js');
    	$this->view->headScript()->appendFile('/js/tiny_mce/tiny_mce.js');
    	$this->view->headScript()->appendFile('/js/mcimagemanager_config.js');
    	
    	$this->view->form = $this->setFormProperties('edit');
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['picture'] = basename($this->view->form->picture->getValue());
    		$this->_mapper->save($data);
    		return $this->_helper->redirector('admin');
    	}
    }
    
    public function showAction() {
    	$id = $this->getRequest()->getParam('id');
    	$title = $this->getRequest()->getParam('title');
    	$this->view->author = $this->_mapper->find($id);
    	$urlyfiedTitle = $this->view->author->urlify();
    	
    	if ($urlyfiedTitle != $title) {
    		$router = Zend_Controller_Front::getInstance()->getRouter();
    		$url = $router->assemble(array('id' => $id, 'title' => $urlyfiedTitle), 'authors');
    		$this->redirect($url);
    	} else {
    		$this->view->headLink()->prependStylesheet(Zend_Registry::get('cssRelPath') . 'tablesorter.css');
    		$this->view->headScript()->appendFile('/js/jquery.tablesorter/jquery.tablesorter.js');
    		$this->view->contents = $this->view->author->getReviews();
    		$this->view->headTitle()->prepend($this->view->author->getFullName());
    		$this->view->pageTitle = $this->view->author->getFullName() . ', informazioni biografiche';
    		$this->view->headMeta()->setName('keywords', Zend_Registry::get('siteKeywords') . ', ' . implode(', ', array($this->view->author->getFullName(), )));
    		$this->view->headMeta()->setName('description', 'informazioni biografiche su ' . $this->view->author->getFullName() . '. vita, opere principali e curiosità');
    	}
    }
}