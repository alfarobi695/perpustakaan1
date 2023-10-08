@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header"> 
        <h1>Checkout</h1> 
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">
                Checkout
            </div>
        </div>
    </div>

    <div class="section-body">
    <form action="/checkout" method="post">
        @csrf
        <h2 class="section-title">Deskripsi</h2>
        <p class="section-lead">Menu yang berkaitan dengan pengelolahan checkout</p>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah FAQ</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row mb-4">
                            <label for="inputEmail3" class="text-md-right col-12 col-md-3 col-lg-3 col-form-label">Nama</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="name" class="form-control" id="name" placeholder="Nama" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="inputPassword3" class="text-md-right col-12 col-md-3 col-lg-3 col-form-label">Nomor HP</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" id="phone" placeholder="Nomor HP" name="phone" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Pilih Buku-buku yang Ingin Dipinjam</h4>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="max-width: 90px">Pilih</th>
                                    <th style="max-width: 90px">Judul Buku</th>
                                    <th style="max-width: 90px">Stok</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $no => $book)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td><input type="checkbox" name="selected_books[]" value="{{ $book->id }}"></td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->quantity }}</td>
                                    <td class="text-center" style="vertical-align:middle;">
                                    <input type="number" name="quantities[{{ $book->id }}]" value="1" min="1" max="{{ $book->quantity }}">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="form-group row mb-4">
                            <label class="col-12 col-md-10 col-lg-10"></label>
                            <input type="Submit" value="Proses Checkout" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection