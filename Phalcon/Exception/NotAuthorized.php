<?php
namespace Phalcon\Exception;

class NotAuthorizedException extends Exception {
    protected const ERROR_MESSAGE = 'The provided account is not authorized to this resource';
    protected const ERROR_CODE    = 401;
    protected const LOG_MESSAGE = '%s/%s attempted from unauthorized user';
    protected const LOG_LEVEL = 'alert';
}