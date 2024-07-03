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
            @if (!$purchase->file)
            <div class="col-12 col-md-4">
                <div class="card">
                    <form
                        class="card-body"
                        action=""
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <h6 class="text-center">Upload Bukti Pembayaran</h6>

                        @error('file')
                            <small class="text-danger text-center m-0">{{ $message }}</small>
                        @enderror

                        <input
                            type="file"
                            name="file"
                            id="bukti-pembayaran"
                        >

                        <div class="d-flex justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-sm btn-primary"
                            >Simpan Bukti</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
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

@push('style')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endpush

@push('script')
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>

<script>
    FilePond.registerPlugin(FilePondPluginImagePreview);

    const filepond = FilePond.create(document.getElementById('bukti-pembayaran'), {
        credits: false,
        labelIdle: 'Klik di sini',
        storeAsFile: true,
    });
</script>
@endpush
