<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended();
    }
}; ?>
<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form wire:submit="login" class="theme-form">
                  <h4>Sign in to account</h4>
                  <p>Enter your email & password to login</p>
                  <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="form.email" id="email" class="form-control" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                  </div>
                  <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="form-input position-relative">
                      <x-text-input wire:model="form.password" id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                      <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                      <div class="show-hide"><span class="show"></span></div>
                    </div>   
                   </div>
                   <div class="form-group mb-0">
                    <div class="checkbox p-0">
                    <input wire:model="form.remember" id="remember" type="checkbox" name="remember">
                    <label for="remember" class="text-muted"> {{ __('Remember me') }} </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="link" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <div class="text-end mt-3">
                    <x-primary-button>
                        {{ __('Log in') }}
                    </x-primary-button>
                    </div>
                  </div>
                </form>
</div>