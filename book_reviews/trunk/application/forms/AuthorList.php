<?php

class Application_Form_AuthorList extends Zend_Form
{
    public function init()
    {
        $options = array(
                        '0'           => '-',
                        'firstName'  => 'Nome',
        				'lastName'  => 'Cognome'
                   );

        $sort = $this->createElement('select', 'sort');
        $sort->setLabel('Order by:');
        $sort->addMultiOptions($options);
        $this->addElement($sort);

        $filterField = $this->createElement('select', 'filter_field');
        $filterField->setLabel('Filter by:');
        $filterField->addMultiOptions($options);
        $this->addElement($filterField);

        $filter = $this->createElement('text', 'filter');
        $filter->setLabel('Value:');
        $filter->setAttrib('size',40);
        $filter->addValidator(new Zend_Validate_Alnum(array('allowWhiteSpace' => true)));
        $this->addElement($filter);

        $this->addElement('submit', 'submit', array('label' => 'Filter list'));
    }
}

?>