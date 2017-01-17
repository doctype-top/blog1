<?php

    namespace models;

    use base\BaseForm;
    use library\Auth;

    class PostForm extends BaseForm{
        public $id;
        public $title;
        public $content;

        protected $_tableName = 'post';

        public function getRules(){
           return [
               'title' => ['required', 'unique'],
               'content' => ['required']
           ];
        }

        public function save(){
            $author_id = Auth::getUserId();
            $sql = "INSERT INTO {$this->_tableName} (title, content, author_id) VALUES '{$this->title}', '{$this->content}', {$author_id}";

            $res = $this->_db->sendQuery($sql);
            if(!$res){
                $this->_errors['saveError'] = 'Error!';
                return false;
            }
            $this->id = $this->_db->getLastInsertId();
            return true;
        }

        public function update(){
            $sql = "UPDATE {$this->_tableName} SET title = '{$this->title}', content = '{$this->content}' WHERE id = {$this->id}";

            $res = $this->_db->sendQuery($sql);
            if(!$res){
                $this->_errors['updateError'] = 'Error!';
                return false;
            }
            return true;

        }

        public function delete(){
            $sql = "DELETE FROM {$this->_tableName} WHERE id = {$this->id}";
            $res = $this->_db->sendQuery($sql);
            if(!$res){
                $this->_errors['deleteError'] = 'Error!';
                return false;
            }
            return true;
        }
    }