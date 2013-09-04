<?php

Interface Application_Model_AuthorMapperInterface extends Common_ModelMapperInterface {
	public function getAuthorReviews(Application_Model_AuthorInterface $author, $published = true, $limit = null);
}