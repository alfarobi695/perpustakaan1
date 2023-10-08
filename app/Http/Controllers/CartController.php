<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Transaction;

class CartController extends Controller
{
    public function viewCart()
    {
        $cartItems = Book::where('in_cart', true)->get();
        $cartCount = $cartItems->count();
        session(['cartCount' => $cartCount]);
        return view('cart', compact('cartItems'));
    }


    public function addToCart(Book $book)
    {
        if ($book->quantity > 0) {
            $book->in_cart = true;
            $book->save();

            return redirect('/cart')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
        } else {
            return redirect('/dashboard')->with('error', 'Buku tidak tersedia dalam stok.');
        }
    }

    public function removeFromCart(Book $book)
    {
        $book->in_cart = false;
            $book->save();
        return redirect('/cart')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    public function checkout()
    {
        $books = Book::where('in_cart', true)->get();
        return view('checkout', compact('books'));
    }

    // public function processCheckout(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'phone' => 'required|numeric',
    //     ]);

    //     $cartItems = Book::where('in_cart', true)->get();

    //     foreach ($cartItems as $item) {
    //         if ($item->quantity == 0) {
    //             return redirect('/cart')->with('error', 'Ada buku dalam keranjang yang tidak tersedia dalam stok.');
    //         }

    //         $item->update(['quantity' => $item->quantity - 1]);

    //         Transaction::create([
    //             'book_id' => $item->id,
    //             'name' => $request->name,
    //             'phone' => $request->phone,
    //         ]);

    //         $item->update(['in_cart' => false]);
    //     }

    //     return redirect('/dashboard')->with('success', 'Checkout berhasil.');
    // }
    
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'selected_books' => 'required|array',
            'quantities' => 'required|array',
        ]);

        foreach ($request->selected_books as $bookId) {
            $book = Book::findOrFail($bookId);
            $quantity = $request->quantities[$bookId];

            if ($book->quantity < $quantity) {
                return redirect('/checkout')->with('error', 'Stok buku ' . $book->title . ' tidak mencukupi.');
            }

            $book->update(['quantity' => $book->quantity - $quantity]);

            Transaction::create([
                'book_id' => $book->id,
                'name' => $request->name,
                'phone' => $request->phone,
                'quantity' => $quantity,
            ]);
        }

        // Hapus buku dari keranjang setelah checkout berhasil
        $booksToUpdate = Book::whereIn('id', $request->selected_books)->get();

        foreach ($booksToUpdate as $book) {
            $book->in_cart = false;
            $book->save();
        }

        return redirect('/cart')->with('success', 'Checkout berhasil.');
    }


}
