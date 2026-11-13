<?php

use Illuminate\Support\Facades\Route;

$concerts = [
    1 => [
        'id' => 1,
        'name' => 'Sound of Summer 2026',
        'artist' => 'Various Artists',
        'location' => 'Jakarta International Stadium',
        'date' => '20 Desember 2026',
        'time' => '19.00 WIB',
        'description' => 'Festival musik dengan penampilan spesial dari berbagai musisi. Nikmati malam penuh musik, energi, dan pengalaman tak terlupakan.',
        'image' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=1400&q=85',
        'tickets' => [
            ['id' => 1, 'category' => 'VIP', 'price' => 1500000, 'quota' => 50, 'description' => 'Area premium dekat panggung.'],
            ['id' => 2, 'category' => 'Festival', 'price' => 750000, 'quota' => 100, 'description' => 'Area festival berdiri.'],
            ['id' => 3, 'category' => 'Regular', 'price' => 350000, 'quota' => 200, 'description' => 'Area reguler dengan pandangan panggung.'],
        ],
    ],
    2 => [
        'id' => 2,
        'name' => 'Midnight Beats',
        'artist' => 'DJ & Electronic Showcase',
        'location' => 'Beach City International Stadium',
        'date' => '28 Desember 2026',
        'time' => '20.00 WIB',
        'description' => 'Satu malam penuh musik elektronik, visual panggung, dan pertunjukan DJ.',
        'image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&w=1400&q=85',
        'tickets' => [
            ['id' => 4, 'category' => 'Gold', 'price' => 900000, 'quota' => 70, 'description' => 'Akses area Gold.'],
            ['id' => 5, 'category' => 'Regular', 'price' => 450000, 'quota' => 150, 'description' => 'Akses area reguler.'],
        ],
    ],
    3 => [
        'id' => 3,
        'name' => 'Acoustic Night',
        'artist' => 'Indie Live Session',
        'location' => 'Basket Hall Senayan',
        'date' => '10 Januari 2027',
        'time' => '18.30 WIB',
        'description' => 'Pertunjukan musik akustik dengan suasana intim dan santai.',
        'image' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063?auto=format&fit=crop&w=1400&q=85',
        'tickets' => [
            ['id' => 6, 'category' => 'Front Row', 'price' => 650000, 'quota' => 40, 'description' => 'Tempat duduk baris depan.'],
            ['id' => 7, 'category' => 'Regular', 'price' => 300000, 'quota' => 120, 'description' => 'Tempat duduk reguler.'],
        ],
    ],
];

Route::get('/', fn () => view('concerts.index', ['concerts' => array_values($concerts)]))->name('home');

Route::get('/concert/{id}', function ($id) use ($concerts) {
    abort_unless(isset($concerts[$id]), 404);
    return view('concerts.detail', ['concert' => $concerts[$id]]);
})->name('concert.detail');

Route::get('/booking/{ticketId}', function ($ticketId) use ($concerts) {
    foreach ($concerts as $concert) {
        foreach ($concert['tickets'] as $ticket) {
            if ($ticket['id'] == $ticketId) {
                return view('concerts.booking', compact('concert', 'ticket'));
            }
        }
    }
    abort(404);
})->name('booking');

Route::get('/ticket', fn () => view('concerts.ticket'))->name('ticket');
