<?php

declare(strict_types = 1);

namespace Framework\Exception;

class NotFoundException extends \Exception
{
	protected $code = 404;
	protected $message = "We seem to be missing what you are looking for!";
}
