@extends('layouts.app')

@section('hero')
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Studio Desain Interior Modern <span class="d-block">Segera Hadir!</span></h1>
                    <p class="mb-4">Menyajikan desain interior yang menarik dan menenangkan untuk ruangan Anda. Daftar sekarang dan rasakan kebahagian dari ruangan impian Anda!</p>

                </div>
            </div>
            <div class="col-lg-7">
                <div class="hero-img-wrap">
                    <img src="/assets/images/couch.png" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row">
            @foreach ($items as $item)
                <x-home.item :item="$item" />
            @endforeach
        </div>
    </div>
</div>
@endsection
