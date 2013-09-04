<?php

class Application_Form_Comment extends Zend_Form 
{ 
	public function init()
	{
        // Set the method for the form to POST
        $this->setMethod('post');
        $this->setAttrib('enctype', 'multipart/form-data');
        
        $id = $this->createElement('hidden', 'id');
        $id->setRequired(FALSE);
        $id->addFilter('Digits');
        $id->addValidator('Digits');
        $this->addElement($id);
		
		$author = $this->createElement('text', 'author'); 
		$author->setLabel('Il tuo nome:'); 
		$author->setRequired(TRUE)
			   ->addValidator('NotEmpty', true)
			   ->addErrorMessage('campo obbligatorio');
        $author->setAttrib('size', 40);
        $author->addFilter('StringTrim');
        $author->addValidator('StringLength', FALSE, array(3, 80));
		$this->addElement($author);
		
		$email = $this->createElement('text', 'email'); 
		$email->setLabel('La tua email:'); 
		$email->setRequired(true);
		$email->setAttrib('size', 40); 
		$email->addFilter('StringTrim');
		$email->addValidator('EmailAddress');
		$email->getValidator('EmailAddress')->setMessage('Email non valida');
		$this->addElement($email); 
		
		$body = $this->createElement('textarea', 'body');
		$body->setLabel('Il tuo commento:');
		$body->setRequired(TRUE)
			 ->addValidator('NotEmpty', true)
			 ->addErrorMessage('campo obbligatorio');
		$body->setAttrib('cols',40);
		$body->setAttrib('rows',10);
		$body->addFilter('StringTrim');
		$this->addElement($body);
		
		// configure the captcha service 
		//$privateKey = '6LemJsISAAAAAO91Q3wnhVeNSwRIYEaHlbhDb24l'; 
		//$publicKey = '6LemJsISAAAAALzVF4z0AlcHrLsU7pc_DdJGcT0w'; 
		//$recaptcha = new Zend_Service_ReCaptcha($publicKey, $privateKey); 
 
		// create the captcha control 
		//$captcha = new Zend_Form_Element_Captcha('captcha', 
    	//	array(
    	//			'captcha'        => 'ReCaptcha', 
        //	  	  	'captchaOptions' => array(
        //	  	  							'captcha' => 'ReCaptcha', 
        //	  	  		                    'service' => $recaptcha
        //	  	  						)
    	//	)
		//); 
		
 		//$captcha->removeDecorator( 'Label' );
 		
		// add captcha to the form 
		//$this->addElement($captcha);
		
		// Add the submit button
		$this->addElement('submit', 'submit', array(
				'ignore'   => true,
				'label'    => 'Invia',
		));
	} 
}
