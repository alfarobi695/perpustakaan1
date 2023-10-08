<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
</head>
<body>
    <h1>Keranjang Belanja</h1>

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

    <ul>
        @forelse($cartItems as $item)
            <li>
                {{ $item->title }} (Kuantitas: {{ $item->quantity }})
                <form action="/remove-from-cart/{{ $item->id }}" method="post">
                    @csrf
                    <button type="submit">Hapus dari Keranjang</button>
                </form>
            </li>
        @empty
            <li>Keranjang belanja kosong.</li>
        @endforelse
    </ul>

    <a href="/checkout">Checkout</a>
    <a href="/dashboard">Dashboard</a>
</body>
</html>
