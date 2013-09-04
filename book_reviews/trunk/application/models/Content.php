<?php

class Application_Model_Content extends Common_ModelAbstract implements Application_Model_ContentInterface {
	protected $_id;
	protected $_pageTitle;
	protected $_userId;
	protected $_published;
	protected $_type;
	protected $_body;
	protected $_picture1;
	protected $_picture2;
	protected $_picture3;
	protected $_pubDate;
	protected $_createdOn;
	protected $_updatedOn;
 
    public function __construct(array $options = null) {
    	$this->_mapperType = "contentMapper";
    	parent::__construct($options);
    }
    
    public function getTags() {
	   	$tagList = $this->_mapper->getDbTable()
	   	                         ->find($this->id)
	   	                         ->current()
	   	                         ->findManyToManyRowset('Application_Model_DbTable_Tags', 'Application_Model_DbTable_TagsContents')
	   	                         ->toArray();
		$tags = array();
		foreach ($tagList as $tag) {
			array_push($tags, new Application_Model_Tag($tag));
		}
		return $tags;
    }
    
    public function setTags($tags = array()) {
    	$this->_mapper->setContentTags($this->id, $tags);
    }
    
    public function getComments() {
    	return $this->_mapper->getContentComments($this->id);
    }
    
    public function getCommentsNumber() {
    	return $this->_mapper->getContentCommentsNumber($this->id, true);
    }
    
    public function getUser() {
    	$mapper = Zend_Registry::get('userMapper');
    	$user = $mapper->find($this->userId);
    	return $user;
    }
    
    public function getPreview($chars, $trailing = '') {
    	if (strlen($this->body) > $chars) {
    		$text = strip_tags($this->body);
    		$text = substr($text, 0, $chars);
    		$text = substr($text, 0, strrpos($text," "));
    		$text = str_replace('<p>', '', $text);
    		$text = str_replace('</p>', '', $text);
    		$text = '<p>' . $text . ' ' . $trailing . '</p>';
    	}
    	return $text;
    }
    
    public function urlify() {
    	$result = $this->pageTitle;
    	$result = strtolower($result);
    	$result = preg_replace('/[^\w\d_ ]/si', '', $result);
    	$result = preg_replace('/\s+/', '-', $result);
    	return $result;
    }
    
    public function toArray() {
    	$result = array(
    			'id' 		=> $this->id,
    			'pageTitle' => $this->pageTitle,
    			'userId' 	=> $this->userId,
    			'published' => $this->published,
    			'type' 		=> $this->type,
    			'body' 		=> $this->body,
    			'picture1' 	=> $this->picture1,
    			'picture2' 	=> $this->picture2,
    			'picture3' 	=> $this->picture3,
    			'createdOn' => $this->createdOn,
    			'updatedOn' => $this->updatedOn
    	);
    	return $result;
    }
}

