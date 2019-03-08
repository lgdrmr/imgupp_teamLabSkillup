<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Model\User;
use App\Model\Post;

class UserController extends Controller
{
  public function top($github_id, Request $request)
  {
    $status = LoginController::is_user_loggedin($request);

    // ユーザの存在確認
    if (User::where('github_id', $github_id)->exists()) {
      $thisuser = User::where('github_id', $github_id);
    } else {
      return redirect('/home');
    }

    $status->put('name', $github_id);
    $avater = $thisuser->value('avaterfile');
    $status->put('avater', $avater);

    // 表示ユーザの全投稿取得
    $thisuserposts = Post::latest('created_at')->where('user_id', $thisuser->value('id'))->get();
    $status->put('thisuserposts', $thisuserposts);
    // 表示ユーザのLike数取得
    $thisuserlikes = $thisuser->get()->first()->likePosts()->count();
    $status->put('thisuserlikes', $thisuserlikes);

    return view('/user', $status->all());
  }
}
