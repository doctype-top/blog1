<?php

    namespace library;

    class Auth{
        public static function isGuest(){
            if(empty($_SESSION['user'])){
                return true;
            }

            return false;
        }

        public static function canAccess($role){
            if($_SESSION['user']['role'] == $role){
                return true;
            }

            return false;
        }
        public static function login($id, $role){
            $_SESSION['user']['id'] = $id;
            $_SESSION['user']['role'] = $role;
        }

        public static function logout(){
            session_unset();
            session_destroy();
        }

        public static function getUserId(){
            return $_SESSION['user']['id'];
        }
    }