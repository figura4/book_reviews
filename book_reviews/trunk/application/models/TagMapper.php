<?php

class Application_Model_TagMapper extends Common_ModelMapperAbstract implements Application_Model_TagMapperInterface {
	function __construct() {
		parent::__construct();
		$this->_dbTableType = 'Application_Model_DbTable_Tags';
		$this->_MappedModelType = 'Application_Model_Tag';
	}
	
	public function getTagContents(Application_Model_TagInterface $tag) {
		$table = $this->getDbTable();
		$select = $table->select()
               		    ->where('published = 1')
				        ->where('pubDate <= NOW()');
		
		$rowset = $table->find($tag->id)->current()->findManyToManyRowset('Application_Model_DbTable_Contents', 'Application_Model_DbTable_TagsContents', null, null, $select);
		
		$contents = array();
		foreach ($rowset as $content) {
			if ($content->type == 'content')
				array_push($contents, new Application_Model_Content($content->toArray()));
			else
				array_push($contents, new Application_Model_Review($content->toArray()));
		}
		
		return $contents;		
	}
	
	public function tagExsists($tagName) {
		$table = $this->getDbTable();
		$select = $table->select();
		$select->where('name = ?', $tagName);
		$rows = $table->fetchAll($select);
		if (count($rows) > 0) {
			return TRUE;
		} else {	
			return FALSE;
		}
	}
}