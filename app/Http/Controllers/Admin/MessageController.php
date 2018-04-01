<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\Http\Requests\SaveMessage;

class MessageController extends Controller
{
    //
    public function index()
    {
        $messages = Message::latest()->with('user')->get();
        return view('admin.message.index')->with(compact('messages'));
    }

    /**
     * 新規作成画面
     * @param Message $message
     * @return $this
     */
    public function create(Message $message)
    {
        $userlist = User::getUserList();
        return view('admin.message.create')->with(compact('message', 'userlist'));
    }

    /**
     * 新規登録保存処理
     * @param SaveMessage $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveMessage $request, Message $message)
    {
//        $data = $request->only('user_id', 'title', 'content');
        $data = $request->getData();

        $message->forceFill($data)->save();
        // ここリダイレクト先、editではなく通常messageトップじゃない？
        return redirect(route('admin.message.edit', $message))->with('_flash_message', '登録が完了しました');
    }

    /**
     * 編集画面
     * @param Message $message
     * @return $this
     */
    public function edit(Message $message)
    {
        $userlist = User::getUserList();
        return view('admin.message.create')->with(compact('message', 'userlist'));
    }

    /**
     * 変更処理
     * @param SaveMessage $request
     * @param Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveMessage $request, Message $message)
    {

//        $data = $request->only('user_id', 'title', 'content');
        $data = $request->getData();
        $message->forceFill($data)->save();
        // ここリダイレクト先、editではなくmessageトップじゃない？
        return redirect(route('admin.message.edit', $message))->with('_flash_msg', '変更が完了しました');
    }
}
