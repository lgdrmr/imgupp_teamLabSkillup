<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Http\Controllers\Auth\LoginController;

class HomeController extends Controller
{
  public function top(Request $request)
  {
    list($is_loggedin, $uid) = LoginController::is_user_loggedin($request);

    if (empty($uid)) {
      return view('/home', [
        'is_loggedin' => $is_loggedin,
      ]);
    } else {
      return view('/home', [
        'is_loggedin' => $is_loggedin,
        'name' => Users::where('id', $uid)->value('github_id'),
        'avater' => Users::where('id', $uid)->value('avaterfile'),
      ]);
    }
  }
}
