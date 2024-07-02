<tr id="cart-item-{{ $cart->item->id }}">
    <td class="product-thumbnail">
        <img src="{{ Storage::url($cart->item->image) }}" alt="Image" class="img-fluid">
    </td>
    <td class="product-name">
        <h2 class="h5 text-black">{{ $cart->item->name }}</h2>
    </td>
    <td class="cart-item-price" data-id="{{ $cart->item->id }}">Rp {{ number_format($cart->item->price) }}</td>
    <td>
        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
            <div class="input-group-prepend">
                <button class="btn btn-outline-black cart-item-decrease" type="button" data-id="{{ $cart->item->id }}">&minus;</button>
            </div>
            <input type="text" class="form-control text-center quantity-amount" value="{{ $cart->qty }}" id="cart-item-value-{{ $cart->item->id }}" readonly="readonly">

            <div class="input-group-append">
                <button class="btn btn-outline-black cart-item-increase" data-id="{{ $cart->item->id }}" type="button">&plus;</button>
            </div>
        </div>
    </td>
    <td class="cart-item-total" id="cart-item-total-{{ $cart->item->id }}">Rp {{ number_format($cart->item->price * $cart->qty) }}</td>
    <td>
        <form action="{{ route('cart.destroy', $cart->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-black btn-sm">X</button>
        </form>
    </td>
</tr>
