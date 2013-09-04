<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload() {
		$autoLoader = Zend_Loader_Autoloader::getInstance();
		$autoLoader->registerNamespace('Common_');
	}
	
	protected function _initDoctype() {
		$this->bootstrap('view');
		$this->bootstrap('GlobalParams');
		$view = $this->getResource('view');
		
		$view->doctype('HTML5');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
		
		// Mobile-specific
		$view->headMeta()->appendName('viewport', 'width=device-width, initial-scale=1.0');
		$view->headMeta()->appendName('apple-mobile-web-app-capable', 'yes');
		$view->headMeta()->appendName('apple-mobile-web-app-status-bar-style', 'black');
		
		$view->headMeta()->appendName('robots', 'index, follow');
		$view->headMeta()->appendName('keywords', Zend_Registry::get('siteKeywords'));
		$view->headMeta()->appendName('author', Zend_Registry::get('siteAuthor'));
		$view->headMeta()->appendName('description', Zend_Registry::get('siteDescription'));
		
		$view->headTitle()->setSeparator(' - ');
		$view->headTitle(Zend_Registry::get('siteName'));
		
		$view->headLink()->appendStylesheet(Zend_Registry::get('cssRelPath') . 'style.css');
		$view->headLink()->appendStylesheet(Zend_Registry::get('cssRelPath') . 'misc.css');
		$view->headLink()->headLink(array('rel' => 'shortcut icon', 'href' => '/images/images/favicon.ico'), 'PREPEND');
		$view->headLink()->appendAlternate('/rss/', 'application/rss+xml', 'RSS Feed');
	}
	
	protected function _initJavascript() {
		$this->bootstrap('view');
		$view = $this->getResource('view'); 

		$view->headScript()->appendFile('/js/rateit/src/jquery.rateit.min.js');
		
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		
		$view->jQuery()->enable()
					->setVersion('1.8.3')
					->setUiVersion('1.9.2')
					->addStylesheet('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-lightness/jquery-ui.css')
					->uiEnable();
		
		$view->headScript()->appendFile('/js/modernizr.js');
		$view->headScript()->appendFile('/js/customscript.js', $type = 'text/javascript');
		
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	}
	
	protected function _initRouter() {
		$frontController = Zend_Controller_Front::getInstance();
		$router = $frontController->getRouter();

		$route = new Zend_Controller_Router_Route(
				'review/show/:id',
				array(
						'controller' => 'index',
						'action'     => 'redirect'
				)
		);
		$router->addRoute('redirectOldPages', $route);
		
		$route = new Zend_Controller_Router_Route(
				'page/:page',
				array(
						'controller' => 'index',
						'action'     => 'index'
				)
		);
		$router->addRoute('home', $route);
		
		$route = new Zend_Controller_Router_Route(
				'recensioni/libri',
				array(
						'controller' => 'content',
						'action'     => 'list-reviews',
						'type'     => 'book'
				)
		);
		$router->addRoute('bookReviewsList', $route);
		
		$route = new Zend_Controller_Router_Route(
				'recensioni/libri/:id/:title',
				array(
						'controller' => 'content',
						'action'     => 'show-review'
				)
		);
		$router->addRoute('bookReviews', $route);
		
		$route = new Zend_Controller_Router_Route(
				'recensioni/film',
				array(
						'controller' => 'content',
						'action'     => 'list-reviews',
						'type'     => 'movie'
				)
		);
		$router->addRoute('movieReviewsList', $route);
		
		$route = new Zend_Controller_Router_Route(
				'recensioni/film/:id/:title',
				array(
						'controller' => 'content',
						'action'     => 'show-review'
				)
		);
		$router->addRoute('movieReviews', $route);
		
		$route = new Zend_Controller_Router_Route(
				'recensioni/tv',
				array(
						'controller' => 'content',
						'action'     => 'list-reviews',
						'type'     => 'tv'
				)
		);
		$router->addRoute('tvReviewsList', $route);
		
		$route = new Zend_Controller_Router_Route(
				'recensioni/tv/:id/:title',
				array(
						'controller' => 'content',
						'action'     => 'show-review'
				)
		);
		$router->addRoute('tvReviews', $route);
		
		$route = new Zend_Controller_Router_Route(
				'blog',
				array(
						'controller' => 'content',
						'action'     => 'list-contents'
				)
		);
		$router->addRoute('blogHome', $route);
		
		$route = new Zend_Controller_Router_Route(
				'blog/:page',
				array(
						'controller' => 'content',
						'action'     => 'list-contents'
				)
		);
		$router->addRoute('blogList', $route);
		
		$route = new Zend_Controller_Router_Route(
				'blog/:id/:title',
				array(
						'controller' => 'content',
						'action'     => 'show-content'
				)
		);
		$router->addRoute('blog', $route);

		$route = new Zend_Controller_Router_Route(
				'author/list',
				array(
						'controller' => 'author',
						'action'     => 'list'
				)
		);
		$router->addRoute('authorsList', $route);
		
		$route = new Zend_Controller_Router_Route(
				'author/:id/:title',
				array(
						'controller' => 'author',
						'action'     => 'show'
				)
		);
		$router->addRoute('authors', $route);

		$route = new Zend_Controller_Router_Route(
				'tag/:id/:title',
				array(
						'controller' => 'tag',
						'action'     => 'show'
				)
		);
		$router->addRoute('tags', $route);
		
		
		$route = new Zend_Controller_Router_Route_Static(
				'about',
				array('controller' => 'index', 'action' => 'about')
		);
		$router->addRoute('about', $route);
		
		$route = new Zend_Controller_Router_Route_Static(
				'contact',
				array('controller' => 'index', 'action' => 'contact')
		);
		$router->addRoute('contact', $route);
		
		$route = new Zend_Controller_Router_Route_Static(
				'links',
				array('controller' => 'index', 'action' => 'links')
		);
		$router->addRoute('links', $route);
		
		$route = new Zend_Controller_Router_Route_Static(
				'rss',
				array('controller' => 'index', 'action' => 'rss')
		);
		$router->addRoute('rss', $route);
		
		$route = new Zend_Controller_Router_Route_Static(
				'sitemap',
				array('controller' => 'index', 'action' => 'sitemap')
		);
		$router->addRoute('sitemap', $route);
	}
	
	protected function _initLogger() {
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . "/../logs/application.log");
		$logger = new Zend_Log($writer);
		Zend_Registry::set("logger", $logger);
	}
	
	protected function _initMappers() {
		$authorMapper = new Application_Model_AuthorMapper();
		Zend_Registry::set("authorMapper", $authorMapper);
		
		$commentMapper = new Application_Model_CommentMapper();
		Zend_Registry::set("commentMapper", $commentMapper);
		
		$contentMapper = new Application_Model_ContentMapper();
		Zend_Registry::set("contentMapper", $contentMapper);
		
		$quoteMapper = new Application_Model_QuoteMapper();
		Zend_Registry::set("quoteMapper", $quoteMapper);
		
		$tagMapper = new Application_Model_TagMapper();
		Zend_Registry::set("tagMapper", $tagMapper);
		
		$userMapper = new Application_Model_UserMapper();
		Zend_Registry::set("userMapper", $userMapper);
	}
	
	protected function _initGlobalParams() {
		$this->bootstrap('view');
		$view = $this->getResource('view');
		
		$globalParams = $this->getOption('globalParams');
		Zend_Registry::set('siteName', $globalParams['siteName']);
		Zend_Registry::set('siteDescription', $globalParams['siteDescription']);
		Zend_Registry::set('siteSlogan', $globalParams['siteSlogan']);
		Zend_Registry::set('siteAuthor', $globalParams['siteAuthor']);
		Zend_Registry::set('siteKeywords', $globalParams['siteKeywords']);
		Zend_Registry::set('siteBaseUrl', $view->serverUrl());
		Zend_Registry::set('adminMail', $globalParams['adminMail']);
		Zend_Registry::set('imagesRelPath', $globalParams['imagesRelPath']);
		Zend_Registry::set('coversRelPath', $globalParams['coversRelPath']);
		Zend_Registry::set('authorPicsRelPath', $globalParams['authorPicsRelPath']);
		Zend_Registry::set('avatarsRelPath', $globalParams['avatarsRelPath']);
		Zend_Registry::set('picturesRelPath', $globalParams['picturesRelPath']);
		Zend_Registry::set('cssRelPath', $globalParams['cssRelPath']);
		Zend_Registry::set('itemsInNavMenu', $globalParams['itemsInNavMenu']);
		Zend_Registry::set('twitterUsername', $globalParams['twitterUsername']);
		Zend_Registry::set('twitterAccessToken', $globalParams['twitterAccessToken']);
		Zend_Registry::set('twitterAccessTokenSecret', $globalParams['twitterAccessTokenSecret']);
		Zend_Registry::set('twitterConsumerKey', $globalParams['twitterConsumerKey']);
		Zend_Registry::set('twitterConsumerKeySecret', $globalParams['twitterConsumerKeySecret']);
	}
	
	protected function _initErrorDisplay(){
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->throwExceptions(true);
	}
}


