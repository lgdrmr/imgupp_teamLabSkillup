<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Model\User;
use App\Model\Post;

class HomeController extends Controller
{
  /**
   * The number of posts per page
   */
  public static $PPP = 3;

  public function top(Request $request)
  {
    $status = LoginController::is_user_loggedin($request);

    $page = $this::pageSet($request);
    if ($page == 1)
      $status->put('isHead', true);
    if (!( Post::all()->count() > $page * $this::$PPP ))
      $status->put('isTail', true);

    // Get posts data per page
    $posts = Post::latest('created_at')->get()->slice(($page - 1) * $this::$PPP, $this::$PPP);
    //Add like info
    $posts = $posts->map(function ($pst) use ($status) {
      return $pst->toArray() + array(
        'likes' => $pst->likeUsers()->count(),
        'isLiked' => $pst->likeUsers()->where('user_id', $status['uid'])->count() > 0,
      );
    });
    $status->put('posts', $posts);

    // Get users data per page
    $users = User::whereIn('id', $posts->pluck('user_id')->unique())->get();
    $status->put('users', $users);

    return view('/home', $status->all());
  }

  /**
   * Get page number after page transition
   */
  public static function pageSet(Request $request)
  {
    $page = 1;
    if (url()->previous() != url('/home'))
    {
      $request->session()->put('page', $page);
    } else {
      $page = $request->session()->get('page');
    }
    return $page;
  }

  public function next(Request $request)
  {
    $request->session()->increment('page');
    return redirect('/home');
  }

  public function previous(Request $request)
  {
    $request->session()->decrement('page');
    return redirect('/home');
  }
}
