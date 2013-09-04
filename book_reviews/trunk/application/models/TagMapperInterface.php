<?php

Interface Application_Model_TagMapperInterface extends Common_ModelMapperInterface {
	public function getTagContents(Application_Model_TagInterface $tag);
	public function tagExsists($tagName);
}