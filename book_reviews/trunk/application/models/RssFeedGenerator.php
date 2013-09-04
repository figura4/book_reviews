<?php

class Application_Model_RssFeedGenerator {
	protected $_mapper;
	
	public function __construct() {
		$this->_mapper = Zend_Registry::get('contentMapper');
	}
	
    public function getEmbeddedImagesFeed($numberOfEntries = 5) {
    	$contents = $this->_mapper->getRecentContents($numberOfEntries);
    	 
    	$contents_array = array();
    	
    	foreach ($contents as $content) {
    		$router = Zend_Controller_Front::getInstance()->getRouter();
    		$route = ($content->type == 'content') ? 'blog' : $content->type . 'Reviews' ;
    		$url = $router->assemble(array('id' => $content->id, 'title' => $content->urlify()), $route);
    
    		$element = array();
    		$element['title'] = $content->pageTitle;
    		$element['description'] = '<p>';
    		if ($content->type != 'content') 
      			$element['description'] .= '<img src="' . Zend_Registry::get('siteBaseUrl') . Zend_Registry::get('coversRelPath') . $content->cover . '" alt="' . $content->pageTitle . '" title="' . $content->pageTitle . '" style="float: left; margin-right: 10px; margin-bottom: 10px;" />';				 
    		$element['description'] .= substr($content->getPreview(600, '(...)'), 3);
    		$element['link'] = Zend_Registry::get('siteBaseUrl') . $url;
    		$element['guid'] = Zend_Registry::get('siteBaseUrl') . $url;
    		$element['lastUpdate'] = strtotime($content->updatedOn);
    		
    		array_push($contents_array, $element);
    	}
    
    	$feedData = array(
    			'title' => Zend_Registry::get('siteName'),
    			'description' => Zend_Registry::get('siteDescription'),
    			'link' => Zend_Registry::get('siteBaseUrl'),
    			'charset' => 'utf8',
    			'entries' => $contents_array
    	);
    	return Zend_Feed::importArray($feedData, 'rss');
    }
}