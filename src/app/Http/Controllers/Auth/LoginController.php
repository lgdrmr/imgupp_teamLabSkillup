<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Model\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Display login page or redirect to home
     */
    public function top(Request $request)
    {
        $status = $this::is_user_loggedin($request);
        if ($status['is_loggedin']) {
            return redirect('/home');
        } else {
            return view('/login');
        }
    }

    /**
     * Rdirect to Github auth page
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes('read:user')->redirect();
    }

    /**
     * Get user info from github and login
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('github')->user();
        if (!( User::where('github_id', $user->user['login'])->exists() )) {
            User::create([
                'github_id' => $user->user['login'],
                'avaterfile' => $user->user['avatar_url'],
            ]);
        }
        $request->session()->put('github_token', $user->token);
        return redirect('/home');
    }

    /**
     * Check is the user already logged in. (Return status and userID)
     *
     * @return array(boolean,integer)
     */
    public static function is_user_loggedin(Request $request)
    {
        if ($request->session()->has('github_token')) {
            $is_loggedin = true;
            $token = $request->session()->get('github_token', null);
            try {
                $user = Socialite::driver('github')->userFromToken($token);
            } catch (\Exception $e) {
                $this::logout($request);
            }
            $uid = User::where('github_id', $user->getNickname())->value('id');
        } else {
            $is_loggedin = false;
            $uid = null;
        }
        return collect(['is_loggedin' => $is_loggedin, 'uid' => $uid]);
    }

    /**
     * Logout from the session
     */
    public static function logout(Request $request)
    {
        $request->session()->forget('github_token');
        return redirect('/login');
    }
}
