<?php

    namespace library;

    class Validator{
        protected $_errors = [];
        protected $_rules = [];
        protected $_fields = [];
        protected $_data = [];
        protected $_table;

        public function __construct($data, $rules){
            $this->_rules = $rules;
            $this->_data = $data;

            $this->_fields = array_keys($rules);
        }

        protected function required($field){
            if(empty($this->_data[$field])){
                $this->addError($field, 'Field must be set!');
            }
        }

        protected function email($field){
            if(!preg_match('/^([\w\-.])+@+([\w\-]{2}+.+[a-zA-Z]{2})$/', $this->_data[$field])){
                $this->addError($field, 'email in wrong format');
            }
        }

        protected function unique($field){
            $sql = "SELECT * FROM {$this->_table} WHERE {$field} = '{$this->_data[$field]}'";
            $res = Db::getDb()->sendQuery($sql);
            if($res->num_rows > 0){
                $this->addError($field, 'not unique');
            }

        }

        protected function confirm($field){
            if($this->_data[$field] != $this->_data[$field.'_confirm']){
                $this->addError($field, $field.' не совпадает с '.$field.'_confirm');
            }
        }


        public function addError($field, $error){
            $this->_errors[$field] = $error;
        }

        public function getErrors(){
            return $this->_errors;
        }

        public function getError($field){
            return $this->_errors[$field];
        }

        public function validateThis(){
            foreach($this->_rules as $field => $rules){
                foreach($rules as $rule){
                    if(method_exists($this, $rule)){
                        if(is_null($this->getError($field))){
                            $this->$rule($field);
                        }
                    }else{
                        throw new \Exception('Unknown validation rule: '.$rule);
                    }
                }
            }

            if(!empty($this->_errors)){
                return false;
            }

            return true;
        }

        public function setTable($table){
            $this->_table = $table;
        }
    }