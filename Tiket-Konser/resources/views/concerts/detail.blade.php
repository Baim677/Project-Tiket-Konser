@extends('layouts.app')
@section('title','Detail Konser | ConcertTix')
@section('content')
<a href="{{ route('home') }}" class="text-decoration-none muted">← Kembali ke katalog</a>
<div class="panel overflow-hidden mt-3 mb-4">
    <img src="{{ $concert['image'] }}" alt="{{ $concert['name'] }}" style="width:100%;height:clamp(220px,38vw,420px);object-fit:cover">
    <div class="p-4 p-lg-5">
        <span class="pill">OFFICIAL EVENT</span>
        <h1 class="display-5 fw-bold mt-3">{{ $concert['name'] }}</h1>
        <p class="fs-5 muted">{{ $concert['artist'] }}</p>
        <div class="row g-3 my-3">
            <div class="col-sm-6"><div class="panel p-3"><small class="muted">TANGGAL & WAKTU</small><div class="fw-semibold mt-1">▦ {{ $concert['date'] }} · {{ $concert['time'] }}</div></div></div>
            <div class="col-sm-6"><div class="panel p-3"><small class="muted">LOKASI</small><div class="fw-semibold mt-1">⌖ {{ $concert['location'] }}</div></div></div>
        </div>
        <h5 class="mt-4">Tentang acara</h5><p class="muted mb-0">{{ $concert['description'] }}</p>
    </div>
</div>
<div class="d-flex justify-content-between align-items-end mb-3"><div><small class="price fw-bold">SECURE YOUR SPOT</small><h2 class="fw-bold mb-0">Pilih kategori tiket</h2></div></div>
<div class="row g-3">
@foreach($concert['tickets'] as $ticket)
    <div class="col-md-4">
        <div class="panel p-4 h-100 d-flex flex-column">
            <div class="d-flex justify-content-between"><h4 class="fw-bold">{{ $ticket['category'] }}</h4><span class="pill">Tersedia</span></div>
            <h3 class="price fw-bold my-2">Rp {{ number_format($ticket['price'],0,',','.') }}</h3>
            <p class="muted">{{ $ticket['description'] }}</p>
            <p class="small muted mt-auto">Kuota demo: {{ $ticket['quota'] }} tiket</p>
            <a href="{{ route('booking',$ticket['id']) }}" class="btn btn-purple w-100">Pilih Tiket</a>
        </div>
    </div>
@endforeach
</div>
@endsection
