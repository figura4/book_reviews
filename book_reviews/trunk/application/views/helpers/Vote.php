<?php

class Zend_View_Helper_Vote extends Zend_View_Helper_Abstract
{
	public function vote($review)
	{
		$vote = (int)$review->vote / 2;
		return $vote;
	}
}