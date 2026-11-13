@extends('layouts.app')
@section('title','E-Ticket | ConcertTix')
@section('content')
<div id="ticket-empty" class="panel p-5 text-center" style="display:none">
    <h3>Belum ada data pemesanan</h3><p class="muted">Silakan pilih konser dan buat pemesanan demo terlebih dahulu.</p>
    <a href="{{ route('home') }}" class="btn btn-purple">Jelajahi Konser</a>
</div>
<div id="ticket-wrap" style="display:none">
    <div class="text-center mb-4">
        <span class="pill">BOOKING PREVIEW</span>
        <h1 class="fw-bold mt-3">Your night. Your ticket.</h1>
        <p class="muted">Berikut ringkasan pemesanan anda.</p>
    </div>
    <div class="panel mx-auto p-4 p-lg-5" style="max-width:680px">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div><div class="fw-bold fs-4">CONCERT<span class="price">TIX.</span></div><small class="muted">DIGITAL E-TICKET PREVIEW</small></div>
            <span class="pill">DEMO ONLY</span>
        </div>
        <div class="ticket-cut"></div>
        <small class="price fw-bold">EVENT</small><h2 id="event-name" class="fw-bold mt-1"></h2>
        <div class="row g-3 my-3">
            <div class="col-sm-6"><small class="muted">TANGGAL</small><div id="event-date" class="fw-semibold"></div></div>
            <div class="col-sm-6"><small class="muted">LOKASI</small><div id="event-location" class="fw-semibold"></div></div>
        </div>
        <div class="ticket-cut"></div>
        <div class="row g-3">
            <div class="col-sm-6"><small class="muted">NAMA PEMESAN</small><div id="buyer-name" class="fw-semibold"></div></div>
            <div class="col-sm-6"><small class="muted">KODE BOOKING</small><div id="booking-code" class="fw-bold price"></div></div>
            <div class="col-sm-6"><small class="muted">EMAIL</small><div id="buyer-email" class="fw-semibold"></div></div>
            <div class="col-sm-6"><small class="muted">NOMOR TELEPON</small><div id="buyer-phone" class="fw-semibold"></div></div>
            <div class="col-sm-6"><small class="muted">KATEGORI</small><div id="ticket-category" class="fw-semibold"></div></div>
            <div class="col-sm-6"><small class="muted">JUMLAH TIKET</small><div id="ticket-qty" class="fw-semibold"></div></div>
            <div class="col-12"><small class="muted">KURSI</small><div id="ticket-seats" class="fw-semibold"></div></div>
        </div>
        <div class="ticket-cut"></div>
        <div class="d-flex justify-content-between align-items-center"><div><small class="muted">TOTAL</small><h3 id="ticket-total" class="price fw-bold mb-0"></h3></div><div class="text-end"><div id="ticket-mark" class="display-5">♫</div><small class="muted">ENJOY THE SHOW</small></div></div>
        <div class="alert alert-warning mt-4 mb-0 small">Ini adalah ticket konser anda silahkan melakukan pembayaran.</div>
    </div>
    <div class="d-flex justify-content-center gap-2 mt-4 no-print">
        <button onclick="window.print()" class="btn btn-purple">Cetak Ringkasan</button>
        <a href="{{ route('home') }}" class="btn btn-outline-soft">Kembali ke Beranda</a>
    </div>
</div>
@endsection
@push('scripts')
<script>
(() => {
    const raw = sessionStorage.getItem('concertTixBooking');
    const empty = document.getElementById('ticket-empty');
    const wrap = document.getElementById('ticket-wrap');
    if (!raw) { empty.style.display = 'block'; return; }
    let b;
    try { b = JSON.parse(raw); } catch(e) { empty.style.display = 'block'; return; }
    wrap.style.display = 'block';
    const fields = {
        'event-name': b.eventName, 'event-date': b.eventDate, 'event-location': b.eventLocation,
        'buyer-name': b.name, 'booking-code': b.code, 'buyer-email': b.email,
        'buyer-phone': b.phone, 'ticket-category': b.category,
        'ticket-qty': b.quantity + ' tiket', 'ticket-seats': b.seats.join(', '),
        'ticket-total': 'Rp ' + Number(b.total).toLocaleString('id-ID')
    };
    Object.entries(fields).forEach(([id, value]) => document.getElementById(id).textContent = value);
})();
</script>
@endpush
