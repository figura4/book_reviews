<?php

class Zend_View_Helper_AuthorPicture extends Zend_View_Helper_Abstract
{
	public function authorPicture($author, $class = 'attachment-featured wp-post-image')
	{
		$path = Zend_Registry::get('authorPicsRelPath');
		$fileName = $author->picture;
		$fullPath =  $path . $fileName;
		return '<img src="' . $fullPath . '" class="' . $class . '" alt="Foto di ' . $author->getFullName() . '" width="150">';
	}
}