<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $users = User::select('id', 'name', 'email', 'status');
      return Datatables::of($users)
        ->addIndexColumn()
        ->addColumn('role', function ($user) {
          foreach ($user->getRoles() as $role) {
            return $role->slug;
          }
        })
        ->addColumn('action', function ($user) {

          $btn = '<a href="' . route('edit.users', ['id' => $user->id]) . '" class="btn btn-info btn-sm"><i
          class="fas fa-edit mr-2"></i> Edit</a> <a href="' . route('delete.users', ['id' => $user->id]) . '" class="btn btn-danger btn-sm"><i
          class="fa fa-trash mr-2"></i> Delete</a>';

          return $btn;
        })
        ->editColumn('status', function ($user) {
          if ($user->status == 1) {
            return '<span class="badge bg-success">Active</span>';
          } else {
            return '<span class="badge bg-danger">Deactive</span>';
          }
        })
        ->rawColumns(['action', 'status'])
        ->make(true);
    }

    return view('dashboard.admin.user.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // Get All roles
    $roles = Role::all();

    return view('dashboard.admin.user.add', compact('roles'));
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
      'name' => 'required|string',
      'email' => 'required|string|unique:users,email',
      'password' => 'required|string',
      'profile_photo' => 'required|image|max:2048',
      'role' => 'required',
      'status' => 'required',
    ]);

    if ($request->hasFile('profile_photo')) {
      // Save image to folder
      $loc = '/public/user_profile_photos';
      $fileData = $request->file('profile_photo');
      $fileNameToStore = $this->uploadImage($fileData, $loc);
    } else {
      $fileNameToStore = 'no_img.jpg';
    }

    $data = [
      'name' => $valid['name'],
      'email' => $valid['email'],
      'password' => Hash::make($valid['password']),
      'profile_photo' => $fileNameToStore,
      'status' => $valid['status']
    ];

    // Save data into db
    $user = User::create($data);;

    // Attach role to user
    $role = Role::where('id', $valid['role'])->first();
    $user->attachRole($role);

    if ($user) {
      return redirect('/admin/users')->with('success', 'Record created successfully.');
    } else {
      return redirect('/admin/users')->with('error', 'Record not created!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Role $role, $id)
  {
    // Get single user details
    $user = User::where('id', $id)->first();

    // Get All roles
    $roles = $role->all();

    return view('dashboard.admin.user.edit', compact('user', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      // Validate data
      $valid = $this->validate($request, [
          'name' => 'required|string',
          'email' => 'required|string|email',
          'profile_photo' => 'image|max:2048',
          'status' => 'required',
          'about' => 'nullable|string',
          'fb' => 'nullable|url',
          'insta' => 'nullable|url',
          'twitter' => 'nullable|url',
          'linkden' => 'nullable|url',
      ]);

      // Get user data
      $user = User::findOrFail($id);

      // Detach current roles and attach new role
      $user->detachAllRoles();
      $role = Role::findOrFail($request->role);
      $user->attachRole($role);

      // Handle profile photo upload
      if ($request->hasFile('profile_photo')) {
          $loc = '/public/user_profile_photos';
          $fileData = $request->file('profile_photo');
          $fileNameToStore = $this->uploadImage($fileData, $loc);

          // Delete old profile photo
          Storage::delete('public/user_profile_photos/' . $user->profile_photo);

          $data1 = ['profile_photo' => $fileNameToStore];
      }

      // Check if password is provided
      if ($request->input('password')) {
          $data2 = ['password' => Hash::make($request->password)];
      }

      // Collect remaining fields
      $data = [
          'name' => $valid['name'],
          'email' => $valid['email'],
          'status' => $valid['status'],
          'about' => $valid['about'],
          'fb' => $valid['fb'],
          'insta' => $valid['insta'],
          'twitter' => $valid['twitter'],
          'linkden' => $valid['linkden'],
      ];

      // Merge additional data
      if (isset($data1) && isset($data2)) {
          $data = array_merge($data, $data1, $data2);
      } elseif (isset($data1)) {
          $data = array_merge($data, $data1);
      } elseif (isset($data2)) {
          $data = array_merge($data, $data2);
      }

      // Update the user
      $updated = $user->update($data);

      return $updated
          ? redirect('/admin/users')->with('success', 'User updated successfully.')
          : redirect('/admin/users')->with('error', 'Failed to update user.');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

    // delete user profile image
    $user = User::where('id', $id)->first();
    if ($user->profile_photo != 'no_img.jpg') {
      Storage::delete('public/user_profile_photos/' . $user->profile_photo);
    }

    //Delete user data
    $user = User::destroy($id);

    if ($user) {
      return redirect('/admin/users')->with('success', 'Record Deleted Successfully.');
    } else {
      return redirect('/admin/users')->with('error', "Record not deleted!");
    }
  }

  /**
   * Image upload.
   *
   * @param string $field
   * @param string $loc
   * @return \Illuminate\Http\Response
   */
  public function uploadImage($fileData, $loc)
  {
    // Get file name with extension
    $fileNameWithExt = $fileData->getClientOriginalName();
    // Get just file name
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    // Get just extension
    $fileExtension = $fileData->extension();
    // File name to store
    $fileNameToStore = time() . '.' . $fileExtension;
    // Finally Upload Image
    $fileData->storeAs($loc, $fileNameToStore);

    return $fileNameToStore;
  }
}
