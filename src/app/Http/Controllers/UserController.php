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
    $status->put('name', $github_id);

    $avater = User::where('github_id', $github_id)->value('avaterfile');
    $status->put('avater', $avater);

    $thisuserid = User::where('github_id', $github_id)->value('id');
    $thisuserposts = Post::latest('created_at')->where('user_id', $thisuserid)->get();
    $status->put('thisuserposts', $thisuserposts);

    $thisuserlikes = User::where('id', $thisuserid)->get()->first()->likePosts()->count();
    $status->put('thisuserlikes', $thisuserlikes);
    return view('/user', $status->all());
  }
}
