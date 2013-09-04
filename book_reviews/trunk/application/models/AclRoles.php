<?php

class Application_Model_AclRoles extends Zend_Acl
{
	public function __construct()
	{
		// add the roles
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('user'), 'guest');
		$this->addRole(new Zend_Acl_Role('admin'), 'user');

		// add the resources
		$this->addResource(new Zend_Acl_Resource('index'));
		$this->addResource(new Zend_Acl_Resource('error'));
		$this->addResource(new Zend_Acl_Resource('author'));
		$this->addResource(new Zend_Acl_Resource('content'));
		$this->addResource(new Zend_Acl_Resource('comment'));
		$this->addResource(new Zend_Acl_Resource('quote'));
		$this->addResource(new Zend_Acl_Resource('tag'));
		$this->addResource(new Zend_Acl_Resource('user'));
		$this->addResource(new Zend_Acl_Resource('recensioni'));
		$this->addResource(new Zend_Acl_Resource('blog'));
		$this->addResource(new Zend_Acl_Resource('social'));
		$this->addResource(new Zend_Acl_Resource('favicon.ico'));

		// set up the access rules
		$this->allow(null, array('index', 'error'));

		// a guest can only read content and login
		$this->allow('guest', 'user', array('login'));
		$this->allow('guest', 'content', array('show-content', 'show-review', 'list-reviews', 'list-contents'));
		$this->allow('guest', 'author', array('show', 'list'));
		$this->allow('guest', 'comment', array('show', 'list', 'create'));
		$this->allow('guest', 'quote', array('show', 'list'));
		$this->allow('guest', 'tag', array('show', 'list'));

		// cms users can also work with content
		$this->allow('user', 'author', array('create', 'edit', 'delete', 'admin'));
		$this->allow('user', 'content', array('create', 'edit', 'delete', 'admin'));
		$this->allow('user', 'comment', array('create', 'edit', 'delete', 'admin'));
		$this->allow('user', 'quote', array('create', 'edit', 'delete', 'admin'));
		$this->allow('user', 'tag', array('create', 'edit', 'delete', 'list', 'admin'));

		// administrators can do anything
		$this->allow('admin', null);
	}
}