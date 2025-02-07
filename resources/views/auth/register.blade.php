@extends('auth.master')

@section('content')

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4 registration-form">
            <form method="post" action="{{ route('store') }}">
            @csrf
                <div class="form-group mb-3">
                    <label for="nama_pelanggan">Nama</label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" placeholder="Enter name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="no_telefon_pelanggan">Kontak</label>
                    <input type="text" class="form-control" id="no_telefon_pelanggan" name="no_telefon_pelanggan" placeholder="Enter kontak" required>
                </div>
                <div class="form-group mb-3">
                    <label for="email_pelanggan">Alamat Email</label>
                    <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan" aria-describedby="emailHelp" placeholder="Enter email" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="password_pelanggan">Password</label>
                    <input type="password" class="form-control" id="password_pelanggan" name="password_pelanggan" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-custom btn-block">Register</button>
            </form>
        </div>
    </div>
</div>
@endsection