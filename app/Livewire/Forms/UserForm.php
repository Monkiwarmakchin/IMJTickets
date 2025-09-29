<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserForm extends EmailForm
{
    public $contrasenia;

    public function rules()
    {
        return [
            'correo' => array_merge(parent::rules()['correo'], ['exists:users,email']),
            'contrasenia' => ['required' /*Añadir validacion de si la constraseña pertenece al usuario*/]
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'correo.exists' => 'El correo ingresado no corresponde a ningún administrador',
            'contrasenia.required' => 'No se ha ingresado ninguna contraseña'
        ]);
    }

    public function adminValidation()
    {
        $this->validate();

        $user = User::where('email', $this->correo)->first();

        // Contraseña hasheada
        if (!Hash::check($this->contrasenia, $user->password)) {
            $this->addError('contrasenia', 'La contraseña ingresada no es la correcta');
            return false;
        }

        // Contraseña no hasheada
        /*if ($this->contrasenia != $user->password) {
            $this->addError('contrasenia', 'La contraseña ingresada es incorrecta');
            return false;
        }*/
            
        return $user;
    }
}
