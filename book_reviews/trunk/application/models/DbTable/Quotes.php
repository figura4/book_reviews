<?php

class Application_Model_DbTable_Quotes extends Zend_Db_Table_Abstract {
    protected $_name = 'quotes';
    protected $_primary = 'id';
    protected $_referenceMap    = array(
    		'Content' => array(
    				'columns'           => 'ContentId',
    				'refTableClass'     => 'Application_Model_DbTable_Contents',
    				'refColumns'        => 'id'
    		)
    );
}

