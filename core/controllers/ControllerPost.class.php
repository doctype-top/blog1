<?php

    namespace controllers;

    use base\Controller;
    use library\Auth;
    use library\HttpException;
    use library\Request;
    use library\Url;
    use models\Post;
    use models\PostForm;

    class ControllerPost extends Controller{
        public function actionIndex(){
            // TODO: Implement actionIndex() method.
        }
        public function actionView(){

        }

        public function actionCreate(){
            if(!Auth::isGuest()){
                $model = new PostForm();
                if(Request::isPost()){
                    if($model->load(Request::getPost()) and $model->validate()){
                        if($model->save()){
                            header('Location: /oop/post/view/'.$model->id);
                        }
                    }
                }
                $this->_view->render('post_form', ['model' => $model]);
            }else{
                throw new HttpException('Forbidden', '403');
            }
        }

        public function actionEdit(){
            if(!Auth::isGuest()){
                $postId = Url::getSegment(2);
                $post = new Post($postId);
                $model = new PostForm();
                $model->id = $post->id;
                $model->title = $post->title;
                $model->content = $post->content;

                if(Request::isPost()){
                    if($model->load(Request::getPost()) and $model->validate()){
                        if($model->update()){
                            header('Location: /oop/post/view/'.$model->id);
                        }
                    }
                }
                $this->_view->render('post_form', ['model' => $model]);
            }else{
                throw new HttpException('Forbidden', '403');
            }
        }

        public function actionDelete(){
            if(!Auth::isGuest()){

            }else{
                throw new HttpException('Forbidden', '403');
            }
        }
    }