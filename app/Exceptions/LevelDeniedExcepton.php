<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class LevelDeniedExcepton extends Exception
{
  /**
   * Create a new permission denied exception instance.
   *
   * @param string $permission
   */
  public function __construct($level)
  {
    return ValidationException::withMessages([
      'error' => 'You dont have a required ' . $level . ' level.'
    ]);
  }
}
