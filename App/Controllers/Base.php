<?php
    
    
    namespace App\Controllers;
    
    
    use App\View;

    class Base
    {
        protected $view;
    
        public function __construct()
        {
            $this->view = new View;
        }
    
        public function action($action, $param = '')
        {
            $methodName = 'action' . $action;
            if ($param) {
                return $this->$methodName($param);
            }
            return $this->$methodName();
        }
    }