@php
use App\Enums\PurchaseStatus;
@endphp

<div>
@if($status == PurchaseStatus::UNPAID)
    <span class="badge bg-danger">Belum Lunas</span>
@endif

@if($status == PurchaseStatus::PAID)
    <span class="badge bg-success">Lunas</span>
@endif

@if($status == PurchaseStatus::CANCELED)
    <span class="badge bg-secondary">Dibatalkan</span>
@endif
</div>
