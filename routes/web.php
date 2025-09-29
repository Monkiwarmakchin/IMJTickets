<?php

use App\Livewire\Tickets\TicketCreate;
use App\Livewire\Tickets\TicketIndex;
use App\Livewire\Users\Login;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view("/", "livewire.bienvenida")->name('bienvenida');
    Route::get('/login', Login::class)->name('login');
    Route::get('/tickets', TicketIndex::class)->name('tickets.user');
});

Route::get('/tickets/create', TicketCreate::class)->name('tickets.create');

Route::middleware('auth')->group(function () {
    Route::get('/tickets/index', TicketIndex::class)->name('tickets.index');
});

