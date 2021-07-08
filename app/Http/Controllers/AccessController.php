<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
  /**
   * This method show the main page of roles & permissions
   *
   * @return Illuminate\Http\Response
   */
  public function index()
  {
    return view('dashboard.pages.roles_permissions');
  }
}
