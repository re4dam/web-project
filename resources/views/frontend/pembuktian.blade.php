<!-- resources/views/payment/show.blade.php -->

@extends('frontend.master')

@section('content')

    <div class="container pembuktian mt-5">
        @if ($bayar->metode['payment_metode'] == 'Transfer Bank')
        <h1 class="text-center">Bank Account Details</h1>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Bank Name: {{ $bayar->metode['bank'] }}</h5>
                @if ($bayar->metode['bank'] == 'BCA')
                    <p class="card-text">Account Number: 123456</p>
                @elseif ($bayar->metode['bank'] == 'Mandiri')
                    <p class="card-text">Account Number: 456789</p>
                @elseif ($bayar->metode['bank'] == 'BRI')
                    <p class="card-text">Account Number: 789123</p>
                @elseif ($bayar->metode['bank'] == 'BNI')
                    <p class="card-text">Account Number: 321987</p>
                @endif
            </div>
        </div>
        @elseif ($bayar->metode['payment_metode'] == 'QRIS')
            <h1 class="text-center">QRIS Details</h1>

            <div class="card mt-3">
                <div class="card-body">
                    <img src="{{ asset('images/bank/QRIS.png') }}" alt="">  
                </div>
            </div>
        @endif

        <h2 class="mt-5">Submit Proof of Payment</h2>

        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('bukti') }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $bayar->id }}">
            <input type="hidden" name="jadwal_id" value="{{ $bayar->id_jadwal }}">
            <input type="hidden" name="metode" value="{{ $bayar->metode['payment_metode'] }}">
            <div class="form-group">
                <label for="total_cost">Total Cost:</label>
                <input type="text" name="total_cost" id="total_cost" class="form-control" value="{{ $bayar->total }}" readonly>
            </div>
            <div class="form-group">
                <label for="proof_of_payment">Proof of Payment:</label>
                <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control-file" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            <a href="{{ route('jadwal') }}" class="btn btn-primary">Return</a>
        </div>
    </div>
</div>

<script>
    window.pageName = 'pembuktian';
</script>
@endsection
