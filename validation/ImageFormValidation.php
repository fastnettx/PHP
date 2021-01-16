<?php


namespace app\validation;


class ImageFormValidation extends Validator
{
    private $name;
    private $type;
    private $size;
    private $tmp_name;
    private $error;

    public function __construct(array $file)
    {
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->error = $file['error'];
    }


    function validate(): bool
    {
        if ($this->error) {
            $this->setError('common', 'The file is damaged');
        }
        if (strpos($this->type, 'image') === false) {
            $this->setError('type', 'File not loaded. Only images can be uploaded.');
        }
        if ($this->size > 1000000) {
            $this->setError('size', 'File size must not exceed size 1Mb');
        }
        return $this->getErrors() ? false : true;
    }
}