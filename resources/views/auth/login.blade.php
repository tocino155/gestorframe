<x-guest-layout>

    <x-jet-authentication-card>

        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
    <div class="container-fluid fixed-top p-4" style="background: black;">
        <div class="col-12" >
            <div class="d-flex justify-content-end">
                @if (Route::has('login'))
                    <div class="">
                        @auth
                            <a href="{{ url('/dashboard') }}"class="btn btn-outline-light" style="font-weight: bold; font-size: 18px;">SESION INICIADA</a>
                        @else
                        <!--
                            <a href="{{ route('login') }}" class="btn btn-outline-danger" style="font-weight: bold; font-size: 18px;">INGRESAR</a>
                        -->    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-danger" style="font-weight: bold; font-size: 18px;">REGISTRARSE</a>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

        <div class="card-body" style="color: #9B0000; font-weight: bold; background-color: #9E9D9D; margin-left: -10px; margin-right: -10px; border-radius: 15px;">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-jet-label value="{{ __('USUARIO') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('CONTRASEÑA') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('RECORDAR CONTRASEÑA') }}
                        </label>
                    </div>
                </div>

                <div class="mb-0">
                    <div style="text-align: center;">
                        <!--
                        @if (Route::has('password.request'))
                            <a class="text-muted me-3" href="{{ route('password.request') }}">
                                {{ __('¿OLVIDASTE TU CONTRASEÑA?') }}
                            </a>
                        @endif
                    -->
                        <button class="btn btn-outline-dark" style="width: 50%; ">
                            {{ __('INGRESAR') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>