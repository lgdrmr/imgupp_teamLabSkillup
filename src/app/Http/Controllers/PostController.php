<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Model\Posts;

class PostController extends Controller
{
  public function top(Request $request)
  {
    list($is_loggedin, $uid) = LoginController::is_user_loggedin($request);
    $request->session()->put('uid', $uid);

    if (!( $is_loggedin )) {
      return redirect('/home');
    }

    return view('/post', [
      'is_loggedin' => $is_loggedin,
    ]);
  }

  /**
   * Process the file upload.
   */
  public function upload(Request $request)
  {
    $this->validate($request, [
      'image' => 'required|file|image|mimes:jpeg,png,gif|max:61440',
      'caption' => 'max:200',
    ]);

    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('public');
      $uid = $request->session()->get('uid');
      Posts::create([
        'imagefile' => basename($path),
        'user_id' => $uid,
        'caption' => $request->get('caption'),
      ]);
      $request->session()->forget('uid');
      return redirect('/home');
    } else {
      return redirect()
        ->back()
        ->withInput()
        ->withErrors('errors');
    }
  }
}
