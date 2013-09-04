<?php

class Application_Model_DbTable_TagsContents extends Zend_Db_Table_Abstract {
    protected $_name = 'tagsContents';
    protected $_referenceMap    = array(
        'Content' => array(
            'columns'           => array('contentId'),
            'refTableClass'     => 'Application_Model_DbTable_Contents',
            'refColumns'        => array('id')
        ),
        'Tag' => array(
            'columns'           => array('tagId'),
            'refTableClass'     => 'Application_Model_DbTable_Tags',
            'refColumns'        => array('id')
        )
    );
}