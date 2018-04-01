<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;

class MessageController extends Controller
{
    // Display mine Message
    public function index(Request $request)
    {
//        $messages = Message:latest()->where('user_id', auth()->id())->get();
        $messages = auth()->user()->messages()->latest()->get();
        return view('user.message.index')->with(compact('messages'));
    }

    public function show(Message $message)
    {
        // 他人宛のメッセージの場合見せないような処理が必要！
//        $message = Message::where('user_id', auth()->id())->findOrFail(連番ID);

//        if(auth()->id() !== $message->user_id){
//            abort(403);
//        }
        // 上記をまとめて以下のようにもかける
//        abort_unless(auth()->id() === $message->user_id, 403);

        // MessagePolicyを使って書くと
//        $this->authorize('view', $message);
        // vendor/laravel/framework/src/Illuminate/Foundation/Auth/Access/AuthorizesRequests.php
        // resourceAbilityMap()でマッピングしていて、'show' => 'view'となっているので
        // 省略しても、viewが自動的に呼ばれる。
        $this->authorize($message);

        return view('user.message.show')->with(compact('message'));
    }


}
