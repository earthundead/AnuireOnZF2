<?php

namespace Anuire\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class MainForm extends Form
{
	public $textIntro;
	public $textAfter;
	public $options;
	
	public $select1Start;
	public $select2Start;
	
    public function init()
		{
        // Set the method for the display form to POST
        $this->setAttribute('method', 'POST');
        
		//Создание элементов формы
		$element = new Element('intro');
		$element->setLabel("intro");
		$element->setAttributes(array('size'  => '0',));
		$this->add($element);
		
		$element = new Element\Select('select1');
		$element->setLabel('Начальный пункт:');
		//$element->setDescription('Это город или порт отправления');
		$this->add($element);
		
		$element = new Element\Select('select2');
		$element->setLabel('Конечный пункт:');
		//$element->setDescription('Это город или порт назначения');
		$this->add($element);
		
		$element  = new Element('after');
		$element->setLabel("textAfter");
		$this    -> add($element);
   
        // Add the submit button
        $element  = new Element\Submit('submit');
        $element  ->setValue('Получить маршрут');
		$this     -> add($element);
 
        /*// And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));*/
        
		$this->refresh();
    }
    
    public function refresh()
	{
	//Заполнение полей дефолтное
	if(!isset($this->textIntro))
		$this->textIntro=
			"Приветствуем благородного дона, путешествующего по нашей стране. 
			Ануир это лучшая страна в мире. Все остальные страны нам завидуют. 
			Никакие проблемы и неприятности никак не могут изменить это.
			Этот путеводитель предоставит краткую информацию о Ануире и поможет вам спланировать ваше путешествие.
			";
	if(!isset($this->textAfter))
		$this->textAfter=
			'Уважаемый дон, извольте выбрать пункт отправления и пункт назначения из списка в полях вверху , 
			нажать кнопку "Получить маршрут" и маршрут вашего путешествия по нашей великой стране отобразится на карте. 
			';
	if(!isset($this->options))
		$this->options=array
			(
			"none","Option1","Option1","Option1","Option1","Option1","Option1","Option1",
			"Option1","Option1","Option1","Option1","Option1","Option1","Option1","Option1",
			"Option2","Option1","Option1","Option1","Option1","Option1","Option1","Option1",
			"Option3","Option1","Option1","Option1","Option1","Option1","Option1","Option1",
			"Option4","Option1","Option1","Option1","Option1","Option1","Option1","Option1",
			);
			
	//обновление		
	$element = $this->get("intro");
	$element->setLabel($this->textIntro);
	
	$element = $this->get("select1");
	//$element->clearMultiOptions();
	$element->setValueOptions($this->options);
	
	$element = $this->get("select2");
	//$element->clearMultiOptions();
	$element->setValueOptions($this->options);
	
	$element = $this->get("after");
	$element->setLabel($this->textAfter);
	}
}
