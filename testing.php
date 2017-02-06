<?php
//блок тестирования и анализа
echo ( "Активирован режим тестирования.");
echo( "На этом этапе инициализация приложения закончена. Далее запуск. ");
$response = $application ->getResponse();
$response = $response ->toString();
echo(  " Response - $response . ");
$data = $application ->getRequest();
echo(  " Request - $data . ");
if ($data instanceof Zend\Stdlib\RequestInterfase)
	{
	$data = get_class($data);
	echo(  "Есть class : $data . ");
	//var_dump($data);
	$data = $data ->getUri();
	echo(  " Uri - $data . ");
	}
echo(  "--------------------------------------------------------------- <br><br>");
$data = Zend\Loader\AutoloaderFactory::getRegisteredAutoloaders();
var_dump($data);
echo(  "---------------------------------------------------------------<br><br>");
$data = $application ->getServiceManager();	
if ($data instanceof Zend\ServiceManager\ServiceManager)
	{
	$names = get_class($data);
	echo("has ServiceManager:  $names . ");
	$names = $data->getCanonicalNames();
	$names = $data->getRegisteredServices();
	var_dump($names);
	
	$tpStack = $data->has("viewtemplatepathstack");
	echo("ServiceManager has viewtemplatepathstack:  $tpStack . ");
	$tpStack = $data->get("viewtemplatepathstack");
	$tpStack = $tpStack->getPaths();
	$tpStack = $tpStack->toArray();
	$tpStack = $tpStack[0];
	echo("ServiceManager templatepathstack path:  $tpStack . ");
	
	$config = $data->has("myconfig");
	echo(" ServiceManager has config:  $config . ");
	$config = $data->get("myconfig");
	$string = get_class($config);
	echo(" config class:  $string . ");
	var_dump($config);
	
	$logManager = $data->has("logger");
	echo("ServiceManager has log :  $logManager . ");
	$logManager = $data->get("logger");
	$string = get_class($logManager);
	echo("log class:  $string . ");
	
	$request = $data->get("Request");
	//$request->setUri('/foo');
	$request = $request->toString();
	echo("ServiceManager Request:  $request . ");
	
	$view = $data->has("viewmanager");
	echo("ServiceManager has viewmanager:  $view . ");
	$view = $data->get("viewmanager");
	//$view = $view->getViewModel();
	$view = $view->getRenderer();
	//$view = $view->getResolver();
	//var_dump($view);
	$view = get_class($view);
	echo("viewmanager имеет рендер:  $view . ");
	
	$data = $data->get("ControllerManager");
	if ($data instanceof Zend\Mvc\Controller\ControllerManager)
		{
		$Has = $data->has("Anuire\Controller\Index");
		echo("Есть ли контроллер Anuire : $Has . ");
		$data = $data->get("Anuire\Controller\Index");
		if ($data instanceof Zend\Mvc\Controller\AbstractActionController)
			{
			echo("Есть модуль AbstractActionController : 1 . ");
			$controller = $data;
			$data = $data->getRequest();
			if ($data instanceof Zend\Http\Request)
				{
				$request = $data;
				echo("Есть Request : $request . ");
				$data ->getUriString();
				echo("Есть Uri : $data . ");
				}
			$controller ->indexAction();
			}
		}
	}
	
?>
