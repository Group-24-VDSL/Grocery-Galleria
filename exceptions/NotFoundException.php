<?php

namespace app\core\exceptions;

use Throwable;

class NotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = "Page Not Found";

}