<?php


namespace app\validation;


class CommentFormValidator extends Validator
{
    private $body = [];

    public function __construct(array $body)
    {
        $this->body = $body;
    }

    function validate(): bool
    {
        $request = $this->body;
        if (!$request["comment"]) {
            $this->setError('comment', 'Comment cannot be empty');
        }
        if (!filter_var($request["email"], FILTER_VALIDATE_EMAIL)) {
            $this->setError('email', 'This email is not correct');
        }
        return $this->getErrors() ? false : true;
    }


}