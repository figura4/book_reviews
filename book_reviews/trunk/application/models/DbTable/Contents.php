<?php

class Application_Model_DbTable_Contents extends Zend_Db_Table_Abstract {
    protected $_name = 'contents';
    protected $_primary = 'id';
    protected $_referenceMap    = array(
    		'Author' => array(
    				'columns'           => 'authorId',
    				'refTableClass'     => 'Application_Model_DbTable_Authors',
    				'refColumns'        => 'id'
    		),
    		'User' => array(
    				'columns'           => 'userId',
    				'refTableClass'     => 'Application_Model_DbTable_Users',
    				'refColumns'        => 'id'
    		)
    );
}

