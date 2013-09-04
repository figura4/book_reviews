<?php

class Zend_View_Helper_CoverPath extends Zend_View_Helper_Abstract
{
	public function coverPath($review)
	{
		$path = Zend_Registry::get('coversRelPath');
		$fileName = $review->cover;
		return $path . $fileName;
	}
}