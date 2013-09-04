<?php

class Zend_View_Helper_Avatar extends Zend_View_Helper_Abstract
{
	public function avatar($comment)
	{
		$admin = false;
		if (strtolower($comment->author) == 'figura4')
			$admin = true;
		$path = Zend_Registry::get('avatarsRelPath');
		$fileName = ($admin) ? 'dude.jpeg' : 'guest.jpg';
		$fullPath =  $path . $fileName;
		return '<img src="' . $fullPath . '" class="avatar" alt="avatar">';
	}
}