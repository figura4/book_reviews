<?php

Interface Application_Model_ContentMapperInterface extends Common_ModelMapperInterface {
	public function getContentTags($contentId);
	public function setContentTags($contentId, $tagsId = array());
	public function getRecentContents($num = 5);
	public function getContentComments($contentId);
	public function getContentCommentsNumber($contentId);
	public function getReviewQuotes($contentId);
}