<?php

    namespace models;

    use library\Db;
    use library\HttpException;

    class Post{
        public $id;
        public $title;
        public $content;
        public $author;
        public $pubdate;

        protected $_db;

        public function __construct($id){
            $this->_db = Db::getDb();
            $sql = "SELECT post.id, post.title, post.content, post.pubdate, user.id as author_id, user.login as author_name FROM post, user WHERE post.author_id = user.id and post.id = {$id}";

            $res = $this->_db->sendQuery($sql);
            if($res->num_rows == 0){
                throw new HttpException('Not Found', '404');
            }

            $post = $res->fetch_assoc();
            $this->id = $post['id'];
            $this->title = $post['title'];
            $this->content = $post['content'];
            $this->pubdate = $post['pubdate'];
            $this->author = [
                'name' => $post['author_name'],
                'id' => $post['author_id']
            ];
        }


    }