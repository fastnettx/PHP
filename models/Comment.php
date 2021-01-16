<?php


namespace app\models;


use app\core\DBModel;
use app\validation\CommentFormValidator;

class Comment extends DBModel
{
    protected array $errors;

    public function save(array $body): bool
    {
        $validate = new CommentFormValidator($body);
        if (!$validate->validate()) {
            $this->errors = $validate->getErrors();
            return false;
        }
        $this->saveToDatabase($body);
        return true;

    }

    private function saveToDatabase(array $body)
    {
        $sql = "INSERT INTO comments SET content=:comment, email=:email, post_id=:id";
        $number = $this->insert($sql, $body);
    }

    public function getErrors()
    {
        return $this->errors;
    }


    public function getCommentByID($id)
    {
        $sql = "SELECT comments.content, comments.email FROM posts JOIN comments ON posts.id=comments.post_id WHERE posts.id=:id";
        $arr = array('id' => $id);
        return $this->select_all($sql, $arr);
    }

}