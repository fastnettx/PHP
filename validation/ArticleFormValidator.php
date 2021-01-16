<?php


namespace app\validation;


class ArticleFormValidator extends Validator
{
    private $body = [];

    public function __construct(array $body)
    {
        $this->body = $body;
    }


    function validate(): bool
    {
        $request = $this->body;
        $status = array('NEW', 'OPEN', 'CLOSE');

        if (!$request["title"]) {
            $this->setError('title', 'title cannot be empty');
        }
        if (!$request["content"]) {
            $this->setError('content', 'content cannot be empty');
        }
        if (!$request["tags"]) {
            $this->setError('tags', 'tags cannot be empty');
        }
        if (!in_array($request["status"], $status)) {
            $this->setError('status', 'status does not match the data');
        }

        return $this->getErrors() ? false : true;
    }
}