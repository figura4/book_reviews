<?php

class Application_Form_Author extends Zend_Form
{
	public function init()
	{
        // Set the method for the form to POST
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $id = $this->createElement('hidden', 'id');
        $id->setRequired(FALSE);
        $id->setAttrib('size', 4);
        $id->addFilter('Digits');
        $id->addValidator('Digits');
        $this->addElement($id);
		
		$first_name = $this->createElement('text', 'firstName'); 
		$first_name->setLabel('Nome:'); 
		$first_name->setRequired(TRUE);
        $first_name->setAttrib('size', 40);
        $first_name->addFilter('StringTrim');
        $first_name->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($first_name); 
		
		$last_name = $this->createElement('text', 'lastName'); 
		$last_name->setLabel('Cognome:'); 
		$last_name->setRequired(TRUE);
        $last_name->setAttrib('size', 40);
        $last_name->addFilter('StringTrim');
        $last_name->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($last_name); 
		
		$bio = $this->createElement('textarea', 'bio'); 
		$bio->setLabel('Biografia:'); 
        $bio->setRequired(TRUE);
        $bio->setAttrib('cols',60);
        $bio->setAttrib('rows',10);
        $bio->addFilter('StringTrim');
        $this->addElement($bio);
		
		$bioUrl = $this->createElement('text', 'bioUrl'); 
		$bioUrl->setLabel('Fonte:'); 
		$bioUrl->setRequired(FALSE);
        $bioUrl->setAttrib('size', 40);
        $bioUrl->addFilter('StringTrim');
        $bioUrl->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($bioUrl); 
		
		$picture = $this->createElement('text', 'picture');
		$picture->setLabel('Foto:');
		$picture->setDescription('<a href="javascript:mcImageManager.browse({fields : \'picture\', relative_urls : true });">[MCImageManager]</a>');
		$picture->getDecorator('Description')->setOption('escape', false);
		$picture->setRequired(false);
		$picture->setAttrib('size', 40);
		$picture->addFilter('StringTrim');
		$picture->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($picture);
		
		// Add the submit button
        $this->addElement('submit', 'submit', array(
        		'ignore'   => true,
        		'label'    => 'Submit',
        ));
	}
}
