<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class Navbar extends Component
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireccion full reload
        return redirect()->to(route("bienvenida"));
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
