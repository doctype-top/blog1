<?php

    namespace controllers;

    use base\Controller;
    use library\Auth;
    use library\HttpException;
    use library\Request;
    use models\LoginForm;
    use models\RegisterForm;

    class ControllerMain extends Controller{
        public function actionIndex(){
        }

        public function actionLogin(){
            if(Auth::isGuest()){
                $model = new LoginForm();
                if(Request::isPost()){
                    if($model->load(Request::getPost()) and $model->validate()){
                        if($model->doLogin()){
                            header("Location: /oop");
                        }
                    }
                }

                $this->_view->setTitle('Login');
                $this->_view->render('login', ['model' => $model]);
            }else{
                throw new HttpException('Forbidden', '403');
            }
        }

        public function actionLogout(){
            if(!Auth::isGuest()){
                Auth::logout();
                header("Location: /oop");
            }else{
                throw new HttpException('Forbidden', '403');
            }
        }

        public function actionRegister(){
            if(Auth::isGuest()){
                $model = new RegisterForm();
                if(Request::isPost()){
                    if($model->load(Request::getPost()) and $model->validate()){
                        if($model->doRegister()){
                            header('Location: /oop');
                        }
                    }
                }

                $this->_view->render('registration', ['model' => $model]);
            }else{
                throw new HttpException('Forbidden', '403');
            }
        }

    }