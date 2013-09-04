<?php

class Zend_View_Helper_ReviewType extends Zend_View_Helper_Abstract
{
	public function reviewType($review)
	{
		switch($review->type) {
			case 'book':
				return 'libro';
				break;
				
			case 'tv':
				return 'tv';
				break;
				
			case 'movie':
				return 'film';
				break;
				
			default:
				return 'contenuto';
		}
	}
}