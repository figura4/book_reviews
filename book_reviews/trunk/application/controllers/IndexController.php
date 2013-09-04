<?php

class IndexController extends Common_ControllerAbstract {
    public function init() {
    	
    }

    public function indexAction() {
    	$paginator = Zend_Registry::get('contentMapper')->fetchAll(array('published' => '1', 'pubDate' => Zend_Date::now()), 'createdOn DESC', null, true, 5);
    	$paginator->setCurrentPageNumber($this->getRequest()->getParam('page'));
    	
    	$page = $this->getRequest()->getParam('page');
    	$page = ($page == null || $page == '1') ? '' : " - page $page";
    	
    	$currentPage = $this->getRequest()->getParam('page');
    	$currentPage = ($currentPage == null) ? 1 : $currentPage;
    	$router = Zend_Controller_Front::getInstance()->getRouter();
    	$maxPage = $paginator->getTotalItemCount();
    	if ($currentPage != 1) {
    		$prev = $router->assemble(array('page' => ($currentPage - 1)), 'home');
    		$this->view->headLink(array('rel' => 'prev','href' => $prev),'APPEND');
    	}
    	if ($currentPage != $maxPage) {
    		$next = $router->assemble(array('page' => ($currentPage + 1)), 'home');
    		$this->view->headLink(array('rel' => 'next','href' => $next),'APPEND');
    	}
    		
    	$this->view->headTitle()->set(Zend_Registry::get('siteName') . ' - ' . Zend_Registry::get('siteSlogan') . $page);
    	$this->view->headMeta()->setName('description', Zend_Registry::get('siteDescription') . $page);

		$this->view->paginator = $paginator;
		$this->view->pageTitle = Zend_Registry::get('siteSlogan') . $page;
		Zend_Layout::getMvcInstance()->assign('pageTitle', Zend_Registry::get('siteSlogan') . $page);
    }
    
    public function aboutAction() {
    	$this->view->pageTitle = "About figura4";
    	$this->view->headTitle()->prepend('About figura4');
    	$form = new Application_Form_Contact();
    	 
    	$request = $this->getRequest();
    	$post = $request->getPost(); // This contains the POST params
    	 
    	if ($request->isPost()) {
    		if ($form->isValid($post)) {
    			if (!$this->spamCheck(array('name' => $post['email'], 'email' => $post['email'], 'comments' => $post['message']))) {
    				$message = 'From: ' . $post['email'] . chr(10) . 'Message: ' . $post['message'];
    				mail(Zend_Registry::get('adminMail'), 'Message from figura4.com', $message);
    				return $this->_helper->redirector('msgsent');
    			}
    		}
    	}
    	 
    	$this->view->form = $form;
    	
    	$this->view->headMeta()->setName('keywords', Zend_Registry::get('siteKeywords') . ', about');
    	$this->view->headMeta()->setName('description', "info e contatti per figura4");
    }
    
    public function msgsentAction() {
    	
    }
    
    public function linksAction() {
    	$this->view->pageTitle = "Links";
    	$this->view->headTitle()->prepend('Links');
    	$this->view->headMeta()->setName('keywords', Zend_Registry::get('siteKeywords') . ', links');
    	$this->view->headMeta()->setName('description', "links per figura4");
    }
    
    public function rssAction() {
    	$feedGenerator = new Application_Model_RssFeedGenerator();
    	$feed = $feedGenerator->getEmbeddedImagesFeed();
    	header('Content-type: text/xml');
    	
    	echo $feed->saveXML();
    	
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    } 
    
    public function sitemapAction() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->getHelper('layout')->disableLayout();
        $this->getResponse()->setHeader('Content-Type', 'text/xml; charset=utf-8');
        
        $sitemap = new Application_Model_Sitemap();
        
        $this->view->navigation($sitemap->getSitemap());
        echo $this->view->navigation()->sitemap();
    }
    
    public function redirectAction() {
    	$id = (int)$this->getRequest()->getParam('id');
    	
    	$content = Zend_Registry::get('contentMapper')->find($id);
    	
    	$router = Zend_Controller_Front::getInstance()->getRouter();
    	$url = $router->assemble(array('id' => $id, 'title' => $content->urlify()), $content->type . 'Reviews');
    	$this->redirect($url, array('code'=>301));
    }
}