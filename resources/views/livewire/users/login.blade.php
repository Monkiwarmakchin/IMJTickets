<div>
    @if( $role == "user" )
        <x-form submit="userLogin" button="Revisa tus tickets">

            {{-- Correo --}}
            <x-form.input
                legend="Ingresa tu correo institucional" 
                model="uForm.correo"
                type="text"
            />

        </x-form>
    @elseif( $role == "admin" )
        <x-form submit="adminLogin" button="Iniciar sesion">

            {{-- Correo --}}
            <x-form.input
                legend="Ingresa tu correo institucional" 
                model="aForm.correo"
                type="text"
            />

            {{-- Cortraseña --}}
            <x-form.input 
                legend="Ingresa tu contraseña" 
                model="aForm.contrasenia"
                type="password"
            />

        </x-form>
    @endif
</div>