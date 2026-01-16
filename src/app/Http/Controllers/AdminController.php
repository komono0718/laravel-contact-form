<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')
            ->orderBy('id', 'desc')
            ->paginate(7);

        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function search(Request $request)
    {
        $query = Contact::with('category')->orderBy('id', 'desc');

        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->name . '%')
                  ->orWhere('first_name', 'like', '%' . $request->name . '%')
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $request->name . '%']);
            });
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    public function reset()
    {
        return redirect()->route('admin.index');
    }

    public function destroy(Request $request)
    {
        Contact::findOrFail($request->id)->delete();
        return redirect()->route('admin.index');
    }

    public function detail($id)
{
    $contact = Contact::with('category')->findOrFail($id);

    return response()->json([
        'name' => $contact->last_name . ' ' . $contact->first_name,
        'gender' => $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
        'email' => $contact->email,
        'tel' => $contact->tel1 . $contact->tel2 . $contact->tel3,
        'address' => $contact->address,
        'building' => $contact->building,
        'category' => $contact->category->content,
        'content' => $contact->content,
    ]);
}

public function export(Request $request)
{
    $query = Contact::with('category')->orderBy('id', 'desc');

    if ($request->filled('name')) {
        $query->where(function ($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->name . '%')
              ->orWhere('first_name', 'like', '%' . $request->name . '%')
              ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $request->name . '%']);
        });
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->get();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=contacts.csv',
    ];

    $callback = function () use ($contacts) {
        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
        ]);

        foreach ($contacts as $contact) {
            fputcsv($file, [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                $contact->email,
                $contact->tel1 . $contact->tel2 . $contact->tel3,
                $contact->address,
                $contact->building,
                optional($contact->category)->content,
                $contact->content,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

}