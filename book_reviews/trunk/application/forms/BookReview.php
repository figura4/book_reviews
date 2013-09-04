<?php

class Application_Form_BookReview extends Application_Form_Review
{
	public function init()
	{
		parent::init();
		
		$pages = $this->createElement('text', 'pages');
		$pages->setLabel('Pagine:');
		$pages->setRequired(false);
        $pages->setAttrib('size', 40);
        $pages->addFilter('StringTrim');
        $pages->addValidator('StringLength', FALSE, array(1, 80));
        $this->addElement($pages);
        
		$editor = $this->createElement('text', 'editor');
		$editor->setLabel('Editore:');
		$editor->setRequired(false);
        $editor->setAttrib('size', 40);
        $editor->addFilter('StringTrim');
        $editor->addValidator('StringLength', FALSE, array(3, 80));
        $this->addElement($editor);
		
		// Add the submit button
        $this->addElement('submit', 'submit', array(
        		'ignore'   => true,
        		'label'    => 'Submit',
        ));
	}
}
