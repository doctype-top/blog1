<?php

    namespace models;

    use base\BaseForm;
    use library\Auth;

    class RegisterForm extends BaseForm{
        public $login;
        public $password;
        public $password_confirm;

        protected $_tableName = 'user';

        public function getRules(){
            return [
                'login' => ['required', 'email', 'unique'],
                'password' => ['required', 'confirm'],
            ];
        }

        public function doRegister(){
            $password = md5($this->password);
            $sql = "INSERT INTO user (login, password) VALUES ('{$this->login}', '{$password}')";

            $res = $this->_db->sendQuery($sql);
            if(!$res){
                $this->_errors['register'] = 'Error!';
                return false;
            }

            $id = $this->_db->getLastInsertId();
            $role = 'user';
            Auth::login($id, $role);
            return true;

        }

    }