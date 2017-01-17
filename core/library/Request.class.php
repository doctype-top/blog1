<?php

    namespace library;

    class Request{
        public static function isPost(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                return true;
            }

            return false;
        }

        public static function getPost($param = null){
            if(is_null($param)){
                return $_POST;
            }else{
                return $_POST[$param];
            }
        }
    }