<?php

class Zend_View_Helper_FriendlyUrl extends Zend_View_Helper_Abstract {
	public function friendlyUrl ($object, $type) {
		switch ($type) { 
			case 'content': 
				$title = 'pageTitle';
				$route = 'blog';
				$controller = 'content';
				break;
				
			case 'book':
				$title = 'pageTitle';
				$route = 'bookReviews';
				$controller = 'content';
				break;
				
			case 'tv':
				$title = 'pageTitle';
				$route = 'tvReviews';
				$controller = 'content';
				break;
				
			case 'movie':
				$title = 'pageTitle';
				$route = 'movieReviews';
				$controller = 'content';
				break;
				
			case 'author': 
				$title = 'fullName';
				$route = 'authors';
				$controller = 'author';	
				break;
				
			default:
				$title = 'name';
				$route = 'tags';
				$controller = 'tag';
				break;
		}
		
		$title = $object->urlify($title);
		$router = Zend_Controller_Front::getInstance()->getRouter();
		$url = $router->assemble(array('id' => $object->id, 'title' => $title), $route);
		
		return $url;
	}
}