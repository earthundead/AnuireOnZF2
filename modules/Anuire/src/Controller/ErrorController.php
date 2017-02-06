 <?php 

namespace Anuire\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ErrorController extends Zend_Controller_Action {

    public function errorAction() 
		{
        $errors = $this->_getParam('error_handler');
 
        switch ($errors->type) 
			{
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
 
                // 404 error -- controller or action not found
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->message = 'Страница не найдена';
                break;
            default:
                // application error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->message = 'Общая ошибка приложения';
                break;
			}
 
        $this->view->exception = $errors->exception;
        $this->view->request   = $errors->request;
        $logger = Zend_Registry::get('logger');
        $logger->info('Отработал контроллер ошибки');
		}

}
