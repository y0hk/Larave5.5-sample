<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMessage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|max:255',
            'content' => 'required|max:50000',
        ];
    }

    /**
     * カスタムエラーメッセージ
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => '誰宛かを選択してください。',
        ];
    }

    /**
     * 項目の日本語設定
     * @return array
     */
    public function attributes()
    {
        return [
            'user_id' => '誰宛',
            'title' => 'タイトル',
            'content' => '本文',
        ];
    }

    /**
     * prepareForValidation()
     * Ver.5.3.23~
     */
    protected function prepareForValidation()
    {
        // タイトルを全角カナに変換
        $title = mb_convert_kana($this->title, 'CK');
        $this->merge(compact('title'));
    }

    /**
     * データ取得
     * @return array
     */
    public function getData()
    {
        return $this->only('user_id', 'title', 'content');
        // rules()に記述しているもので返すやり方
//        return $this->all(array_keys($this->rules()));
    }


}
