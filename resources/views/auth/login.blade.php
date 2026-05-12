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
                <p class="mt-1 text-white/60">Sign in to continue to MusicApp</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block mb-1.5 text-sm font-medium text-white/80">Email</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="input-field pl-10 @error('email') border-red-500 @enderror" placeholder="your@email.com" required autofocus autocomplete="username">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block mb-1.5 text-sm font-medium text-white/80">Password</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input type="password" name="password" id="password" class="input-field pl-10 @error('password') border-red-500 @enderror" placeholder="••••••••" required autocomplete="current-password">
                    </div>
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

                <button type="submit" class="w-full btn-primary">
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
