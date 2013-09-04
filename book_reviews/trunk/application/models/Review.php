<?php

class Application_Model_Review extends Application_Model_Content implements Application_Model_ReviewInterface {
	protected $_authorId;
	protected $_cover;
	protected $_italianTitle;
	protected $_italianSubtitle;
	protected $_originalTitle;
	protected $_originalSubtitle;
	protected $_year;
	protected $_vote;
	protected $_language;
	protected $_actors;
	protected $_nation;
	protected $_pages;
	protected $_editor;
	protected $_seasons;
 
    public function __construct(array $options = null) {
    	parent::__construct($options);
    }
    
    public function getAuthor() {
    	$mapper = Zend_Registry::get('authorMapper');
    	$author = $mapper->find($this->authorId);
    	return $author;
    }
    
    public function getQuotes() {
    	return $this->_mapper->getReviewQuotes($this->id);
    }
    
    public function getTitle($showSubtitle = false) {
    	if ($this->italianTitle != '') {
    		if ($this->italianSubtitle != '' && $showSubtitle) {
    			$title = $this->italianTitle . ' - ' . $this->italianSubtitle;
    		} else { 
    			$title = $this->italianTitle;
    		}
    	} else {
    		if ($this->originalSubtitle != '' && $showSubtitle) { 
    			$title = $this->originalTitle . ' - ' . $this->originalSubtitle; 
    		} else {	
    			$title = $this->originalTitle;
    		}
    	}

    	return $title;
    }
    
    public function urlify() {
    	$result = $this->getTitle();
    	$result = strtolower($result);
    	$result = preg_replace('/[^\w\d_ ]/si', '', $result);
    	$result = preg_replace('/\s+/', '-', $result);
    	return $result;
    }
    
    public function toArray() {
    	$result = parent::toArray();
    	$result = array_merge($result, array(
    			'authorId' => $this->authorId,
    			'cover' => $this->cover,
    			'italianTitle' => $this->italianTitle,
    			'italianSubtitle' => $this->italianSubtitle,
    			'originalTitle' => $this->originalTitle,
    			'originalSubtitle' => $this->originalSubtitle,
    			'year' => $this->year,
    			'vote' => $this->vote,
    			'language' => $this->language,
    			'actors' => $this->actors, 				
    			'nation' => $this->nation,
    			'pages' => $this->pages,
    			'editor' => $this->editor,	
    			'seasons' => $this->seasons,
    	));
    	return $result;
    }
}

