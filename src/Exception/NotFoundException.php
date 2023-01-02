<?php namespace Framework\Exception;

class NotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = "We seem to be missing what you are looking for!";
}