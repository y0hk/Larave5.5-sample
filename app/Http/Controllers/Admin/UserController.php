<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
//        $users = User::latest()->get();
//        $users = User::latest()->with('messages')->get();
        $users = User::latest()->withCount('messages')->get();

        return view('admin.user.index')->with(compact('users'));
    }

    /**
     * ユーザーの削除
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        // JSONで200ステータスコードを発行する
        return ['success' => true];
    }
}
