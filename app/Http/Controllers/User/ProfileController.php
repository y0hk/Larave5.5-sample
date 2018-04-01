<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * @return $this
     */
    public function edit()
    {
        $user = auth()->user();
        // $userの情報がJSON形式で出力される。
//      return  $user;
        return view('user.profile.edit')->with(compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,'.auth()->id(),
        ]);
        auth()->user()->update($data);
        return redirect(route('user.profile.edit'))->with('_flash_msg', '変更が完了しました');
    }
}
