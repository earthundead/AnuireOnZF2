<?php

namespace Anuire\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Anuire\Model\ModelInterface as ModelInterface;
use Anuire\Model\DBInterface;
use Anuire\Form\MainForm;

class IndexController extends AbstractActionController {

	public function indexAction() 
		{
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller indexAction called. ");
		$config = $this->getServiceLocator()->get('myconfig');
		
		$db  = new DBInterface;
		$db -> Initialise($config);
		$model = new ModelInterface;
		$model->db = $db;
				
		$view = new ViewModel(array('message' => 'Hello world',));
		$view->setTemplate('anuire/index/index');		
		$view->setTerminal(true);
		return $view;
		}
    
    public function viewimageAction() 
		{
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller viewimageAction called. ");
		
		$config = $this->getServiceLocator()->get('myconfig');
		$path = $config["path"]["data"];
		$logger -> info("data path: $path");
		
		$view = new ViewModel();
		$view->setTemplate('anuire/index/viewimage');
		$view->path = $path;
		$view->logger = $logger;
		$view->setTerminal(true);
		return $view;
		}
		
    public function viewimage2Action() 
		{
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller viewimageAction called. ");
		
		$config = $this->getServiceLocator()->get('myconfig');
		$path = $config["path"]["data"];
		$logger -> info("data path: $path");
		
		$view = new ViewModel();
		$view->setTemplate('anuire/index/viewimage2');
		$view->path = $path;
		$view->logger = $logger;
		$view->setTerminal(true);
		return $view;
		}
        
	public function viewtestAction() 
		{
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller viewtestAction called. ");
		
		$view = new ViewModel();
		$view->setTemplate('anuire/index/viewtest');
		$view->setTerminal(true);
		return $view;
		}
    
    public function viewlogfileAction() 
		{
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller viewlogfileAction called. ");
		
		$config = $this->getServiceLocator()->get('myconfig');
		$path = $config["path"]["data"];
		$logger -> info("data path: $path");
		
		$view = new ViewModel();
		$view->setTemplate('anuire/index/viewlogfile');
		$view->path = $path;
		$view->setTerminal(true);
		return $view;
		}
    
    public function viewformAction() 
        {
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller viewformAction called. ");
		$config = $this->getServiceLocator()->get('myconfig');
		$path = $config["path"]["data"];
		$logger -> info("form data files path: $path");
		
		$db  = new DBInterface;
		$db -> Initialise($config);
		$model = new ModelInterface();
		$model->db = $db;
		$model->pathImage = $path;
		$model -> refresh();
			
        $form =  new MainForm();
        $form->init();
        $form->refresh();
        //$form -> setAction('viewform');
 
 		$startPointNo = null;
		$endPointNo   = null;
		$request = $this->getRequest();
        if ($request->isPost())
            {
            //if ($form->isValid()) 
                {
				$values = $request->getPost();
				$startPointNo  = $values['select1'];
				$endPointNo    = $values['select2'];
                }
			}
           
        //отправляем данные в модель и получаем данные из модели
		$model -> startPoint = $startPointNo;
		$model -> endPoint = $endPointNo;
		$model -> refresh();
		$modelText = $model->textPathComment;
		
		//Отправляем данные в форму
		if(isset($modelText))
			$form->textAfter = $modelText;
		$form->options = $model->locationsList;
		array_unshift($form->options,"none");
		$form->refresh();
                
        $view = new ViewModel();
		$view->setTemplate('anuire/index/viewform');
		$view->path = $path;
		$view->logger = $logger;
		$view->form = $form;
		$view->setTerminal(true);
		return $view;
        }
        
    public function viewtableAction() 
		{
			
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller viewtableAction called. ");
		$config = $this->getServiceLocator()->get('myconfig');
		
		$db  = new DBInterface;
		$db -> Initialise($config);

		
		$Table=$db->Get("AnuireLocations");
		$Header=array("No","X","Y","Название","Описание","Размер");
		$Name="Локации Ануира";
		$Headers[]=$Header;
		$Tables[]=$Table;
		$Names[]=$Name;

		$Table=$db->Get("RoadsView");
		$Header=array("No","Откуда","Куда");
		$Name="Дороги Ануира";
		$Headers[]=$Header;
		$Tables[]=$Table;
		$Names[]=$Name;

		/*$Table=$model->db->Get("Points");
		$Header=array("No","X","Y","Z");
		$Name="Точки на карте";
		$Headers[]=$Header;
		$Tables[]=$Table;
		$Names[]=$Name;*/		

		$view = new ViewModel();
		$view->setTemplate('anuire/index/viewtable');
		$view->logger = $logger;
		
		$view->Tables = $Tables;
		$view->Headers = $Headers;
		$view->Names = $Names;
		
		$view->setTerminal(true);
		return $view;
		}
    
    public function recreatedbAction() 
		{
		$logger = $this->getServiceLocator()->get('logger');	
		$logger -> info(" Anuire controller recreatedbAction called. ");
		$config = $this->getServiceLocator()->get('myconfig');
		
		$db  = new DBInterface;
		$db -> Initialise($config);	
		
		echo "Запуск пересоздания БД <br>";
		$db ->RecreateDB();
		echo " БД была пересоздана";
		}
}
