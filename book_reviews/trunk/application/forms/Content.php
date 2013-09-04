<?php
class Application_Form_Content extends Zend_Form 
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
		
		$pageTitle = $this->createElement('text', 'pageTitle'); 
		$pageTitle->setLabel('Titolo:'); 
        $pageTitle->setRequired(TRUE);
        $pageTitle->setAttrib('size', 40);
        $pageTitle->addFilter('StringTrim');
        $pageTitle->addValidator('StringLength', FALSE, array(3, 80));
        $this->addElement($pageTitle);
		
		$body = $this->createElement('textarea', 'body'); 
		$body->setLabel('Corpo:'); 
        $body->setRequired(TRUE);
        $body->setAttrib('cols',40);
        $body->setAttrib('rows',10);
        $body->addFilter('StringTrim');
        $this->addElement($body);
				
        $tags = new Application_Form_Element_TagsMultiCheckbox('tags');
        $tags->setLabel('Tags:');
        $this->addElement($tags);
		
        $published = new Zend_Form_Element_Checkbox('published');
        $published->setLabel('Pubblicato: ')
        		  ->addValidator('NotEmpty')
        		  ->setValue(true);
        $this->addElement($published);
        
        $pubDate = $this->createElement('text', 'pubDate');
        $pubDate->setLabel('Data Pubblicazione (yyyy-mm-dd):');
        $pubDate->setRequired(TRUE);
        $pubDate->setAttrib('size', 10);
        $pubDate->addFilter('StringTrim');
        $date = Zend_Date::now();
        $pubDate->setValue($date->get('yyyy-MM-dd') );
        $pubDate->addValidator('Date', FALSE, array('format' => 'yyyy-MM-dd'));
        $pubDate->class = "datePicker";
        $this->addElement($pubDate);
		
		$picture1 = $this->createElement('text', 'picture1');
		$picture1->setLabel('Immagine 1:');
		$picture1->setDescription('<a href="javascript:mcImageManager.browse({fields : \'picture1\', relative_urls : true });">[MCImageManager]</a>');
		$picture1->getDecorator('Description')->setOption('escape', false);
		$picture1->setRequired(false);
		$picture1->setAttrib('size', 40);
		$picture1->addFilter('StringTrim');
		$picture1->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($picture1);

		$picture2 = $this->createElement('text', 'picture2');
		$picture2->setLabel('Immagine 2:');
		$picture2->setDescription('<a href="javascript:mcImageManager.browse({fields : \'picture2\', relative_urls : true });">[MCImageManager]</a>');
		$picture2->getDecorator('Description')->setOption('escape', false);
		$picture2->setRequired(false);
		$picture2->setAttrib('size', 40);
		$picture2->addFilter('StringTrim');
		$picture2->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($picture2);
		
		$picture3 = $this->createElement('text', 'picture3');
		$picture3->setLabel('Immagine 3:');
		$picture3->setDescription('<a href="javascript:mcImageManager.browse({fields : \'picture3\', relative_urls : true });">[MCImageManager]</a>');
		$picture3->getDecorator('Description')->setOption('escape', false);
		$picture3->setRequired(false);
		$picture3->setAttrib('size', 40);
		$picture3->addFilter('StringTrim');
		$picture3->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($picture3);
		
		// Add the submit button
		$this->addElement('submit', 'submit', array(
				'ignore'   => true,
				'label'    => 'Submit',
		));
	} 
} 