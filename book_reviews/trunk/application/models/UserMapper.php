<?php

class Application_Model_UserMapper extends Common_ModelMapperAbstract implements Application_Model_UserMapperInterface {
	function __construct() {
		parent::__construct();
		$this->_dbTableType = 'Application_Model_DbTable_Users';
		$this->_MappedModelType = 'Application_Model_User';
	}
	
	public function userExsists($username) {
		$table = $this->getDbTable();
		$select = $table->select();
		$select->where('username = ?', $username);
		$rows = $table->fetchAll($select);
		if (count($rows) > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}