<!DOCTYPE html>
<html>
<head>
    <title>Transaksi</title>
</head>
<body>
    <h1>Transaksi</h1>

    <form action="/checkout" method="post">
        @csrf

        <label for="name">Nama:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="phone">Nomor HP:</label>
        <input type="text" id="phone" name="phone" required><br>

        <h2>Pilih Buku-buku yang Ingin Dibeli</h2>

        @foreach($books as $book)
            <label>
                <input type="checkbox" name="selected_books[]" value="{{ $book->id }}">
                {{ $book->title }} (Stok: {{ $book->quantity }})
                <input type="number" name="quantities[{{ $book->id }}]" value="1" min="1" max="{{ $book->quantity }}">
            </label><br>
        @endforeach

        <input type="submit" value="Proses Checkout">
    </form>
</body>
</html>
