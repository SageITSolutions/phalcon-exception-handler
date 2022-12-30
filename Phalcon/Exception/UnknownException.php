<?php
namespace Phalcon\Exception;

class UnknownException extends Exception {
    protected const LOG_MESSAGE = null;
    protected const LOG_LEVEL = 'error';
    protected $logdisplay;

    public function __construct($message, $code, $class = ""){
        parent::__construct($message, $code);
        $this->logdisplay = $message;
    }

    public function logDetails(){
        return (object)[
            'level'     => static::LOG_LEVEL,
            'message'   => $this->logdisplay
        ];
    }

    public static function cast($exception){
        $code = $exception->getCode() ?? 500;
        $message = $exception->getMessage() ?? "Error Obtaining Message";
        if(!$code || $code == 0) $code = 500;
        $class = get_class($exception) ?? "";
        return new self($message, $code, $class);
    }
}