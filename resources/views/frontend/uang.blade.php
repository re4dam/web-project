@extends('frontend.master')

@section('content')

    <div class="container jadwal">
        <div class="card jadwal">
            <div class="card-header jadwal">
                <h1 class="text-center">Rekapan Keuangan</h1>
            </div>
            <div class="card-body jadwal">
                <div class="row text-center">
                    <div class="col-sm">
                        <a href="{{ route('laporan') }}" class="btn btn-primary">All</a>
                    </div>
                    <div class="col-sm">
                        <a href="{{ route('laporan.top') }}" class="btn btn-primary">TOP 10</a>
                    </div>
                </div>
                <table class="table table-bordered jadwal">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Method</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bayars as $bayar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bayar->jadwal->user->name }}</td>
                                <td>{{ $bayar->jadwal->start_date }}</td>
                                <td>{{ $bayar->jadwal->end_date }}</td>
                                <td>{{ $bayar->metode['payment_metode'] }}</td>
                                <td>Rp.{{ number_format($bayar->total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
