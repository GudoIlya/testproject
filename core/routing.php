<?php 


class simpleRouter{
    // Дефолтные настройки

    private $_defaultController = "IndexController";
    private $_defaultAction = "index";
    private $_controller = '';
    private $_controllerFolder = 'controller';
    private $_controllerPath = ''; // Должен состоять из пути и закрывающего "/"
    private $_action  = '';
    private $_param = array();

    public function __construct() {
        $this->_parseRoute();
    }

    public function execute() {
        $controller_path = $this->_controllerFolder.$this->_controllerPath."/".$this->_controller.".php";
        if(file_exists($controller_path)) {
            require_once $controller_path;
            $controller = new $this->_controller;
        } else {
            require_once  $this->_controllerFolder."/error/ErrorController.php";
            $controller = new ErrorController();
            $this->_action = 'showError404';
        }
        call_user_func(array($controller, $this->_action), $this->_param);
    }

    /**
     * Парсит запрашиваемый URL, отсекает $_GET параметры.
     * Определяет контроллер и действие.
     */
    private function _parseRoute() {
        $tempRoute = explode('?', $_SERVER['REQUEST_URI']);
        $this->_path = explode('/', $tempRoute[0]);
        if(empty($this->_path[1])) {
            $this->_controller = $this->_defaultController;
            $this->_action = $this->_defaultAction;
            $this->_controllerPath = '';
        } else if(!empty($this->_path[count($this->_path) - 1])) {
            $this->_action = array_pop($this->_path);
            $tempController = array_pop($this->_path);
            $this->_controller = ucfirst(strtolower($tempController))."Controller";
            $this->_controllerPath = implode('/', $this->_path);
        }
    }

}

?>