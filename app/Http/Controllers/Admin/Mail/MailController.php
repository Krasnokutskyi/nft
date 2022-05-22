<?php

namespace App\Http\Controllers\Admin\Mail;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\User;
use App\Http\Requests\Admin\Mail\MailForm;
use App\Jobs\Admin\Mail\SendMail;

class MailController extends AdminController
{
  public function mail()
  {
    $packages = Packages::all();
    return view('admin.mail.mail', compact('packages'));
  }

  public function mailAction(MailForm $request)
  {
    $validated = $request->safe()->only(['title', 'text', 'packages']);

    $packages = $validated['packages'];

    $users = User::whereHas('packages', function ($query) use ($packages) {
      $query->whereIn('package_id', $packages);
    })->get()->toArray();

    SendMail::dispatch($users, $validated['title'], $validated['text']);

    return response()->json([
      'status' => true,
      'title' => 'Emails have been sent out!',
    ]);
  }
}
