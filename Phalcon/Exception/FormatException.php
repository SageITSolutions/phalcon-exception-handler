<?php
namespace Phalcon\Exception;
class FormatException extends Exception {
    protected const ERROR_MESSAGE = "%s: Must be in %s format";
    protected const ERROR_CODE    = 400;
    protected const LOG_MESSAGE = '';
    protected const LOG_LEVEL = null;
}