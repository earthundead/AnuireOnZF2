<?php
use Zend\Mvc\Application as Application;

//Подключение ZF2. 
$new_include_path = realpath(__DIR__ . '/../library');
set_include_path($new_include_path);
//организация автозагрузки классов и ZF2
require_once 'Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf' => true));
$loader->registerNamespace('Anuire', __DIR__ . '/../modules/Anuire/src');
$loader->registerNamespace('Blog', __DIR__ . '/../modules/Blog/src');
$loader->register();

//Создание логфайла и организация логгинга
$dataFilesPath = realpath(__DIR__ . '/../data/logfile.log');
$stream    = @fopen($dataFilesPath, 'a', false);	
$logWriter = new Zend\Log\Writer\Stream($stream);
$logger    = new Zend\Log\Logger();
$logger -> addWriter($logWriter);
$logger -> registerErrorHandler($logger);
$logger -> info("Запущен index.php");	//Официальное начало работы
                                                                                  
//Загрузка конфига приложения, и другое шаманство над ним
$optionsPath = realpath(__DIR__ . '/../configs/application.config.php');
$appOptions = include $optionsPath;
$application = Application::init($appOptions);

$sm = $application ->getServiceManager();
$sm->setService('logger', $logger);

$config = NULL;
$string = $appOptions["path"];
$applicationFilesPath = realpath(__DIR__ . "/../");
$string["application"]=$applicationFilesPath;
$string["data"]=$applicationFilesPath . "/data";
$config["path"] = $string;
$string = $appOptions["db"];
$config["db"] = $string;
$logger -> info("applicationFilesPath  - $applicationFilesPath");
$sm->setService('myconfig', $config);

//include $applicationFilesPath . "/testing.php"; //блок тестирования и анализа

// попытка запуска
$application ->run();
$logger -> info("Успешно отработал index.php");
?>
