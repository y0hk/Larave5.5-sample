<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    protected $sessionKey = 'SignupData';

    public function index(User $user)
    {
        if ($data = \Session::get($this->sessionKey)) {
            $user->fill($data);
        }
        return view('signup.index')->with(compact('user'));
    }

    public function postIndex(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required|max:255',
//            'email'    => 'required|max:255|email|unique:users,email',
//            'password' => 'required|confirmed|password_between:4,30|password_string',
//        ]);
//
////        $data = [
////            'name' => $request->name,
////            'email' => $request->email,
////            'password' => $request->password
////        ];
//        $data = $request->only('name', 'email', 'password');

        // V5.5以降
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|confirmed|password_between:4,30|password_string',
        ]);

        \Session::put($this->sessionKey, $data);

        return redirect()->route('signup.confirm');
    }

    /**
     * 確認画面
     */
    public function confirm()
    {
        if (! $data = \Session::get($this->sessionKey)) {
            return redirect()->route('signup.index');
        }

        return view('signup.confirm')->with(compact('data'));
    }

    /**
     * 登録処理等
     */
    public function postConfirm(User $user)
    {
        if (! $data = \Session::get($this->sessionKey)) {
            return redirect()->route('signup.index');
        }

        $data['password'] = bcrypt($data['password']);

        $user->fill($data)->save();

        auth('user')->login($user);

        \Session::forget($this->sessionKey);

        return redirect()->route('signup.thanks');
    }

    /**
     * 完了画面
     */
    public function thanks()
    {
        return view('signup.thanks');
    }


}
