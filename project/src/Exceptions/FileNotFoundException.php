<?php

namespace AskNicely\Exceptions;

use Exception;

class FileNotFoundException extends Exception
{
  public function __construct(string $error)
  {
    $this->message = $error;
  }
}