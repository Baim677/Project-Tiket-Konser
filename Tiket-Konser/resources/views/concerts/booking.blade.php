@extends('layouts.app')
@section('title','Booking | ConcertTix')
@section('content')
<div class="mb-4"><a href="{{ route('home') }}" class="text-decoration-none muted">← Kembali</a><h1 class="fw-bold mt-3">Amankan tiketmu</h1><p class="muted">Lengkapi detail pemesanan dalam beberapa langkah.</p></div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="panel p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-4"><span class="step">1</span><div><h5 class="mb-0">Pilih jumlah tiket & kursi</h5><small class="muted">Maksimal 5 tiket per pemesanan</small></div></div>
            <div class="row g-3 mb-4">
                <div class="col-md-8"><small class="muted">EVENT</small><div class="fw-bold">{{ $concert['name'] }}</div><small class="muted">{{ $concert['date'] }} · {{ $concert['location'] }}</small></div>
                <div class="col-md-4"><small class="muted">KATEGORI</small><div class="fw-bold price">{{ $ticket['category'] }}</div><small class="muted">Rp {{ number_format($ticket['price'],0,',','.') }} / tiket</small></div>
            </div>
            <label for="quantity" class="form-label">Jumlah tiket</label>
            <select id="quantity" class="form-select mb-4" style="max-width:180px">
                @for($i=1;$i<=min(5,$ticket['quota']);$i++)<option value="{{ $i }}">{{ $i }} tiket</option>@endfor
            </select>
            <div class="stage mb-4">STAGE / PANGGUNG</div>
            <div id="seat-map" class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                @for($i=1;$i<=24;$i++)
                    <button type="button" class="seat" data-seat="A{{ str_pad($i,2,'0',STR_PAD_LEFT) }}">A{{ str_pad($i,2,'0',STR_PAD_LEFT) }}</button>
                @endfor
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 small muted"><span>🟩 Dipilih</span><span>⬜ Tersedia</span><span>▪ Tidak tersedia (demo)</span></div>
            <div class="panel p-3 mt-4"><small class="muted">KURSI DIPILIH</small><div id="selected-label" class="fw-bold mt-1">Belum ada kursi dipilih</div></div>
        </div>
        <div class="panel p-4">
            <div class="d-flex align-items-center gap-3 mb-4"><span class="step">2</span><div><h5 class="mb-0">Data pemesan</h5><small class="muted">Pastikan data yang dimasukkan benar.</small></div></div>
            <div class="mb-3"><label class="form-label" for="buyer-name">Nama lengkap</label><input id="buyer-name" class="form-control" placeholder="Nama sesuai identitas"></div>
            <div class="row g-3">
                <div class="col-md-6"><label class="form-label" for="buyer-email">Email</label><input id="buyer-email" type="email" class="form-control" placeholder="nama@email.com"></div>
                <div class="col-md-6"><label class="form-label" for="buyer-phone">Nomor telepon</label><input id="buyer-phone" class="form-control" placeholder="08xxxxxxxxxx"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel p-4 position-sticky" style="top:100px">
            <h5 class="fw-bold">Ringkasan pesanan</h5><hr style="border-color:#40374f">
            <div class="d-flex justify-content-between mb-2"><span class="muted">Kategori</span><strong>{{ $ticket['category'] }}</strong></div>
            <div class="d-flex justify-content-between mb-2"><span class="muted">Harga tiket</span><strong>Rp {{ number_format($ticket['price'],0,',','.') }}</strong></div>
            <div class="d-flex justify-content-between mb-3"><span class="muted">Jumlah</span><strong id="qty-summary">1</strong></div>
            <hr style="border-color:#40374f">
            <small class="muted">TOTAL PEMBAYARAN</small><h3 class="price fw-bold mt-1" id="total">Rp {{ number_format($ticket['price'],0,',','.') }}</h3>
            <button id="continue" class="btn btn-purple w-100 mt-3">Buat E-Ticket Demo</button>
            <p class="muted small mt-3 mb-0">Ini simulasi front-end. Tidak ada pembayaran atau penyimpanan ke server.</p>
            <div id="form-error" class="text-danger small mt-2"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
(() => {
    const price = @json($ticket['price']);
    const eventName = @json($concert['name']);
    const category = @json($ticket['category']);
    const eventDate = @json($concert['date']);
    const eventLocation = @json($concert['location']);
    const quantity = document.getElementById('quantity');
    const total = document.getElementById('total');
    const qtySummary = document.getElementById('qty-summary');
    const selectedLabel = document.getElementById('selected-label');
    const error = document.getElementById('form-error');
    let selected = [];

    function update() {
        const qty = Number(quantity.value);
        total.textContent = 'Rp ' + (price * qty).toLocaleString('id-ID');
        qtySummary.textContent = qty + ' tiket';
        selectedLabel.textContent = selected.length ? selected.join(', ') : 'Belum ada kursi dipilih';
        document.querySelectorAll('.seat').forEach(btn => btn.classList.toggle('selected', selected.includes(btn.dataset.seat)));
    }
    document.querySelectorAll('.seat').forEach(btn => btn.addEventListener('click', () => {
        const seat = btn.dataset.seat;
        if (selected.includes(seat)) selected = selected.filter(s => s !== seat);
        else if (selected.length < Number(quantity.value)) selected.push(seat);
        else { error.textContent = 'Jumlah kursi harus sesuai jumlah tiket.'; return; }
        error.textContent = ''; update();
    }));
    quantity.addEventListener('change', () => { selected = selected.slice(0, Number(quantity.value)); update(); });
    document.getElementById('continue').addEventListener('click', () => {
        const name = document.getElementById('buyer-name').value.trim();
        const email = document.getElementById('buyer-email').value.trim();
        const phone = document.getElementById('buyer-phone').value.trim();
        if (!name || !email || !phone) { error.textContent = 'Lengkapi nama, email, dan nomor telepon.'; return; }
        if (selected.length !== Number(quantity.value)) { error.textContent = 'Pilih kursi sesuai jumlah tiket.'; return; }
        const booking = {
            code: 'CT-' + Math.random().toString(36).slice(2, 10).toUpperCase(),
            eventName, eventDate, eventLocation, category, price,
            quantity: Number(quantity.value), seats: selected, name, email, phone,
            total: price * Number(quantity.value), status: 'DEMO'
        };
        sessionStorage.setItem('concertTixBooking', JSON.stringify(booking));
        window.location.href = @json(route('ticket'));
    });
    update();
})();
</script>
@endpush
