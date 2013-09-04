<?php

class Zend_View_Helper_Cover extends Zend_View_Helper_Abstract
{
	public function cover($review, $class = 'attachment-featured wp-post-image')
	{
		$path = Zend_Registry::get('coversRelPath');
		$fileName = $review->cover;
		$fullPath =  $path . $fileName;
		$coverType = ($review->type == 'book') ? 'Copertina' : 'Locandina' ;
		return '<img src="' . $fullPath . '" class="' . $class . '" alt="' . $coverType .' di ' . $review->originalTitle . '" width="150">';
	}
}