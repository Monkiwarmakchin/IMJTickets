<?php

use App\Livewire\Tickets\TicketCreate;
use App\Livewire\Tickets\TicketIndex;
use App\Livewire\Users\Login;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view("/", "livewire.bienvenida")->name('bienvenida');
    Route::get('/login', Login::class)->name('login');
    Route::get('/tickets', TicketIndex::class)->name('tickets.user');
});

Route::get('/tickets/create', TicketCreate::class)->name('tickets.create');

Route::middleware('auth')->group(function () {
    Route::get('/tickets/index', TicketIndex::class)->name('tickets.index');
    Route::post('/push/subscribe', function (Request $request) {
        $request->validate([
            'endpoint' => 'required',
            'keys.auth' => 'required',
            'keys.p256dh' => 'required'
        ]);
    
        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
    
        $user = auth()->user();
        $user->updatePushSubscription($endpoint, $key, $token);
        
        return response()->json(['success' => true]);
    });
});
