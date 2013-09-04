<?php

class Zend_View_Helper_FormatDate extends Zend_View_Helper_Abstract {
    public function formatDate ($date, $letters = true) {
		$date = new Zend_Date($date, Zend_Date::ISO_8601, 'it_IT');
    	if ($letters) 
			return $date->toString('d MMM, YYYY');
    	else
    		return $date->toString('YYYY-M-d');
    }
}