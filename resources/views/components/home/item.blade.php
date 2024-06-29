<div class="col-12 col-md-4 col-lg-3 mb-5">
    <a class="product-item" href="#">
        <img src="{{ Storage::url($item->image) }}" class="img-fluid product-thumbnail">
        <h3 class="product-title">{{ $item->name }}</h3>
        <strong class="product-price">Rp {{ number_format($item->price) }}</strong>

        @auth
        <span class="icon-cross btn-add-to-cart" data-id="{{ $item->id }}">
            <img src="/assets/images/cross.svg" class="img-fluid">
        </span>
        @endauth
    </a>
</div>

@push('script')
<script>
    $('.btn-add-to-cart').one('click', function(e) {
        e.stopImmediatePropagation();
        e.preventDefault();

        const itemId = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.store') }}",
            method: 'POST',
            data: {
                item_id: itemId,
                qty: 1,
            },
            dataType: 'json',
            success: function(data) {
                toastr.success(data.message);
            },
            error: function(data) {
                toastr.error(data.responseJSON.message);
            }
        })
    });
</script>
@endpush
