<?php

namespace app\models;

use app\core\DBModel;
use app\validation\ArticleFormValidator;

class Article extends DBModel
{
    protected array $errors;

    public function save(array $body): bool
    {
        $validate = new ArticleFormValidator($body);
        if (!$validate->validate()) {
            $this->errors = $validate->getErrors();
            return false;
        }
        $this->saveToDatabase($body);
        return true;

    }

    public function saveToDatabase($data)
    {
        $data2['tags'] = ($data['tags']);
        unset($data['tags']);
        $sql1 = "INSERT INTO posts SET title=:title, content=:content, status_id=(SELECT id FROM statuses WHERE name=:status)";
        $number_1 = $this->insert($sql1, $data);
        $sql2 = "INSERT INTO tags SET name=:tags";
        $number_2 = $this->insert($sql2, $data2);
        $sql = "INSERT INTO post_tags (post_id, tags_id) VALUES (:post_id,:tags_id)";
        $data3 = ['post_id' => $number_1, 'tags_id' => $number_2];
        $this->insert($sql, $data3);

    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getAllValues()
    {
        $sql = "SELECT * FROM  posts ";
        return $this->select_all($sql);
    }

    public function getDataById($id): ?array
    {
        if (is_numeric($id)) {
            return $this->getById($id);
        }
        return false;
    }

    private function getById(int $id)
    {
        $sql = "SELECT p.id as id, p.title as title, p.content as content, s.name as status, ta.name as tags 
        FROM  posts p  LEFT JOIN statuses s ON p.status_id=s.id  JOIN post_tags pt ON pt.post_id = p.id 
        JOIN tags ta  ON pt.tags_id= ta.id WHERE p.id=:id";
        $arr = array('id' => $id);
        return $this->select($sql, $arr);
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM posts WHERE id=$id";
        $this->delete($sql);
    }

    public function updateArticle(array $body)
    {
        $validate = new ArticleFormValidator($body);
        if (!$validate->validate()) {
            return false;
        }
        return $this->updateById($body);
    }

    private function updateById(array $body)
    {
        $sql = "UPDATE posts LEFT JOIN post_tags ON posts.id = post_tags.post_id JOIN tags ON post_tags.tags_id= tags.id 
    SET posts.title=:title, posts.content=:content, posts.status_id=(SELECT id FROM statuses WHERE name=:status), tags.name=:tags 
    WHERE posts.id=:id";
        return $this->update($sql, $body);
    }

}