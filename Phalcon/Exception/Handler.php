<?php
namespace Phalcon\Exception;

class Handler extends \Phalcon\Di\Injectable
{
    protected $displayClass;
    public function __construct(bool $setGlobal = true, string $displayClass = 'Error')
    {
        if($setGlobal) @set_exception_handler(array($this, 'thrown'));
        $this->setDisplay($displayClass);
    }

    public function thrown($exception)
    {
        $this->log($exception);
        $this->display($exception);
    }

    public function setDisplay(string $displayClass){
        $this->displayClass = $displayClass;
    }

    public function display($exception, $displayClass = NULL)
    {
        if(isset($displayClass)) $this->setDisplay($displayClass);

        self::convertException($exception);
        if ($this->flash) {
            $this->flash->$displayClass($exception->getMessage());
        }
        else {
            echo sprintf("Exception encountered: '%s'",$exception->getMessage());
        }
    }

    public function log($exception)
    {
        self::convertException($exception);
        $logdetail = $exception->logDetails();
        
        if ($this->logger && $logdetail->level && $logdetail->level != '') {
            $this->logger->{$logdetail->level}($logdetail->message);
        }
    }

    public function getJSON($exception){
        $this->log($exception);
        return $exception->errorDetails();
    }

    public static function convertException(&$exception)
    {
        if (!is_subclass_of($exception, Exception::class)) {
            $exception = UnknownException::cast($exception);
        }
    }
}
?>