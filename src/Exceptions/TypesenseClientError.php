<?php
namespace Redwood\Typesence\Exceptions;

use Exception;

class TypesenseClientError extends Exception
{

  public function setMessage(string $message): TypesenseClientError
  {
    $this->message = $message;
    return $this;
  }

}