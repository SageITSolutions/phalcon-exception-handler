<?php
namespace Phalcon\Exception;

class LoginException extends Exception {
    protected const ERROR_MESSAGE = 'The credentials provided are not valid';
    protected const ERROR_CODE    = 401;
    protected const LOG_MESSAGE = '%s attempted to login with invalid credentials';
    protected const LOG_LEVEL = 'alert';
}