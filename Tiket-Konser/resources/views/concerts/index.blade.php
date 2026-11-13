@extends('layouts.app')
@section('title','Beranda | ConcertTix')
@section('content')
<section class="hero mb-5" style="background-image:url('https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=1800&q=90')">
    <div class="hero-content">
        <span class="pill mb-3 d-inline-block">LIVE THE MOMENT · 2026</span>
        <h1 class="display-3 fw-bold mb-3">Music is better<br><span class="price">when we're together.</span></h1>
        <p class="muted fs-5 mb-4">Temukan konser favoritmu dan amankan tempat terbaik untuk pengalaman yang tak terlupakan.</p>
        <a href="#events" class="btn btn-purple">Jelajahi Konser <span aria-hidden="true">↗</span></a>
    </div>
</section>
<div id="events" class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
    <div><p class="price text-uppercase small fw-bold mb-1">Pilih pengalamanmu</p><h2 class="fw-bold mb-0">Konser pilihan</h2></div>
    <span class="muted">{{ count($concerts) }} event tersedia</span>
</div>
<div class="row g-4">
@foreach($concerts as $concert)
    <div class="col-md-6 col-lg-4">
        <article class="panel event-card h-100">
            <img class="event-img" src="{{ $concert['image'] }}" alt="{{ $concert['name'] }}">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-3"><span class="pill">LIVE MUSIC</span><span class="muted small">{{ $concert['date'] }}</span></div>
                <h4 class="fw-bold">{{ $concert['name'] }}</h4>
                <p class="muted mb-2">{{ $concert['artist'] }}</p>
                <p class="muted small mb-3">⌖ {{ $concert['location'] }}</p>
                <div class="d-flex align-items-center justify-content-between">
                    <div><small class="muted d-block">Tiket mulai</small><strong class="price">Rp {{ number_format(min(array_column($concert['tickets'],'price')),0,',','.') }}</strong></div>
                    <a href="{{ route('concert.detail',$concert['id']) }}" class="btn btn-purple">Detail Event</a>
                </div>
            </div>
        </article>
    </div>
@endforeach
</div>
@endsection
