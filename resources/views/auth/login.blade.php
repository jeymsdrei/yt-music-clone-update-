@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-12">
    <div class="w-full max-w-md">
        <div class="glass-card p-8 lg:p-10">
            <div class="mb-8 text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-red-500 to-red-700">
                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold">Welcome back</h1>
                <p class="mt-1 text-white/60">Sign in to continue</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block mb-1.5 text-sm font-medium text-white/80">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="input-field @error('email') border-red-500 @enderror" placeholder="your@email.com" required autofocus autocomplete="username">
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-1.5 text-sm font-medium text-white/80">Password</label>
                    <input type="password" name="password" id="password" class="input-field @error('password') border-red-500 @enderror" placeholder="••••••••" required autocomplete="current-password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 text-red-500 focus:ring-red-500 focus:ring-offset-0">
                        <span class="text-sm text-white/60">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="#" class="text-sm text-white/30 cursor-not-allowed">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="w-full btn-primary justify-center">
                    Sign In
                </button>
            </form>

            <p class="mt-6 text-sm text-center text-white/40">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-red-500 hover:text-red-400 transition-colors font-medium">Register</a>
            </p>
        </div>
    </div>
</div>
@endsection
