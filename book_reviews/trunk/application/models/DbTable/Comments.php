<?php

class Application_Model_DbTable_Comments extends Zend_Db_Table_Abstract {
    protected $_name = 'comments';
    protected $_primary = 'id';
    protected $_referenceMap    = array(
    		'Content' => array(
    				'columns'           => 'ContentId',
    				'refTableClass'     => 'Application_Model_DbTable_Contents',
    				'refColumns'        => 'id'
    		)
    );
}

