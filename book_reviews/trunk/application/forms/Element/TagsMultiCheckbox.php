<?php

class Application_Form_Element_TagsMultiCheckbox extends Zend_Form_Element_MultiCheckbox
{
	public function __construct($name = 'tags', $contentId = null) {
		parent::__construct($name);
		$this->addOptionsFromDatabase();
		if (!is_null($contentId))
			$this->setSelectedOptions($contentId);
	}

	public function addOptionsFromDatabase() {
		$tags = Zend_Registry::get('tagMapper')->fetchAll(array(), 'name');
		
		foreach($tags as $tag) {
			$this->addMultiOption($tag->id, $tag->name);
		}
	}
	
	public function setSelectedOptions($contentId) {
		$mapper = Zend_Registry::get('contentMapper');
		$tags = $mapper->getContentTags($contentId);
		$setTags = array();
		
		foreach($tags as $tag) {
			$setTags[] = $tag->id;
		}
		$this->setValue($setTags);
	}
}