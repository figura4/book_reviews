<?php

class Application_Form_MovieReview extends Application_Form_Review
{
	public function init()
	{
		parent::init();
		
		$actors = $this->createElement('text', 'actors');
		$actors->setLabel('Attori:');
		$actors->setRequired(false);
        $actors->setAttrib('size', 40);
        $actors->addFilter('StringTrim');
        $this->addElement($actors);
        
		$nation = $this->createElement('text', 'nation');
		$nation->setLabel('Nazione:');
		$nation->setRequired(false);
        $nation->setAttrib('size', 40);
        $nation->addFilter('StringTrim');
        $nation->addValidator('StringLength', FALSE, array(3, 80));
        $this->addElement($nation);
		
		// Add the submit button
        $this->addElement('submit', 'submit', array(
        		'ignore'   => true,
        		'label'    => 'Submit',
        ));
	}
}
