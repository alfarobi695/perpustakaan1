<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $books = Book::where('title', 'like', '%' . $search . '%')->get();

        return view('dashboard', compact('books'));
    }
    

    public function dashboard()
    {
        $books = Book::all();
        return view('dashboard', compact('books'));
    }

    public function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        Book::create([
            'title' => $request->title,
            'quantity' => $request->quantity,
        ]);

        return redirect('/dashboard')->with('success', 'Buku berhasil ditambahkan!');
    }

}
