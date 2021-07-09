<?php

namespace App\Http\Controllers;

use App\Models\Role;
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

    $role = new Role;
    $roles = $role->getAllRoles();
    dd($roles);
    return view('dashboard.pages.roles_permissions')->with('roles', $roles);
  }
}
