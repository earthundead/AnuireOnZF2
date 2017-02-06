<?php

class Application_Form_BlogForm extends Zend_Form
{
	public $textIntro;
	public $textMain;
	public $textAfter;
	public $options;
		
    public function init()
		{
        // Set the method for the display form to POST
        $this->setMethod('post');
        
		//Создание элементов формы
		$element = new Zend_Form_Element_Hidden('intro');
		$element->setRequired(true);
		$element->setValue("1");
		$this->addElement($element);
		
		$element = new Zend_Form_Element_Select('select1');
		$element->setRequired(true);
		$element->setLabel('Начальный пункт:');
		$element->setDescription('Это город или порт отправления');
		$this->addElement($element);
		
		$element  = new Zend_Form_Element_Textarea('main');
		$element -> setRequired(true);
		$this    -> addElement($element);
		
		$element = new Zend_Form_Element_Select('select2');
		$element->setRequired(true);
		$element->setLabel('Конечный пункт:');
		$element->setDescription('Это город или порт назначения');
		$this->addElement($element);
		
		$element  = new Zend_Form_Element_Hidden('after');
		$element -> setRequired(true);
		$element -> setValue("1");
		$this    -> addElement($element);
   
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Получить маршрут',
        ));
 
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
        
		$this->refresh();
    }
    
    public function refresh()
	{
	//Заполнение полей дефолтное
	if(!isset($this->textIntro))
		$this->textIntro='Перед всем';
			
	if(!isset($this->textMain))
		$this->textMain=
			'Основной массив текста.';
					
	if(!isset($this->textAfter))
		$this->textAfter='После всего';
		
	if(!isset($this->options))
		for ($i = 0; $i < 32; $i++)
			$this->options[]="Option $i";
			
	//обновление		
	$element = $this->getElement("intro");
	$element->setLabel($this->textIntro);
	
	$element = $this->getElement("select1");
	$element->clearMultiOptions();
	$element->addMultiOptions($this->options);
	
	$element = $this->getElement("main");
	$element->setValue($this->textMain);
	
	$element = $this->getElement("select2");
	$element->clearMultiOptions();
	$element->addMultiOptions($this->options);
	
	$element = $this->getElement("after");
	$element->setLabel($this->textAfter);
	}
}
