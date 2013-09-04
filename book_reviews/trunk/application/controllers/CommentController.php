<?php

class CommentController extends Common_ControllerAbstract {

    public function init() {
    	$this->_model = 'Application_Model_Comment';  				
		$this->_mapper = Zend_Registry::get('commentMapper'); 		
		$this->_form['create'] = 'Application_Form_Comment';   	
		$this->_form['edit'] = 'Application_Form_Comment';   		
		$this->_form['admin'] = 'Application_Form_CommentList';   
		$this->_form['list'] = 'Application_Form_CommentList';   	
    }
   
    public function createAction() {
    	$this->view->pageTitle = "Nuovo commento";
    	$this->view->headTitle()->prepend('Nuovo commento');
		$contentId = $this->getRequest()->getParam('contentId');
    	$action = "/comment/create/contentId/$contentId";
    	$form = new $this->_form['create']();
    	$form->setAction($action);
    	$form->removeElement('id');
    	$this->view->form = $form;
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['contentId'] = $contentId;
    		unset($data['captcha']);
    		$this->_mapper->save($data);
    		$content = Zend_Registry::get('contentMapper')->find($contentId);
    		mail(Zend_Registry::get('adminMail'), 'Commento postato su figura4.com', 'qualcuno ha comentato la recensione di ' . $content->getTitle());
    		return $this->_helper->redirector('admin');
    	}
    }
}