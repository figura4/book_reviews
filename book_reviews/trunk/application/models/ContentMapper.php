<?php

class Application_Model_ContentMapper extends Common_ModelMapperAbstract implements Application_Model_ContentMapperInterface {
	protected $_reviewTypes = array(
				'content' => 'Application_Model_Content',
				'book'    => 'Application_Model_Review',
				'movie'   => 'Application_Model_Review',
				'tv'      => 'Application_Model_Review'
			);
	
	function __construct() {
		parent::__construct();
		$this->_dbTableType = 'Application_Model_DbTable_Contents';
		$this->_MappedModelType = 'Application_Model_Content';
		$this->_TagsContentsTableType = 'Application_Model_DbTable_TagsContents';
	}
	
	public function find($id) {
		$model = $this->getDbTable()->find($id)->current();
		if (is_object($model)) {
			return new $this->_reviewTypes[$model->type]($model->toArray());
		} else {
			return NULL;
		}
	}
	
	public function fetchAll($filters = array(), $order = null, $limit = null, $paginated = false, $itemsPerPage = 7) {
		$resultSet = array();
		$select = $this->getDbTable()->select();
	
		if(count($filters) > 0) {
			foreach ($filters as $field => $filter) {
				if ($field == 'pubDate') {
					$select->where($field . ' <= NOW()');
				} else {
					$select->where($field . ' = ?', $filter);
				}
			}
		}
	
		if(null != $order) {
			$select->order($order);
		}
	
		if(null != $limit) {
			$select->limit($limit, 0);
		}
	
		$rowSet = $this->getDbTable()->fetchAll($select);
	
		foreach ($rowSet as $row) {
			$resultSet[] = new $this->_reviewTypes[$row->type]($row->toArray());
		}
	
		if ($paginated) {
			$adapter = new Zend_Paginator_Adapter_Array($resultSet);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage($itemsPerPage);
			return $paginator;
		} else {
			return $resultSet;
		}
	}
	
	public function getContentTags($contentId) {
		$tagList = $this->getDbTable()->find($contentId)->current()->findManyToManyRowset('Application_Model_DbTable_Tags', 'Application_Model_DbTable_TagsContents')->toArray();
		$tags = array();
		foreach ($tagList as $tag) {
			array_push($tags, new Application_Model_Content($tag));
		}
		return $tags;
	}
	
	public function setContentTags($contentId, $tagsId = array()) {
		$tagsContentsTable = new $this->_TagsContentsTableType();
		$tagsContentsTable->delete('contentId = ' . $contentId);
		
		foreach ($tagsId as $tagId) {
			$tagsContentsTable->insert(array(
						'tagId'     => $tagId, 
						'contentId' => $contentId
					)
			);
		}
		return true;
	}
	
	public function getRecentContents($num = 5) {
		$select = $this->getDbTable()->select();
		$select->where('published = ?', '1');
		$select->where('pubDate <= NOW()');
		$select->order('createdOn DESC');
		$rowset = $this->getDbTable()->fetchAll($select);
		$contentsArray = array();
		
		foreach ($rowset as $row) {
			array_push($contentsArray, new $this->_reviewTypes[$row->type]($row->toArray()));
		}
		
		$adapter = new Zend_Paginator_Adapter_Array($contentsArray);
		$paginator = new Zend_Paginator($adapter);
		$paginator->setItemCountPerPage($num);
		
		return $paginator;		
	}
	
	public function getContentCommentsNumber($contentId) {
		$mapper = Zend_Registry::get('commentMapper');
			
		$select = $mapper->getDbTable()->select();
		$select->from($mapper->getDbTable(), array('count(*) as quantity'))
		->where('contentId = ?', $contentId);
	
		$rows = $mapper->getDbTable()->fetchAll($select);
	
		return($rows[0]->quantity);
	}
	
	public function getContentComments($contentId) {
		$table = Zend_Registry::get('commentMapper')->getDbTable();
	
		$select = $table->select()->where('contentId = ?', $contentId)
								  ->order('createdOn');
	
		$rowSet = $table->fetchAll($select);
		$contents = array();
		foreach ($rowSet as $content) {
			array_push($contents, new Application_Model_Comment($content->toArray()));
		}
		return $contents;
	}
	
	public function getReviewQuotes($contentId) {
		$table = Zend_Registry::get('quoteMapper')->getDbTable();
		
		$select = $table->select()->where('contentId = ?', $contentId)
								  ->order('createdOn DESC');
		
		$rowSet = $table->fetchAll($select);
		$quotes = array();
		foreach ($rowSet as $quote) {
			array_push($quotes, new Application_Model_Quote($quote->toArray()));
		}
		return $quotes;
	}
}

