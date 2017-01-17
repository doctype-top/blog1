<?php

    namespace base;

    abstract class Controller{
        protected $_view;
        public function __construct(){
            $this->_view = new View();
            $this->_view->setLayout('main');
        }

        abstract public function actionIndex();
    }