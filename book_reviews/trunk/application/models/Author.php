<?php

class Application_Model_Author extends Common_ModelAbstract implements Application_Model_AuthorInterface {
	protected $_id;
    protected $_firstName;
    protected $_lastName;
    protected $_bio;
    protected $_bioUrl;
    protected $_picture;
    protected $_createdOn;
    protected $_updatedOn;
    
   	public function __construct(array $options = null) {
   		$this->_mapperType = "authorMapper";	
   		parent::__construct($options);
   	}
   	
   	public function getFullName($LastNamefirst = false) {
   		if($LastNamefirst)
   			return "$this->lastName, $this->firstName";
   		else
   			return "$this->firstName $this->lastName";
   	}
    
    public function getReviews($limit = null) {
    	return $this->_mapper->getAuthorReviews($this, true, $limit);
    }
    
    public function getReviewsNumber() {
    	return count($this->_mapper->getAuthorReviews($this, true, null));
    }
    
    public function getBioPreview($chars, $trailing = '') {
    	if (strlen($this->bio) > $chars) {
    		$text = $this->bio;
    		$text = substr($text, 0, $chars);
    		$text = substr($text, 0, strrpos($text," "));
    		$text = str_replace('<p>', '', $text);
    		$text = str_replace('</p>', '', $text);
    		$text = '<p>' . $text . ' ' . $trailing . '</p>';
    		return $text;
    	} else {
    		return $this->bio;
    	}
    	
    }
    
    public function urlify() {
    	$result = $this->getFullName();
    	$result = strtolower($result);
    	$result = preg_replace('/[^\w\d_ -]/si', '', $result);
    	$result = preg_replace('/\s+/', '-', $result);
    	return $result;
    }
    
    public function toArray() {
    	$result = array(
    				'id' => $this->id,
    				'firstName' => $this->firstName,
    				'lastName' => $this->lastName,
    				'bio' => $this->bio,
    				'bioUrl' => $this->bioUrl,
    				'picture' => $this->picture,
    				'createdOn' => $this->createdOn,
    				'updatedOn' => $this->updatedOn
    			);
    	return $result;
    }
}
