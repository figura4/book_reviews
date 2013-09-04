<?php

class Application_Form_TagList extends Zend_Form
{
    public function init()
    {
        $options = array(
                        '0'           => '-',
                        'name'  => 'Tag name',
                   );

        $sort = $this->createElement('select', 'sort');
        $sort->setLabel('Ordina per:');
        $sort->addMultiOptions($options);
        $this->addElement($sort);

        $filterField = $this->createElement('select', 'filter_field');
        $filterField->setLabel('Filtra per:');
        $filterField->addMultiOptions($options);
        $this->addElement($filterField);

        $filter = $this->createElement('text', 'filter');
        $filter->setLabel('Valore:');
        $filter->setAttrib('size',40);
        $filter->addValidator(new Zend_Validate_Alnum(array('allowWhiteSpace' => true)));
        $this->addElement($filter);

        $this->addElement('submit', 'submit', array('label' => 'Filter list'));
    }
}

?>