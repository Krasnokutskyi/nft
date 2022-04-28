<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Packages;
use App\Models\UserPackages;
use App\Http\Requests\Admin\Users\RegisterUserForm;
use App\Http\Requests\Admin\Users\EditUserForm;

class UsersController extends AdminController
{
  public function users(Request $request)
  {
    $users = User::orderBy('id', 'desc')->paginate(15);
    return view('admin.users.users', compact('users'));
  }

  public function register(Request $request)
  {
    $packages = Packages::all();
    return view('admin.users.register_user', compact('packages'));
  }

  public function registerAction(RegisterUserForm $request)
  {
    $validated = $request->safe()->only([
      'first_name', 'last_name', 'phone',
      'email', 'password', 'package',
    ]);

    $user_id = User::create([
      "first_name" => $validated["first_name"],
      "last_name" => $validated["last_name"],
      "phone" => $validated["phone"],
      "email" => $validated["email"],
      "password" => bcrypt($validated["password"])
    ])->id;

    UserPackages::create([
      'user_id' => $user_id,
      'package_id' => $validated['package'],
    ]);

    return response()->json(['redirect' => route("admin.users")]);
  }

  public function edit(Request $request)
  {
    $user = User::with('packages')->where('id', '=', $request->route('user_id'));

    if ($user->count() > 0) {

      $user = $user->first();
      $packages = Packages::all();

      return view('admin.users.edit_user', compact('user', 'packages'));
    }

    abort(404);
  }

  public function editAction(EditUserForm $request)
  {
    $user = User::with('packages')->where('id', '=', $request->route('user_id'));

    if ($user->count() > 0) {

      $user = $user->first();

      $validated = $request->safe()->only([
        'first_name', 'last_name', 'phone',
        'email', 'password', 'package',
      ]);

      $user->update([
        "first_name" => $validated["first_name"],
        "last_name" => $validated["last_name"],
        "phone" => $validated["phone"],
        "email" => $validated["email"]
      ]);

      UserPackages::where('user_id', '=', $user->id)->delete();
      UserPackages::create([
        'user_id' => $user->id,
        'package_id' => $validated['package'],
      ]);

      return response()->json([
        'status' => true,
        'title' => 'Information has been saved!'
      ]);
    }

    abort(404);
  }

  public function deleteAction(Request $request)
  {
    $user = User::where('id', '=', $request->route('user_id'));
    if ($user->count() > 0) {
      $user->delete();
      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}
