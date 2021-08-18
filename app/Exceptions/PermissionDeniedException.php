<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;

class PermissionDeniedException extends Exception
{

  /**
   * Create a new permission denied exception instance.
   *
   * @param string $permission
   */
  public function __construct()
  {
    return ValidationException::withMessages([
      'error' => 'You dont have a required permission.',
    ]);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Exception  $exception
   * @return \Illuminate\Http\Response
   */
  public function render($request, Exception $exception)
  {
    if ($exception instanceof PermissionDeniedException) {
      return response()->view('errors.custom', [], 403);
    }
  }
}
