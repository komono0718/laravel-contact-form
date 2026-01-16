<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

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
            'content',
        ]);

        if (!empty($contact['category_id'])) {
            $category = Category::find($contact['category_id']);
            $contact['category_content'] = $category ? $category->content : '';
        } else {
            $contact['category_content'] = '';
        }

        $request->session()->put('contact', $contact);

        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = $request->session()->get('contact');

        if (!$contact) {
            return redirect('/');
        }

        $tel = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        Contact::create([
            'last_name'   => $contact['last_name'],
            'first_name'  => $contact['first_name'],
            'gender'      => $contact['gender'],
            'email'       => $contact['email'],
            'tel'         => $tel,
            'address'     => $contact['address'],
            'building'    => $contact['building'],
            'category_id' => $contact['category_id'],
            'detail'      => $contact['content'],
        ]);

        $request->session()->forget('contact');

        return view('thanks');
    }
}