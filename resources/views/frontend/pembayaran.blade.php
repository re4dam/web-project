@extends('frontend.master')

@section('content')

    <section class="payment_method_section">
        <div class="container pembayaran">
            <h2>Select Payment Method</h2>
            <form action="{{ route('bayar') }}" method="POST">
                @csrf
                <input type="hidden" name="state" value="1" hidden>
                <input type="hidden" name="id_jadwal" value="{{ $idJadwal }}" hidden>
                <input type="hidden" name="total" value="{{ $total }}" hidden>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="Transfer Bank" required>
                    <label class="form-check-label" for="transfer">
                        Transfer Bank
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="qris" value="QRIS" required>
                    <label class="form-check-label" for="qris">
                        QRIS
                    </label>
                </div>

                <!-- Bank Options Section -->
                <div id="bank-options" class="mt-4" style="display: none;">
                    <h3>Select Bank</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bank" id="bca" value="BCA">
                        <label class="form-check-label" for="bca">
                            <img src="{{ asset('images/bank/bca.png') }}" alt="BCA" class="bank-logo">
                            BCA
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bank" id="bri" value="BRI">
                        <label class="form-check-label" for="bri">
                            <img src="{{ asset('images/bank/bri.png') }}" alt="BRI" class="bank-logo">
                            BRI
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bank" id="bni" value="BNI">
                        <label class="form-check-label" for="bni">
                            <img src="{{ asset('images/bank/bni.png') }}" alt="BNI" class="bank-logo">
                            BNI
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="bank" id="mandiri" value="Mandiri">
                        <label class="form-check-label" for="mandiri">
                            <img src="{{ asset('images/bank/mandiri.png') }}" alt="Mandiri" class="bank-logo">
                            Mandiri
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Proceed to Payment</button>
            </form>
        </div>
    </section>
</div>
<script src="{{ asset('js/adam.js') }}"></script>
<script>
    window.pageName = 'pembayaran';
</script>

@endsection
