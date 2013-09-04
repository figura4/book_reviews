<?php

class Zend_View_Helper_GetFirstSentence extends Zend_View_Helper_Abstract
{
	public function getFirstSentence($text)
	{
    	$dot = ".";

    	$position = stripos ($text, $dot); //find first dot position

    	if($position) { //if there's a dot in our soruce text do
       		$offset = $position + 1; //prepare offset
        	$position2 = stripos ($text, $dot, $offset); //find second dot using offset
        	$first_two = substr($text, 0, $position2); //put two first sentences under $first_two
        	return strip_tags ($first_two . '.'); //add a dot
    	} else {  //if there are no dots
        	return '';
    	}
	}
}