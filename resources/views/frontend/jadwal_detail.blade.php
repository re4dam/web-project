@extends('frontend.master')

@section('content')

<div class="container detail mt-5">
    <h1 class="text-center">Schedule Details</h1>
    <p><strong>Start Date:</strong> {{ $jadwal->start_date }}</p>
    <p><strong>End Date:</strong> {{ $jadwal->end_date }}</p>
    <p><strong>Status:</strong> {{ $jadwal->status }}</p>

    <h2>Booked Items</h2>
    <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwal->book as $item)
                        <tr>
                            <td>{{ $item->produk->nama_produk }}</td>
                            <td><img src="{{ $item->produk->img_path }}" alt="{{ $item->produk->nama_produk }}" class="cart-image detail"></td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp.{{ number_format($item->produk->harga, 2) }}</td>
                            <td>Rp.{{ number_format($item->harga_total, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-right"><strong>Total Cost:</strong></td>
                        <td><strong>Rp.{{ number_format($jadwal->book->sum('harga_total'), 2) }}</strong></td>
                        </tr>
                </tbody>
            </table>
        </div>

        @if (auth()->user()->is_admin)
            <div class="admin-image">
                <h3>Pembayaran</h3>
                <p><strong>Metode:</strong> {{ $jadwal->pembayaran->metode['payment_metode'] }}</p>
                @if ( $jadwal->pembayaran->metode['payment_metode'] == 'Transfer Bank')
                    <p><strong>Bank:</strong> {{ $jadwal->pembayaran->metode['bank'] }}</p>
                @endif
                <img src="{{ asset($jadwal->pembayaran->bukti) }}" alt="Admin Image" class="admin-image-class">
            </div>
        @endif

        <div class="d-flex justify-content-between">
            <a href="{{ route('jadwal') }}" class="btn btn-primary">Back to Schedules</a>
            @if (auth()->user()->is_admin == 0)
                @if ($jadwal->status == 'Pending')
                    <button class="btn btn-danger" onclick="cancelSchedule()">Cancel</button>
                    <button class="btn btn-primary" onclick="setFormAction('pending')">Proceed to Payment</button>
                @elseif ($jadwal->status == 'Waiting For Payment')
                    <button class="btn btn-primary" onclick="setFormAction('paying')">Pay Up</button>
                @else
                    <button id="proceedToPaymentBtn" class="btn btn-primary" onclick="setFormAction('view')" disabled>Already Paid</button>
                @endif
            @endif
        </div>  

        <!-- Hidden form for submitting booking ID and total cost -->
        <form id="routeForm" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">
            <input type="hidden" name="harga_total" value="{{ $jadwal->book->sum('harga_total') }}">
        </form>

        <!-- Hidden form for cancelling the schedule -->
        <form id="cancelForm" action="{{ route('jadwal.cancel') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="id_jadwal" value="{{ $jadwal->id }}">
        </form>
    </div>
</div>

<script src="{{ asset('js/adam.js') }}"></script>
<script>
    window.pageName = 'detail';
    window.pembayaranUrl = "{{ route('pembayaran')}}";
    window.bayarUrl = "{{ route('bayar')}}";

    function setFormAction(status) {
        if (window.pageName === 'detail') {
            var form = document.getElementById('routeForm');
            var Url = window.pembayaranUrl;
            var input = document.createElement("input");

            // Remove any previous "state" input if it exists
            var existingInput = document.querySelector('input[name="state"]');
            if (existingInput) {
                existingInput.remove();
            }

            if (status === 'paying') {
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "state");
                input.setAttribute("value", 2);
                form.appendChild(input);

                form.action = window.bayarUrl;
                form.submit();
            } else if (status === 'pending') {
                form.action = Url;
                form.submit();
            }
        }
    }

    function cancelSchedule() {
        var form = document.getElementById('cancelForm');
        form.submit();
    }
</script>

@endsection
