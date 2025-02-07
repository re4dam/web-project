@extends('frontend.master')

@section('content')

    <div class="container cart mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1 class="mb-4 text-center">Shopping Cart</h1>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table cart table-bordered table-striped">
                    <thead class="thead-dark cart">
                        <tr>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keranjang as $item)
                            @if($item->produk)
                                <tr>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td><img src="{{ $item->produk->img_path }}" class="cart-image cart"></td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>${{ number_format($item->produk->harga, 2) }}</td>
                                    <td>${{ number_format($item->produk->harga * $item->jumlah, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="btn cart btn-success btn-sm">+</button>
                                        </form>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="btn cart btn-warning btn-sm">-</button>
                                        </form>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn cart btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="6" class="text-center text-danger">Product not found</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('produk') }}" class="btn btn-primary">Continue Shopping</a>
                <a href="{{ route('jadwal') }}" class="btn btn-primary">Jadwal</a>
            </div>

            <div class="col-md-4">
                <div class="sidebar cart">
                    <h2 class="text-center">Book a Schedule</h2>
                    <form action="{{ route('jadwal.book') }}" method="POST">
                        @csrf
                        <input type="text" id="id_user" name="id_user" input="{{ auth()->id() }}" hidden>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Book Schedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
