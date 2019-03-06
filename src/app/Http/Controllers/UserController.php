<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Model\Users;
use App\Model\Posts;

class UserController extends Controller
{
  public function top($github_id, Request $request)
  {
    $status = LoginController::is_user_loggedin($request);
    $status->put('name', $github_id);
    $status->put('avater', Users::where('github_id', $github_id)->value('avaterfile'));
    $thisuserid = Users::where('github_id', $github_id)->value('id');
    $status->put('thisuserposts', Posts::latest('created_at')->where('user_id', $thisuserid)->get());
    return view('/user', $status->all());
  }
}
