<?php

    namespace base;

    use library\Db;
    use library\Validator;

    abstract class BaseForm{
        protected $_db;
        protected $_errors = [];
        protected $_data;
        protected $_validator = null;

        public function __construct(){
            $this->_db = Db::getDb();
        }

        abstract public function getRules();

        public function validate(){
            $validator = new Validator($this->_data, $this->getRules());
            if(!empty($this->_tableName)){
                $validator->setTable($this->_tableName);
            }
            if(!$validator->validateThis()){
                $this->_errors = $validator->getErrors();
                return false;
            }
            return true;
        }

        public function load($data){
            foreach($data as $propName => $propValue){
                if(property_exists(static::class, $propName)){
                    $propValue = $this->_db->getSafeData($propValue);
                    $this->$propName = $propValue;
                    $this->_data[$propName] = $propValue;
                }else{
                    return false;
                }
            }

            return true;
        }

        public function getErrors(){
            return $this->_errors;
        }
    }