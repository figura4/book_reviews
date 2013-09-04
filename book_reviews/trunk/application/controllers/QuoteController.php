<?php

class QuoteController extends Common_ControllerAbstract {

    public function init() {
    	$this->_model = 'Application_Model_Quote';  				
		$this->_mapper = Zend_Registry::get('quoteMapper'); 		
		$this->_form['create'] = 'Application_Form_Quote';   	
		$this->_form['edit'] = 'Application_Form_Quote';   		
		$this->_form['admin'] = 'Application_Form_QuoteList';   
		$this->_form['list'] = 'Application_Form_QuoteList';   	
    }

    public function createAction() {
    	$contentId = $this->getRequest()->getParam('contentId');
    	$action = ($contentId == '') ? "/quote/create" : "/quote/create/contentId/$contentId" ;
    	$this->view->pageTitle = "Nuova quote";
    	$this->view->headTitle()->prepend('Nuova quote');
    	$form = new $this->_form['create']();
        $form->setAction($action);
		$form->removeElement('id');
		$this->view->form = $form;
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		if ($contentId == '') {
    			unset($data['contentId']);
    		} else {
    			$data['contentId'] = $contentId;
    		}
    		$this->_mapper->save($data);
    		return $this->_helper->redirector('admin');
    	}    
    }

    public function editAction() {
    	$this->view->pageTitle = "Modifica quote";
    	$this->view->headTitle()->prepend('Modifica quote');
    	parent::editAction();
    }
}