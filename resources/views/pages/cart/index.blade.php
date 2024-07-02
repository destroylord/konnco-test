@extends('layouts.app')


@section('hero')
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
            <div class="col-lg-7">

            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table" id="cart-table">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Gambar</th>
                                <th class="product-name">Produk</th>
                                <th class="product-price">Harga</th>
                                <th class="product-quantity">Jumlah</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                                <x-cart.item :cart="$cart" />
                            @empty
                                <tr>
                                    <td colspan="6">Tidak ada item di dalam cart</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-6">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Total Produk</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black" id="itemstotal-value">{{ $carts->count() }}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total Harga</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black" id="grandtotal-value">Rp {{ number_format($carts->sum(fn ($cart) => $cart->item->price * $cart->qty)) }}</strong>
                            </div>
                        </div>
                        <div class="row">
                            <form class="col-md-12" action="{{ route('cart.checkout') }}" method="post">
                                @csrf
                                <button class="btn btn-black btn-lg py-3 btn-block" id="btn-checkout" @disabled($carts->isEmpty())>Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    function parseInteger(value) {
        return parseInt(value.replace(/[^\d]/g, ''));
    }

    function parseRupiah(value) {
        const rupiah = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return `Rp ${rupiah}`;
    }

    function updateGrandTotal() {
        let itemsTotal = 0;
        let grandtotal = 0;

        $('.cart-item-price').each(function(i, item) {
            const itemId = $(item).data('id');
            const cartValue = parseInteger($(`#cart-item-value-${itemId}`).val());
            const itemPrice = parseInteger(item.innerText);
            const cartTotal = cartValue * itemPrice;

            $(`#cart-item-total-${itemId}`).html(parseRupiah(cartTotal));
            grandtotal += cartTotal;
        });

        $('#cart-table > tbody > tr').each(() => itemsTotal++);

        if(itemsTotal < 1)
            $('#btn-checkout').attr('disabled', true);

        $(`#itemstotal-value`).html(itemsTotal);
        $(`#grandtotal-value`).html(parseRupiah(grandtotal));


    }

    $('#cart-table').on('click', '.cart-item-increase', function() {
        const itemId = $(this).data('id');
        const cartValue = parseInt($(`#cart-item-value-${itemId}`).val());

        $.ajax({
            url: "{{ route('cart.store') }}",
            method: "POST",
            data: {
                item_id: itemId,
                qty: 1,
            },
            dataType: 'JSON',
            success: function(data) {
                $(`#cart-item-value-${itemId}`).val(cartValue + 1);
                updateGrandTotal();
            },
            error: function(data) {
                toastr.error(data.responseJSON.message);
            }
        });
    });

    $('#cart-table').on('click', '.cart-item-decrease', function() {
        const itemId = $(this).data('id');
        const cartValue = $(`#cart-item-value-${itemId}`).val() - 1;

        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "PATCH",
            data: {
                item_id: itemId,
                qty: cartValue,
            },
            dataType: 'JSON',
            success: function(data) {
                $(`#cart-item-value-${itemId}`).val(cartValue);

                if(cartValue == 0)
                    $(`#cart-item-${itemId}`).remove();

                updateGrandTotal();
            },
            error: function(data) {
                toastr.error(data.responseJSON.message);
            }
        });
    });
</script>
@endpush
