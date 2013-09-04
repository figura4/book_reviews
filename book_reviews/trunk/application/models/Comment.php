<?php

class Application_Model_Comment extends Common_ModelAbstract implements Application_Model_CommentInterface {
	protected $_id;
    protected $_body;
    protected $_author;
    protected $_email;
    protected $_homepage;
    protected $_contentId;
    protected $_createdOn;
    protected $_updatedOn;
    
   	public function __construct(array $options = null) {
   		$this->_mapperType = "commentMapper";	
   		parent::__construct($options);
   	}
    
    public function toArray() {
    	$result = array(
    				'id' => $this->id,
    				'body' => $this->body,
    				'author' => $this->author,
    				'email' => $this->email,
    				'homepage' => $this->homepage,
    				'contentId' => $this->contentId,
    				'createdOn' => $this->createdOn,
    				'updatedOn' => $this->updatedOn
    			);
    	return $result;
    }
}
