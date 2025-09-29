<?php

namespace App\Livewire\Tickets;

use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Ticket;

class TicketIndex extends Component
{
    use WithPagination;

    public $numEstados;

    public function ticketProgress($Id)
    {
        $ticket = Ticket::find($Id);
        if ($ticket && $ticket->estado < 3) { // asumimos que 3 = Cerrado
            $ticket->increment('estado'); // incrementa 1 automáticamente en la BD
            $ticket->refresh(); // refresca los datos del modelo
        }

        // Actualizamos la colección para que la tabla se refresque
        $this->tickets = Ticket::all();
    }
    
    public function mount()
    {
        if(request()->routeIs('tickets.user') && !request("user"))
        {
            return redirect()->to(route("bienvenida"));
        }

        $this->numEstados = count(Ticket::ESTADOS);
    }

    public function render()
    {

        if (Auth::check())  {
            return view('livewire.tickets.ticket-index', [
                'tickets' => Ticket::latest()->paginate(10),
            ]);
        } elseif (request("user")) {
            return view('livewire.tickets.ticket-index', [
                'tickets' => Ticket::where('correo', request("user"))->latest()->paginate(10),
            ]);
        }
    }
}
