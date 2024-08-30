@extends('layouts.app')

@section('hero')
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Detail Pembelian</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4">
    
                <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <button
                                id="pay-button"
                                type="submit"
                                class="btn btn-sm btn-primary"
                                >Bayar Sekarang</button>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5>INV-{{ $purchase->datetime->format('Ymd') }}{{ $purchase->id }}</h5>
                            <x-purchase.status :status="$purchase->status" />
                        </div>
                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <h6 class="m-0">Tanggal Pembelian</h6>
                                <p class="m-0">{{ $purchase->datetime->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-12 col-md-6">
                                <h6 class="m-0">Nama Pembeli</h6>
                                <p class="m-0">{{ $purchase->user->name }}</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchase->details as $detail)
                                        <tr>
                                            <td>{{ $detail->item->name }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>Rp {{ number_format($detail->item->price) }}</td>
                                            <td>Rp {{ number_format($detail->total) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <h6>Total: Rp {{ number_format($purchase->total) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
 <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
    
        document.getElementById('pay-button').onclick = function(){
            // SnapToken acquired from previous step
            snap.pay('{{ $purchase->snap_token }}', {
            // Optional
            onSuccess: function(result){
                
                /* You may add your own js here, this is just example */
                // update status di database
                $.ajax({
                    type: 'PUT',
                    url: '/purchase/' + {{ $purchase->id }} + '/update',
                    data: {
                        result: 'success'
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href = "/purchase/" + {{ $purchase->id }} ;
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
            });
                
            },
            // Optional
            onPending: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            },
            // Optional
            onError: function(result){
                /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            }
            });
        };
    </script>
@endpush
