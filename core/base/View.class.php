<?php

    namespace base;

    class View{
        public $basePath = __DIR__.'/../views/templates/';
        protected $title;
        protected $seo = [];
        protected $css = [];
        protected $js = [];

        protected $_layout;

        public function setLayout($layout){
            $this->_layout = __DIR__.'/../views/layout/'.$layout.'.php';
        }
        public function render($tplName, $data = []){
            if(!empty($data)){
                foreach($data as $key => $value){
                    $$key = $value;
                }
            }
            include $this->_layout;
        }

        public function setTitle($str){
            $this->title = $str;
        }

        /**
         * @return mixed
         */
        public function getTitle(){
            return $this->title;
        }

        /**
         * @param array $css
         */
        public function setCss($css){
            $this->css[] = $css;
        }

        /**
         * @return array
         */
        public function getJs(){
            return $this->js;
        }
    }