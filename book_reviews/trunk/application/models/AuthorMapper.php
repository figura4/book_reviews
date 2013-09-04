<?php

class Application_Model_AuthorMapper extends Common_ModelMapperAbstract implements Application_Model_AuthorMapperInterface {
	function __construct() {
		parent::__construct();
		$this->_dbTableType = 'Application_Model_DbTable_Authors';
		$this->_MappedModelType = 'Application_Model_Author';
	}
	
	public function getAuthorReviews(Application_Model_AuthorInterface $author, $published = true, $limit = null) {
		$table = Zend_Registry::get('contentMapper')->getDbTable();
		
		$select = $table->select()->where('authorId = ?', $author->id)
					              ->order('createdOn DESC');
		if ($published) {
			$select->where('published = 1')
				   ->where('pubDate <= NOW()');
		}	
	
		if (!is_null($limit))
			$select->limit($limit);
		
		$rowSet = $table->fetchAll($select);
		$reviews = array();
		foreach ($rowSet as $review) {
			array_push($reviews, new Application_Model_Review($review->toArray()));
		}
		return $reviews;
	}
}