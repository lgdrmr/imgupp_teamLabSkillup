<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Model\Post;

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
      Post::create([
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
    Post::destroy($iid);
    return redirect('/home');
  }

  /**
   * Like the post
   */
  public function like(Request $request)
  {
    $status = LoginController::is_user_loggedin($request);
    $iid = $request->get('image_id');
    Post::where('id', $iid)->get()->first()->likeUsers()->attach($status['uid']);
    return redirect('/home');
  }

  public function unlike(Request $request)
  {
    $status = LoginController::is_user_loggedin($request);
    $iid = $request->get('image_id');
    Post::where('id', $iid)->get()->first()->likeUsers()->detach($status['uid']);
    return redirect('/home');
  }
}
