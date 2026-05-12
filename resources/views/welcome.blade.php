@extends('layouts.guest')

@section('title', 'Welcome')

@section('content')
<div class="min-h-screen">
    {{-- Hero --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#ff0000]/20 via-[#0a0a0a] to-[#0a0a0a]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#ff0000]/10 via-transparent to-transparent"></div>
        <div class="absolute top-40 -left-40 w-96 h-96 bg-[#ff0000]/20 rounded-full blur-[128px]"></div>
        <div class="absolute top-60 right-20 w-80 h-80 bg-[#ff4444]/10 rounded-full blur-[96px]"></div>

        <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass text-sm text-white/60 mb-8">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                Unlimited Music Streaming
            </div>
            <h1 class="text-6xl md:text-8xl font-extrabold mb-6 tracking-tight">
                <span class="text-gradient">Melody</span>
                <span class="text-white">Stream</span>
            </h1>
            <p class="text-lg md:text-xl text-white/60 max-w-2xl mx-auto mb-10 leading-relaxed">
                Discover, stream, and curate your perfect soundtrack. Millions of songs, zero limits.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('home') }}" class="btn-primary text-base px-10 py-3 shadow-lg shadow-red-500/25">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary text-base px-10 py-3 shadow-lg shadow-red-500/25">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h16m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h9a3 3 0 013 3v1"/></svg>
                            Get Started Free
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-ghost text-base px-10 py-3 border border-white/10 hover:border-white/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            Create Account
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-24 px-6 relative">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">Everything You Need</h2>
                <p class="text-white/40 text-lg max-w-2xl mx-auto">Built for music lovers who demand more from their streaming experience.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card rounded-2xl p-8 text-center group hover:border-red-500/20 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-red-500/10 flex items-center justify-center mx-auto mb-5 group-hover:bg-red-500/20 transition-colors">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Infinite Music</h3>
                    <p class="text-white/40 text-sm leading-relaxed">Access millions of songs, albums, and artists from around the world.</p>
                </div>
                <div class="glass-card rounded-2xl p-8 text-center group hover:border-red-500/20 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-red-500/10 flex items-center justify-center mx-auto mb-5 group-hover:bg-red-500/20 transition-colors">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Smart Recommendations</h3>
                    <p class="text-white/40 text-sm leading-relaxed">AI-powered suggestions that learn your taste and find your next favorite.</p>
                </div>
                <div class="glass-card rounded-2xl p-8 text-center group hover:border-red-500/20 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-red-500/10 flex items-center justify-center mx-auto mb-5 group-hover:bg-red-500/20 transition-colors">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Create Playlists</h3>
                    <p class="text-white/40 text-sm leading-relaxed">Build and share the perfect playlists for every mood and moment.</p>
                </div>
                <div class="glass-card rounded-2xl p-8 text-center group hover:border-red-500/20 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-red-500/10 flex items-center justify-center mx-auto mb-5 group-hover:bg-red-500/20 transition-colors">
                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Offline Mode</h3>
                    <p class="text-white/40 text-sm leading-relaxed">Download your music and take it anywhere, no connection needed.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-24 px-6 relative">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">How It Works</h2>
                <p class="text-white/40 text-lg">Get started in three simple steps.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5">
                        <span class="text-2xl font-bold text-red-500">1</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Create Your Account</h3>
                    <p class="text-white/40 text-sm">Sign up free and set up your profile in seconds.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5">
                        <span class="text-2xl font-bold text-red-500">2</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Pick Your Favorites</h3>
                    <p class="text-white/40 text-sm">Choose artists and genres to personalize your feed.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center mx-auto mb-5">
                        <span class="text-2xl font-bold text-red-500">3</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Start Listening</h3>
                    <p class="text-white/40 text-sm">Stream millions of songs, create playlists, discover new music.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-24 px-6 relative">
        <div class="max-w-3xl mx-auto text-center glass-card rounded-3xl p-12 md:p-16">
            <h2 class="text-3xl md:text-5xl font-bold mb-4">Ready to Listen?</h2>
            <p class="text-white/40 text-lg mb-8">Join millions of music lovers on MelodyStream today.</p>
            @auth
                <a href="{{ route('home') }}" class="btn-primary text-base px-10 py-3 shadow-lg shadow-red-500/25">Start Listening</a>
            @else
                <a href="{{ route('register') }}" class="btn-primary text-base px-10 py-3 shadow-lg shadow-red-500/25">Get Started Free</a>
            @endauth
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-white/5 py-12 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                    </div>
                    <span class="font-bold">MelodyStream</span>
                </div>
                <p class="text-white/30 text-xs">Copyright &copy; {{ date('Y') }}. All rights reserved.</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold mb-3">Company</h4>
                <ul class="space-y-2 text-sm text-white/40">
                    <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Press</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold mb-3">Support</h4>
                <ul class="space-y-2 text-sm text-white/40">
                    <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold mb-3">Legal</h4>
                <ul class="space-y-2 text-sm text-white/40">
                    <li><a href="#" class="hover:text-white transition-colors">Terms</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Cookies</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>
@endsection
