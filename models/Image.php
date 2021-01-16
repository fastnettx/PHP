<?php


namespace app\models;

use app\core\DBModel;
use app\validation\ImageFormValidation;

class Image extends DBModel
{
    public function save($file, $id)
    {
        $validate = new ImageFormValidation($file);
        if (!$validate->validate()) {
            $this->errors = $validate->getErrors();
            var_dump($validate->getErrors());
            return false;
        }
        $converted_array = $this->fileConversion($file);
        if (!is_null($converted_array)) {
            $this->saveToDatabase($converted_array, $id);
        }
        return true;
    }

    private function fileConversion($file): ?array
    {
        $image = [];
        $file_name = md5($file['name'] . time());
        $uploadfile = $this->DIR_NAME . $file_name;
        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
            $image['name'] = $file['name'];
            $image['codedname'] = $file_name;
            $image['type'] = $file['type'];
            $image['size'] = $file['size'];
            return $image;
        }
        return null;
    }

    private function saveToDatabase(array $image, $id)
    {
        $image['post_id'] = $id;
        $sql = "INSERT INTO images SET name=:name, codedname=:codedname, type=:type, size=:size, post_id=:post_id";
        $this->insert($sql, $image);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getImageById($id)
    {
        $sql = "SELECT images.name, images.codedname FROM posts JOIN images ON posts.id=images.post_id WHERE posts.id=:id";
        $arr = array('id' => $id);
        return $this->select_all($sql, $arr);
    }

}