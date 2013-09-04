<?php

Interface Application_Model_AuthorInterface extends Common_ModelInterface {
	public function getFullName($LastNamefirst = false);
	public function getReviews();
	public function getBioPreview($chars, $trailing = '');
	public function getReviewsNumber();
}