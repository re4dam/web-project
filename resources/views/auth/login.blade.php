@extends('auth.master')

@section('content')


    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4 registration-form">
            <form method="post" action="{{ route('authenticate') }}" >
                @csrf
            <div class="form-group mb-3">
                <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group mb-3">
        <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-custom btn-block">Login</button>
                <p>Belum mendaftar?, silahkan klik untuk <a href="{{ route('register') }}">registrasi</a></p>
            </form>
        </div>
    </div>

</div>
@endsection