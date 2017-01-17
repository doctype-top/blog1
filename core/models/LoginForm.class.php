<?php

    namespace models;

    use base\BaseForm;
    use library\Auth;

    class LoginForm extends BaseForm{
        public $login;
        public $password;

        public function getRules(){
            return [
                'login' => ['required', 'email'],
                'password' => ['required'],
            ];
        }

        public function doLogin(){
            $password = md5($this->password);
            $sql = "SELECT id, role FROM user WHERE login = '{$this->login}' and password = '{$password}'";

            $result = $this->_db->sendQuery($sql);
            if($result->num_rows > 0){
                $user = $result->fetch_assoc();
                Auth::login($user['id'],$user['role']);
                return true;
            }else{
                return false;
            }
        }


    }