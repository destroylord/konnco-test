<div class="col-12 col-md-4 col-lg-3 mb-5">
    <a class="product-item" href="#">
        <img src="{{ Storage::url($item->image) }}" class="img-fluid product-thumbnail">
        <h3 class="product-title">{{ $item->name }}</h3>
        <strong class="product-price">Rp {{ number_format($item->price) }}</strong>

       
            @auth
            <button class="icon-cross btn-add-to-cart" {{ $item->stock == 0 ? 'disabled' : '' }} data-id="{{ $item->id }}">
                <img src="/assets/images/cross.svg" class="img-fluid">
            </button>
            @endauth
       
    </a>
</div>
