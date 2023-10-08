<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('cartCount'))
        <a href="/cart"><p>Keranjang ({{ session('cartCount') }} buku)</p></a>
    @endif

    <form action="/dashboard/search" method="post">
        @csrf
        <input type="text" name="search" placeholder="Cari buku...">
        <button type="submit">Cari</button>
    </form>
    <br>


    <form action="/add-book" method="post">
        @csrf
        <label for="title">Judul Buku:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="quantity">Kuantitas:</label>
        <input type="number" id="quantity" name="quantity" required min="1"><br>

        <input type="submit" value="Tambah Buku">
    </form>

    <h2>Daftar Buku</h2>
    <ul>
        @forelse($books as $book)
            <div>
                <h3>{{ $book->title }}</h3>
                <p>Kuantitas: {{ $book->quantity }}</p>

                <form action="/add-to-cart/{{ $book->id }}" method="post">
                    @csrf
                    <button type="submit">Tambah ke Keranjang</button>
                </form>
            </div>
        @empty
            <p>Tidak ada buku yang ditemukan.</p>
        @endforelse        
    </ul>

</body>
</html>
