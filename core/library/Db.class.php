<?php

    namespace library;


    class Db{
        private static $_db = null;
        private $_link;

        private function __construct(){
            if(!file_exists(__DIR__.'/../config/db.conf.php')){
                throw new \Exception('Config db not found!');
            }
            $config = require_once __DIR__.'/../config/db.conf.php';
            $this->_link = @new \mysqli($config['host'], $config['user'], $config['password'], $config['db_name']);
            if($this->_link->connect_error){
                throw new \Exception($this->_link->connect_error);
            }

            $this->_link->set_charset('utf8');
        }

        public static function getDb(){
            if(is_null(self::$_db)){
                self::$_db = new Db();
            }

            return self::$_db;
        }

        public function sendQuery($sql){
            $result = $this->_link->query($sql);
            if(!$result){
                throw new \Exception($this->_link->error);
            }

            return $result;
        }

        public function getSafeData($data){
            return $this->_link->escape_string($data);
        }

        public function getLastInsertId(){
            return $this->_link->insert_id;
        }
    }