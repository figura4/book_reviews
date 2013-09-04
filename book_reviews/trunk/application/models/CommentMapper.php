<?php

class Application_Model_CommentMapper extends Common_ModelMapperAbstract implements Application_Model_CommentMapperInterface {
	function __construct() {
		parent::__construct();
		$this->_dbTableType = 'Application_Model_DbTable_Comments';
		$this->_MappedModelType = 'Application_Model_Comment';
	}
}