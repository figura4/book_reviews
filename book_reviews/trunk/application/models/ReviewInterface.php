<?php

Interface Application_Model_ReviewInterface extends Application_Model_ContentInterface {
	public function getAuthor();
	public function getQuotes();
	public function getTitle();
	public function urlify();
}