<?php

class Application_Model_Quote extends Common_ModelAbstract implements Application_Model_QuoteInterface {
	protected $_id;
    protected $_body;
    protected $_source;
    protected $_contentId;
    protected $_random;
    protected $_createdOn;
    protected $_updatedOn;
    
   	public function __construct(array $options = null) {
   		$this->_mapperType = "quoteMapper";	
   		parent::__construct($options);
   	}
    
   	public function getReview() {
   		$mapper = Zend_Registry::get('contentMapper');
   		$review = $mapper->find($this->contentId);
   		return $review;
   	}
   	
    public function toArray() {
    	$result = array(
    				'id' => $this->id,
    				'body' => $this->body,
    				'source' => $this->source,
    				'contentId' => $this->contentId,
    				'random' => $this->random,
    				'createdOn' => $this->createdOn,
    				'updatedOn' => $this->updatedOn
    			);
    	return $result;
    }
}
