@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header"> 
        <h1>Keranjang</h1> 
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                Keranjang
            </div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Deskripsi</h2>
        <p class="section-lead">Menu yang berkaitan dengan pengelolahan keranjang buku</p>

        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Keranjang Buku</h4>
                        <br>
                        <div class="d-flex justify-content-end">
                            <a href="/dashboard" class="btn btn-info">Dashboard</a>
                            <a href="/checkout" class="btn btn-info">Checkout</a>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif

                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="max-width: 90px">Judul Buku</th>
                                    <th style="max-width: 90px">Kuantitas</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cartItems as $no => $book)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->quantity }}</td>
                                    <td class="text-center" style="vertical-align:middle;">
                                        <form action="/remove-from-cart/{{ $book->id }}" method="post">
                                            @csrf
                                            <button class="btn btn-warning" type="submit">Hapus dari Keranjang</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <p>Tidak ada buku yang ditemukan.</p>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection