<div x-data="{ show: false, message: '', type: 'success' }" x-init="$wire?.on?.('toast', ({ detail }) => { show = true; message = detail.message; type = detail.type; setTimeout(() => show = false, 3000) }) || window.addEventListener('toast', (e) => { show = true; message = e.detail.message; type = e.detail.type; setTimeout(() => show = false, 3000) })" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" class="fixed top-4 right-4 z-[100] max-w-sm w-full pointer-events-none" style="display: none;">
    <div class="flex items-center gap-3 p-4 rounded-xl shadow-2xl pointer-events-auto backdrop-blur-xl" :class="type === 'success' ? 'bg-green-500/10 border border-green-500/20' : 'bg-red-500/10 border border-red-500/20'">
        <div :class="type === 'success' ? 'text-green-400' : 'text-red-400'">
            <template x-if="type === 'success'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </template>
            <template x-if="type === 'error'">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </template>
        </div>
        <p class="text-sm font-medium text-white" x-text="message"></p>
        <button class="ml-auto text-white/40 hover:text-white transition-colors" @click="show = false">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>

@if(session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" class="fixed top-4 right-4 z-[100] max-w-sm w-full pointer-events-none">
        <div class="flex items-center gap-3 p-4 rounded-xl shadow-2xl pointer-events-auto backdrop-blur-xl bg-green-500/10 border border-green-500/20">
            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium text-white">{{ session('success') }}</p>
            <button class="ml-auto text-white/40 hover:text-white transition-colors flex-shrink-0" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0" class="fixed top-4 right-4 z-[100] max-w-sm w-full pointer-events-none">
        <div class="flex items-center gap-3 p-4 rounded-xl shadow-2xl pointer-events-auto backdrop-blur-xl bg-red-500/10 border border-red-500/20">
            <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-medium text-white">{{ session('error') }}</p>
            <button class="ml-auto text-white/40 hover:text-white transition-colors flex-shrink-0" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif
