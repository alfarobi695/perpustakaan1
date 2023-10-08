@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header"> 
        <h1>Perpustakaan</h1> 
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
            Perpustakaan
            </div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Deskripsi</h2>
        <p class="section-lead">Menu yang berkaitan dengan pengelolahan buku perpustakaan</p>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <form action="/add-book" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label for="inputEmail3" class="text-md-right col-12 col-md-3 col-lg-3 col-form-label">Judul Buku</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="name" class="form-control" id="title" placeholder="Judul Buku" name="title">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="inputPassword3" class="text-md-right col-12 col-md-3 col-lg-3 col-form-label">Kuantitas</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" id="quantity" placeholder="Kuantitas" name="quantity">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <input type="Submit" value="Tambah Buku" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <form action="/dashboard/search" method="post" style="width: 100%;" class="d-flex align-items-center">
                            @csrf
                            <div class="col-md-4">
                                <h4 class="mb-0">Daftar Buku</h4>
                            </div>
                            <div class="col-md-4 d-flex ml-auto">
                                <input type="text" class="form-control" id="quantity" placeholder="Cari buku.." name="search">
                            </div>
                            <div class="col-md-4 d-flex">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
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

                        @if(session('cartCount'))
                        <a href="/cart">
                            <p>Keranjang ({{ session('cartCount') }} buku)</p>
                        </a>
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
                                @forelse($books as $no => $book)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->quantity }}</td>
                                    <td class="text-center" style="vertical-align:middle;">
                                        <form action="/add-to-cart/{{ $book->id }}" method="post">
                                            @csrf
                                            <button class="btn btn-info" type="submit">Tambah ke Keranjang</button>
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