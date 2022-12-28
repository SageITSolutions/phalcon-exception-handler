<?php
namespace Phalcon\Exception;

abstract class Exception extends \Exception implements \Throwable
{
    protected const ERROR_MESSAGE = 'Unknown error occurred';
    protected const ERROR_CODE = 500;
    protected const LOG_MESSAGE = null;
    protected const LOG_LEVEL = 'debug';
    protected $logdisplay;

    public function __construct(...$args)
    {
        $log = static::LOG_MESSAGE ?? static::ERROR_MESSAGE;
        $this->logdisplay = ($args && is_array($args)) ? sprintf($log, ...$args) : $log;
        throw new \Exception(static::message(...$args), static::ERROR_CODE);
    }

    public function logDetails()
    {
        return (object) [
            'level' => static::LOG_LEVEL,
            'message' => $this->logdisplay
        ];
    }

    public function errorDetails()
    {
        return [
          'code' => $this->getCode(),
          'status' => 'error',
          'message' => $this->getMessage()
        ];
    }

    public static function message(...$args)
    {
        $message = ($args && is_array($args)) ? sprintf(static::ERROR_MESSAGE, ...$args) : static::ERROR_MESSAGE;
        return $message;
    }

    public static function code()
    {
        return static::ERROR_CODE;
    }
}