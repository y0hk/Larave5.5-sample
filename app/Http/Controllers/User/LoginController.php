<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect
     * @return string
     */
    public function redirectTo()
    {
        return route('user.top');
    }

    /**
     * LoginForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('user.login');
    }

    /**
     * Login validate
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $messages = [
            $this->username().'.required' => 'メールアドレスを入力してください。',
            'password.required' => 'パスワードを入力してください',
        ];

        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], $messages);
    }

    /**
     * Logout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $partialLogin = auth('user')->guest() || auth('admin')->guest();
        $this->guard()->logout();

        if($partialLogin){
            $request->session()->invalidate();
        }
        return redirect()->route('user.login');
    }

    /**
     * Return to using auther
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return auth('user');
    }
}
