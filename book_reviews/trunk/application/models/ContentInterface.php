<?php

Interface Application_Model_ContentInterface extends Common_ModelInterface {
	public function getTags();
	public function setTags($tags = array());
	public function getUser();
	public function getComments();
	public function getCommentsNumber();
	public function getPreview($chars, $trailing = '');
}