<?php
namespace Anuire;

class Module
{
   public function getAutoloaderConfig()
   {
       return array(
           'Zend\Loader\ClassMapAutoloader' => array(
               __DIR__ . '/autoload_classmap.php',
           ),
           'Zend\Loader\StandardAutoloader' => array(
               'namespaces' => array(
                   __NAMESPACE__ => __DIR__ . __NAMESPACE__ ,
                   __NAMESPACE__ . '\Form' => __DIR__ . '/Forms' ,
                   __NAMESPACE__ . '\Model' => __DIR__ . '/../models' ,
               ),
           ),
       );
   }
//    const VERSION = '3.0.0dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
