<?php

class Application_Form_Quote extends Zend_Form 
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
		
		$body = $this->createElement('textarea', 'body'); 
		$body->setLabel('Quote:'); 
        $body->setRequired(TRUE);
        $body->setAttrib('cols',40);
        $body->setAttrib('rows',10);
        $body->addFilter('StringTrim');
        $this->addElement($body);
		
		$source = $this->createElement('text', 'source'); 
		$source->setLabel('Fonte:'); 
		$source->setLabel('Fonte:'); 
		$source->setRequired(FALSE);
        $source->setAttrib('size', 40);
        $source->addFilter('StringTrim');
        $source->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($source); 
		
		$random = $this->createElement('checkbox', 'random');
		$random->setLabel('Includi nelle random quotes:'); 
		$this->addElement($random);
		
		// Add the submit button
		$this->addElement('submit', 'submit', array(
				'ignore'   => true,
				'label'    => 'Submit',
		));
	} 
}