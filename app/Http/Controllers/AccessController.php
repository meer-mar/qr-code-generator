<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
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
    // Get all roles
    $roles = Role::all();

    // Get all permissions
    $permissions = Permission::all();

    return view('dashboard.admin.pages.roles_permissions')->with('roles', $roles)->with('permissions', $permissions);
  }
}
