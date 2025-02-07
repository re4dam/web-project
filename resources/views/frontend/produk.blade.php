@extends('frontend.master')

@section('content')

    <section class="product_section">
        <div class="container product">
            <div class="row">
                <!-- Products Column -->
                <div class="col-md">
                    <div class="product-list">
                        <h1>Produk Produk Kita</h1>
                        <br><br>
                        <div class="product-cards">
                            @foreach($sortProduk as $index)
                            <div class="product-card">
                                <img src="{{ asset($index->img_path) }}" alt="Product Image">
                                <div class="card-content">
                                    <h2 class="card-title">{{ $index->nama_produk }}</h2>
                                    <p class="card-description">{{ $index->deskripsi }}</p>
                                    <p class="card-price">Rp.{{ $index->harga }},00</p>
                                    <form action="{{ route('cart.add', $index->id_produk)}}" method="post">
                                        @csrf
                                        <div class="card-button">
                                            <button type="submit">Add to Cart</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
@endsection
