<?php
class Application_Form_Review extends Zend_Form 
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
		
        $authorId = new Zend_Form_Element_Select('authorId');
        $authorId->setLabel('Autore:')
                 ->setRequired(true);
        $authorList = Zend_Registry::get('authorMapper')->fetchAll(array(), $order = 'lastName', null, true, 1000);
        foreach ($authorList as $author) {
        	$authorId->addMultiOption($author->id, $author->getFullName(true));
        }
        $this->addElement($authorId);
		
        $italianTitle = $this->createElement('text', 'italianTitle');
        $italianTitle->setLabel('Titolo italiano:');
		$italianTitle->setRequired(false);
		$italianTitle->setAttrib('size', 40);
		$italianTitle->addFilter('StringTrim');
		$italianTitle->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($italianTitle);
        
        $italianSubtitle = $this->createElement('text', 'italianSubtitle');
        $italianSubtitle->setLabel('Sottotitolo italiano:');
		$italianSubtitle->setRequired(false);
		$italianSubtitle->setAttrib('size', 40);
		$italianSubtitle->addFilter('StringTrim');
		$italianSubtitle->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($italianSubtitle);
        
        $originalTitle = $this->createElement('text', 'originalTitle');
        $originalTitle->setLabel('Titolo originale:');
		$originalTitle->setRequired(true);
		$originalTitle->setAttrib('size', 40);
		$originalTitle->addFilter('StringTrim');
		$originalTitle->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($originalTitle);
        
        $originalSubtitle = $this->createElement('text', 'originalSubtitle');
        $originalSubtitle->setLabel('Sottotitolo orig:');
		$originalSubtitle->setRequired(false);
		$originalSubtitle->setAttrib('size', 40);
		$originalSubtitle->addFilter('StringTrim');
		$originalSubtitle->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($originalSubtitle);
	
		$vote = $this->createElement('select','vote');
		$vote->setLabel('Voto:');
		$vote->setRequired(TRUE);
		$vote->addMultiOptions(array(
				'0' => '0 - Schifezza disumana',
				'1' => '1 - Teribbbile',
				'2' => '2 - Da dimenticare',
				'3' => '3 - Pessimo',
				'4' => '4 - Scarso',
				'5' => '5 - Mediocre',
				'6' => '6 - Discreto',
				'7' => '7 - Buono',
				'8' => '8 - Ottimo',
				'9' => '9 - Imperdibile',
				'10' => '10 - Capolavoro!')
		);
		$vote->addValidator('Digits');
		$this->addElement($vote);
        
		$body = $this->createElement('textarea', 'body');
		$body->setLabel('Corpo:');
		$body->setRequired(TRUE);
		$body->setAttrib('cols',40);
		$body->setAttrib('rows',10);
		$body->addFilter('StringTrim');
		$this->addElement($body);
		
		$cover = $this->createElement('text', 'cover');
		$cover->setLabel('Copertina/Locandina:');
		$cover->setDescription('<a href="javascript:mcImageManager.browse({fields : \'cover\', relative_urls : true });">[MCImageManager]</a>');
		$cover->getDecorator('Description')->setOption('escape', false);
		$cover->setRequired(false);
		$cover->setAttrib('size', 40);
		$cover->addFilter('StringTrim');
		$cover->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($cover);
		
		$year = $this->createElement('text', 'year');
		$year->setLabel('Anno:');
		$year->setRequired(false);
		$year->setAttrib('size', 4);
		$year->addFilter('StringTrim');
		$year->addValidator('Digits');
		$year->addValidator('StringLength', FALSE, array(4, 4));
		$this->addElement($year);
		
		$language = $this->createElement('select','language');
		$language->setLabel('Lingua:');
		$language->setRequired(true);
		$language->addMultiOptions(array(
				'ENG' => 'Inglese',
				'ITA' => 'Italiano')
		);
		$language->addFilter('StringTrim');
		$language->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($language);

		$tags = new Application_Form_Element_TagsMultiCheckbox('tags');
		$tags->setLabel('Tags:');
		$this->addElement($tags);

		$published = new Zend_Form_Element_Checkbox('published');
		$published->setLabel('Published: ')
			->addValidator('NotEmpty')
			->setValue(true);
		$this->addElement($published);

		$pubDate = $this->createElement('text', 'pubDate');
		$pubDate->setLabel('Publication date (yyyy-mm-dd):');
		$pubDate->setRequired(TRUE);
		$pubDate->setAttrib('size', 10);
		$pubDate->addFilter('StringTrim');
		$date = Zend_Date::now();
		$pubDate->setValue($date->get('yyyy-MM-dd') );
		$pubDate->addValidator('Date', FALSE, array('format' => 'yyyy-MM-dd'));
		$pubDate->class = "datePicker";
		$this->addElement($pubDate);
	}
}