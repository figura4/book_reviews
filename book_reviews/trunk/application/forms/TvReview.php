<?php

class Application_Form_TvReview extends Application_Form_Review
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
        
        $seasons = $this->createElement('text', 'seasons');
        $seasons->setLabel('Stagioni:');
        $seasons->setRequired(false);
        $seasons->setAttrib('size', 40);
        $seasons->addFilter('StringTrim');
        $this->addElement($seasons);
		
		// Add the submit button
        $this->addElement('submit', 'submit', array(
        		'ignore'   => true,
        		'label'    => 'Submit',
        ));
	}
}
