<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
public function index()
{
    $categories = Category::all();
    return view('index', compact('categories'));
}

public function confirm(ContactRequest $request)
  {
    $contact = $request->only([
  'last_name',
  'first_name',
  'gender',
  'email',
  'tel1',
  'tel2',
  'tel3',
  'address',
  'building',
  'category_id',
  'content'
  ,]);

// ★ category_id があるときだけカテゴリ名を取得

    if (!empty($contact['category_id'])) {
        $category = Category::find($contact['category_id']);
        $contact['category_content'] = $category ? $category->content : '';
    } else {
        $contact['category_content'] = '';
    }

  // ★ 修正ボタン用にセッションへ保存

    $request->session()->put('contact', $contact);

    return view('confirm', compact('contact'));
  }

public function store(Request $request)
{
    // セッション取得
    $contact = $request->session()->get('contact');

    // セッションが無ければトップへ戻す（超重要）
    if (!$contact) {
        return redirect('/');
    }

    // DBに保存
    Contact::create([
        'last_name'   => $contact['last_name'],
        'first_name'  => $contact['first_name'],
        'gender'      => $contact['gender'],
        'email'       => $contact['email'],
        'tel1'        => $contact['tel1'],
        'tel2'        => $contact['tel2'],
        'tel3'        => $contact['tel3'],
        'address'     => $contact['address'],
        'building'    => $contact['building'],
        'category_id' => $contact['category_id'],
        'content'     => $contact['content'],
    ]);

    // 二重送信防止
    $request->session()->forget('contact');

    // サンクスページ
    return view('thanks');
}

}