<?php

class Application_Model_QuoteMapper extends Common_ModelMapperAbstract implements Application_Model_QuoteMapperInterface {
	function __construct() {
		parent::__construct();
		$this->_dbTableType = 'Application_Model_DbTable_Quotes';
		$this->_MappedModelType = 'Application_Model_Quote';
	}
	
	public function getRandomQuote() {
		$table = $this->getDbTable();
		$select = $table->select()
				->where('random', '1')
				->order('RAND()')
				->limit(1);
		
		$quote = $table->fetchAll($select);
		
		return new $this->_MappedModelType($quote->current()->toArray());
	}
}