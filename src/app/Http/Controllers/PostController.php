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
    $status = LoginController::is_user_loggedin($request);
    $request->session()->put('uid', $status['uid']);

    if (!( $status['is_loggedin'] )) {
      return redirect('/login');
    }

    return view('/post', $status->all());
  }

  /**
   * Upload the file
   */
  public function upload(Request $request)
  {
    $this->validate($request, [
      'image' => 'required|file|image|mimes:jpeg,png,gif|max:61440',
      'caption' => 'max:200',
    ]);

    if ($request->hasFile('image')) {
      $path = $request->file('image')->store('public');
      $uid = $request->session()->pull('uid');
      Posts::create([
        'imagefile' => basename($path),
        'user_id' => $uid,
        'caption' => $request->get('caption'),
      ]);
      return redirect('/home');
    } else {
      return redirect()
        ->back()
        ->withInput()
        ->withErrors('errors');
    }
  }

  /**
   * Delete the file
   */
  public function delete(Request $request)
  {
    $iid = $request->get('image_id');
    Posts::destroy($iid);
    return redirect('/home');
  }
}
