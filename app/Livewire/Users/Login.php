<?php

namespace App\Livewire\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\EmailForm;
use App\Livewire\Forms\UserForm;
use Livewire\Component;


class Login extends Component
{
    public $role;
    public EmailForm $uForm;
    public UserForm $aForm;
    public function userLogin()
    {
        //Validamos el correo mediante userVaidation () en EmailForm
        if($this->uForm->userValidation())
        {
            // Redireccion full reload
            return redirect()->to(route("tickets.user", ['user' => $this->uForm->correo]));

            // Redireccion livewire (en teoria)
            // return $this->redirect(route("tickets.index", ['user' => $this->form->correo]), navigate: true);
        }
    }

    public function adminLogin(Request $request)
    {
        //Validamos el correo mediante adminValidation() en UserForm
        $user = $this->aForm->adminValidation();

        if($user)
        {
            Auth::login($user);
            $request->session()->regenerate();

            // Redireccion full reload
            return redirect()->to(route("tickets.index"));

            // Redireccion livewire
            // return $this->redirect(route("tickets.index"), navigate: true);
        }
    }

    public function mount(){

        // Verificamos el rol con el que se ha ingresado a la pagina
        $this->role = request('role');

    }

    public function render()
    {
        return view('livewire.users.login');
    }
}
