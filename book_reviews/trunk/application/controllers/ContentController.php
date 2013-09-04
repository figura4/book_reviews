<?php

class ContentController extends Common_ControllerAbstract {
    public function init() {
        $this->_model = 'Application_Model_Content';  			
		$this->_mapper = Zend_Registry::get('contentMapper'); 						
		$this->_form['createContent'] = 'Application_Form_Content';
		$this->_form['createBookReview'] = 'Application_Form_BookReview';
		$this->_form['createTvReview'] = 'Application_Form_TvReview';
		$this->_form['createMovieReview'] = 'Application_Form_MovieReview';
		$this->_form['edit'] = 'Application_Form_Content'; 
		$this->_form['comment'] = 'Application_Form_Comment';
		$this->_form['admin'] = 'Application_Form_ContentList';   
		$this->_form['list'] = 'Application_Form_ContentList';  
    }

    public function createContentAction() {
    	$this->view->pageTitle = "Nuovo post";
    	$this->view->headTitle()->prepend('Nuovo post');
    	$this->view->headScript()->appendFile('/js/imagemanager/js/mcimagemanager.js');
    	$this->view->headScript()->appendFile('/js/tiny_mce/tiny_mce.js');
    	$this->view->headScript()->appendFile('/js/mcimagemanager_config.js');
    	  		
    	$form = new $this->_form['createContent']();
    	$form->setAction('create-content');
    	$form->removeElement('id');
    	$this->view->form = $form;
    	
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['type'] = 'content';
    		$data['picture1'] = basename($this->view->form->picture1->getValue());
    		$data['picture2'] = basename($this->view->form->picture2->getValue());
    		$data['picture3'] = basename($this->view->form->picture3->getValue());
    		$data['additionalFields'] = array();
    		$auth = Zend_Auth::getInstance();
    		$data['userId'] = $auth->getIdentity()->id;
    		$tags = $data['tags'];
    		unset($data['tags']);
    		$id = $this->_mapper->save($data);
    		$this->_mapper->setContentTags($id, $tags);
    		return $this->_helper->redirector('admin');
    	}
    }
    
    public function createReviewAction() {
    	$type =  $this->getRequest()->getParam('type');
    	$this->view->pageTitle = "Nuova recensione";
    	$this->view->headTitle()->prepend('Nuova recensione');
       	$this->view->headScript()->appendFile('/js/imagemanager/js/mcimagemanager.js');
    	$this->view->headScript()->appendFile('/js/tiny_mce/tiny_mce.js');
    	$this->view->headScript()->appendFile('/js/mcimagemanager_config.js');
    		
    	$form = new $this->_form['create' . ucfirst($type) . 'Review']();
    	$form->setAction('/content/create-review/type/' . $type);
    	$form->removeElement('id');
    	$this->view->form = $form;
    	
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['pageTitle'] = $data['originalTitle'];
    		$data['type'] = $type;
    		$data['cover'] = basename($this->view->form->cover->getValue());
    		$auth = Zend_Auth::getInstance();
    		$data['userId'] = $auth->getIdentity()->id;
    		$tags = $data['tags'];
    		unset($data['tags']);
    		$id = $this->_mapper->save($data);
    		$this->_mapper->setContentTags($id, $tags);
    		return $this->_helper->redirector('admin');
    	}
    }

    public function editContentAction() {
    	$id = $this->getRequest()->getParam('id');
    	$this->view->pageTitle = "Modifica post";
    	$this->view->headTitle()->prepend('Modifica post');
    	$this->view->headScript()->appendFile('/js/imagemanager/js/mcimagemanager.js');
    	$this->view->headScript()->appendFile('/js/tiny_mce/tiny_mce.js');
    	$this->view->headScript()->appendFile('/js/mcimagemanager_config.js');
            	
    	$form = new $this->_form['edit']();
    	$form->setAction('/content/edit-content/id/' . $id);
    	$this->view->form = $form;
    	
    	$this->view->form = $this->populateForm($this->view->form);
        $this->view->form->getElement('tags')->setSelectedOptions($id);
             
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['type'] = 'content';
    		$data['picture1'] = basename($this->view->form->picture1->getValue());
    		$data['picture2'] = basename($this->view->form->picture2->getValue());
    		$data['picture3'] = basename($this->view->form->picture3->getValue());
    		$data['additionalFields'] = array();
    		$auth = Zend_Auth::getInstance();
    		$data['userId'] = $auth->getIdentity()->id;
    		$tags = $data['tags'];
    		unset($data['tags']);
    		$id = $this->_mapper->save($data);
    		$this->_mapper->setContentTags($id, $tags);
    		return $this->_helper->redirector('admin');
    	}
    }
    
    public function editReviewAction() {
    	$id = $this->getRequest()->getParam('id');
    	$type =  $this->getRequest()->getParam('type'); 
    	$this->view->pageTitle = "Modifica recensione";
    	$this->view->headTitle()->prepend('Modifica recensione');
    	$this->view->headScript()->appendFile('/js/imagemanager/js/mcimagemanager.js');
    	$this->view->headScript()->appendFile('/js/tiny_mce/tiny_mce.js');
    	$this->view->headScript()->appendFile('/js/mcimagemanager_config.js');
    	
    	$form = new $this->_form['create' . ucfirst($type) . 'Review']();
    	$form->setAction("/content/edit-review/id/$id/type/$type");
    	$this->view->form = $form;
    	$this->view->form = $this->populateForm($this->view->form);
    	$this->view->form->getElement('tags')->setSelectedOptions($id);
    	
    	if($this->FormPostedAndValid($this->view->form)) {
    		$data = $this->view->form->getValues();
    		$data['type'] = $type;
    		$data['cover'] = basename($this->view->form->cover->getValue());
    		$auth = Zend_Auth::getInstance();
    		$data['userId'] = $auth->getIdentity()->id;
    		$tags = $data['tags'];
    		unset($data['tags']);
    		$id = $this->_mapper->save($data);
    		$this->_mapper->setContentTags($id, $tags);
    		return $this->_helper->redirector('admin');
    	}
    }
    
    public function showContentAction() {
    	$id = $this->getRequest()->getParam('id');
    	$title = $this->getRequest()->getParam('title');
    	$this->view->content = $this->_mapper->find($id);
    	$urlyfiedTitle = $this->view->content->urlify();
    	
    	$form = new $this->_form['comment']();
    	$form->setAction("/blog/$id/$title");
    	$this->view->form = $form;
    	
    	if ($urlyfiedTitle != $title) {
    		$router = Zend_Controller_Front::getInstance()->getRouter();
    		$url = $router->assemble(array('id' => $id, 'title' => $urlyfiedTitle), 'blog');
    		$this->redirect($url);
    	} else {
    		$this->view->headLink()->appendStylesheet(Zend_Registry::get('cssRelPath') . 'scheda_screenshot.css');
    		$this->view->tags = $this->view->content->getTags();
    		$this->view->headTitle()->prepend($this->view->content->pageTitle);
    		$this->view->headMeta()->setName('keywords', Zend_Registry::get('siteKeywords') . ', ' . implode(', ', array($this->view->content->pageTitle, )));
    		$this->view->headMeta()->setName('description', 'Recesione di ' . $this->view->content->pageTitle);
    		$this->view->pageTitle = $this->view->content->pageTitle;
    		if($this->FormPostedAndValid($this->view->form)) {
    			$data = $this->view->form->getValues();
    			if (!$this->spamCheck(array('name' => $data['author'], 'email' => $data['email'], 'comments' => $data['body']))) {
    				$data['contentId'] = $id;
    				$auth = Zend_Auth::getInstance();
    				if($auth->hasIdentity()) {
    					$identity = $auth->getIdentity();
    					$role = strtolower($identity->role);
    					$admin = ($role == 'admin');
    				}
    				$data['author'] = (!$admin && strtolower($data['author']) == 'figura4') ? 'ospite' : $data['author'];
    				//unset($data['captcha']);
    				Zend_Registry::get('commentMapper')->save($data);
    				mail(Zend_Registry::get('adminMail'), 'Commento postato su figura4.com', 'qualcuno ha comentato la recensione di ' . $this->view->content->getTitle());
    				return $this->_redirect('/blog/$id/$title');
    			}
    		}
    	} 
    }

    public function showReviewAction() {
    	$id = $this->getRequest()->getParam('id');
    	$title = $this->getRequest()->getParam('title');
    	$this->view->content = $this->_mapper->find($id);
    	$urlyfiedTitle = $this->view->content->urlify();

    	$form = new $this->_form['comment']();
    	$form->setAction("/recensioni/libri/$id/$title");
    	$this->view->form = $form;
    	
    	if ($urlyfiedTitle != $title) {
    		$router = Zend_Controller_Front::getInstance()->getRouter();
    		$url = $router->assemble(array('id' => $id, 'title' => $urlyfiedTitle), 'bookReviews');
    		$this->redirect($url);
    	} else {
    		$this->view->headLink()->appendStylesheet(Zend_Registry::get('cssRelPath') . 'scheda_screenshot.css');
    		$this->view->headScript()->appendFile('/js/stars.js');
    		$this->view->author = $this->view->content->getAuthor();

    		switch($this->view->content->type) {
    			case 'book':
    				$type = 'libro';
    				break;
    				 
    			case 'tv':
    				$type =  'serie tv';
    				break;
    				 
    			case 'movie':
    				$type =  'film';
    				break;
    				 
    			default:
    				$type = '';
    		}
    		
    		$this->view->headTitle()->set($this->view->content->getTitle() . " - Recensione " . $type);
    		$this->view->headMeta()->setName('keywords', implode(', ', array($this->view->content->pageTitle, $this->view->author->getFullName()) ) . ', ' . Zend_Registry::get('siteKeywords'));
    		$this->view->headMeta()->setName('description', 'Recensione ' . $this->view->reviewType($this->view->content) . ' ' . $this->view->content->getTitle() . ' di ' . $this->view->author->getFullName() . ' con citazioni e note biografiche sull\'autore. ' . $this->view->getFirstSentence($this->view->content->body));
    		$this->view->pageTitle = $this->view->content->getTitle();
    		if($this->FormPostedAndValid($this->view->form)) {
    			$data = $this->view->form->getValues();
    			if (!$this->spamCheck(array('name' => $data['author'], 'email' => $data['email'], 'comments' => $data['body']))) {
    				$data['contentId'] = $id;
    				$auth = Zend_Auth::getInstance();
    				if($auth->hasIdentity()) {
    					$identity = $auth->getIdentity();
    					$role = strtolower($identity->role);
    					$admin = ($role == 'admin');
    				}
    				$data['author'] = (!$admin && strtolower($data['author']) == 'figura4') ? 'ospite' : $data['author'];
    				//unset($data['captcha']);
    				Zend_Registry::get('commentMapper')->save($data);
    				mail(Zend_Registry::get('adminMail'), 'Commento postato su figura4.com', 'qualcuno ha comentato la recensione di ' . $this->view->content->getTitle());
    				return $this->_redirect("/recensioni/libri/$id/$title");
    			}
    		}   		
    	}
    }
    
    public function listReviewsAction() {
    	$type =  $this->getRequest()->getParam('type');
    	switch ($type) {
    		case 'book': 
    			$formattedType = 'Libri'; 
    			$text = '<p>Questo &egrave; il punto di partenza per chi cerca un buon libro da tenere sul comodino.<br>
    					Troverete principalmente romanzi di <strong>fantascienza</strong>, <strong>fantasy</strong> e <strong>speculative fiction</strong> in generale. Ma non solo, perch&egrave; tento di mantenere aperti i miei orizzonti letterari.</p>
    					<p>Spero che possiate trovare qualche spunto interessante, e se poi vorrete magari ricambiare il favore, contattatemi senza esitare!</p>';
    			break;
    		case 'movie': 
    			$formattedType = 'Film'; 
    			$text = '<p>Qui trovate le mie recensioni cinematografiche. Ammetto che si tratta probabilmente della sezione del sito che trascuro di pi&ugrave;, poich&egrave; preferisco recensire solo i film pi&ugrave; di nicchia e meno conosciuti.<br>
    					Anche qui i generi predominanti sono la <strong>fantascienza</strong>, <strong>fantasy</strong> e <strong>speculative fiction</strong> in generale. Ma anche il <strong>cinema asiatico</strong> e <strong>indie</strong>.</p>
    					<p>Spero che possiate trovare qualche spunto interessante, e se poi vorrete magari ricambiare il favore, contattatemi senza esitare!</p>';
    			break;
    		case 'tv': 
    			$formattedType = 'Serie Tv'; 
    			$text = '<p>Confesso che passo molto, anzi troppo tempo guardando serie tv, da quelle pi&ugrave; mainstream a quelle meno note ("The Wire" &egrave; la mia preferita!).<br>
    					Qui non troverete recensioni dei singoli episodi, ma solo di serie complete. Quindi prima di recensire una serie generalmente aspetto che sia terminata. Scelta probabilmente poco poplare, ma preferisco cos&igrave;.</p>
    					<p>Spero che possiate trovare qualche spunto interessante, e se poi vorrete magari ricambiare il favore, contattatemi senza esitare!</p>';
    			break;
    	}
    	$this->view->pageTitle = "$formattedType recensiti";
    	$this->view->pageText = $text;
    	$this->view->headScript()->appendFile('/js/stars.js');
    	$this->view->headTitle()->set("$formattedType recensiti - cerca qui nuovi interessanti spunti in salsa speculative fiction!");
    	$this->view->headMeta()->setName('keywords', Zend_Registry::get('siteKeywords') . ', Lista recensioni');
    	$this->view->headMeta()->setName('description', 'Lista di ' . strtolower($formattedType) . ' recensiti da figura4. Ottimo punto di partenza per iniziare ad esplorare il sito; puoi ordinare le recensioni in base al voto, al titolo o all\'autore.');
    	$this->getList(array('type' => $type, 'published' => '1', 'pubDate' => Zend_Date::now()), 'vote DESC', null, false);
    }
    
    public function listContentsAction() {
    	$page = $this->getRequest()->getParam('page');
    	$page = ($page == null || $page == '1') ? '' : " ($page)";
    	$this->view->headTitle()->set(Zend_Registry::get('siteName') . ' - Blog ' . $page );
    	$this->view->headMeta()->setName('description', Zend_Registry::get('siteDescription') . $page);
    	$paginator = Zend_Registry::get('contentMapper')->fetchAll(array('published' => '1', 'type' => 'content', 'pubDate' => Zend_Date::now()), 'createdOn DESC', null, true, 5);
    	$paginator->setCurrentPageNumber($this->getRequest()->getParam('page'));
    	$this->view->paginator = $paginator;
    	$this->view->pageTitle = Zend_Registry::get('siteSlogan') . $page;
    	Zend_Layout::getMvcInstance()->assign('pageTitle', Zend_Registry::get('siteSlogan') . $page);
    }
    
    protected function save($data = array()) {
    	$id = parent::save($data);
    	Zend_Registry::get($this->_mapper)->setContentTags($id, $data['tags']);
    }
}