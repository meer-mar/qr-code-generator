<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.admin.role.add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Validate data
    $valid = $this->validate($request, [
      'name'        => 'required|string',
      'level'       => 'required',
      'description' => 'required',
      'status'      => 'required',
    ]);

    $data = [
      'name'        => $valid['name'],
      'level'       => $valid['level'],
      'slug'        => Str::slug($valid['name'], '-'),
      'description' => $valid['description'],
      'status'      => $valid['status']
    ];

    // Save data into db
    $role = Role::create($data);;

    if ($role) {
      return redirect('/admin/roles-permissions')->with('success', 'Role created successfully.');
    } else {
      return redirect('/admin/roles-permissions')->with('error', 'Role not created!');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role, $id)
  {
    // Get single role details
    $role = Role::find($id);

    // Get all permissions
    $permissions = Permission::all();

    return view('dashboard.admin.role.edit', compact('role', 'permissions'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role, $id)
  {
    // Validate data
    $valid = $this->validate($request, [
      'name'        => 'required|string',
      'level'       => 'required',
      'description' => 'required',
      'status'      => 'required',
    ]);

    $data = [
      'name'        => $valid['name'],
      'level'       => $valid['level'],
      'slug'        => Str::slug($valid['name'], '-'),
      'description' => $valid['description'],
      'status'      => $valid['status']
    ];

    // Get specific role model
    $role = Role::find($id);
    // Detach all permissions to role
    $role->detachAllPermissions();

    // Attach permission to role
    foreach ($request->permissions as $permission) {
      // Get permission model
      $permission = Permission::find($permission);
      // Attach permission to role
      $role->attachPermission($permission);
    }

    $role = $role->update($data);

    if ($role) {
      return redirect('/admin/roles-permissions')->with('success', 'Role updated successfully.');
    } else {
      return redirect('/admin/roles-permissions')->with('error', 'Role not updated!');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Role  $role
   * @return \Illuminate\Http\Response
   */
  public function destroy(Role $role, $id)
  {
    // Delete page
    $role = Role::destroy($id);

    if ($role) {
      return redirect('/admin/roles-permissions')->with('success', 'Role Deleted Successfully.');
    } else {
      return redirect('/admin/roles-permissions')->with('error', "Role not deleted!");
    }
  }
}
