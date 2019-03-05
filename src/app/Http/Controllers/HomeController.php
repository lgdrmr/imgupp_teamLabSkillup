<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Model\Users;
use App\Model\Posts;

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
    if (!( Posts::all()->count() > $page * $this::$PPP ))
      $status->put('isTail', true);

    // Get posts data per page
    $posts = Posts::latest('created_at')->get()->slice(($page - 1) * $this::$PPP, $this::$PPP);
    $status->put('posts', $posts);

    // Get users data per page
    $users = Users::whereIn('id', $posts->pluck('user_id')->unique())->get();
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
