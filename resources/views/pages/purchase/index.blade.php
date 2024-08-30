@extends('layouts.app')


@section('content')
<div class="untree_co-section before-footer-section">
    <div class="container">
        <div class="row justify-content-center">
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp. {{ number_format($item->price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                </tfoot>
            </table>
                    </div>

                </div>
                </div>
@endsection