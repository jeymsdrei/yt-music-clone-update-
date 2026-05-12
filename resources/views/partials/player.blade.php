<div id="player-bar" class="fixed bottom-0 left-0 right-0 z-50 h-20 bg-[#0f0f0f]/95 backdrop-blur-2xl border-t border-white/5" x-data="player()">
    <div class="flex items-center h-full px-4 gap-4">
        <div class="flex items-center w-56 gap-3 min-w-0">
            <div id="player-thumbnail" class="flex-shrink-0 w-12 h-12 rounded-lg bg-white/5 overflow-hidden">
                <img src="" alt="" class="object-cover w-full h-full hidden" id="player-thumbnail-img">
                <div class="flex items-center justify-center w-full h-full text-white/20" id="player-thumbnail-placeholder">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55C7.79 13 6 14.79 6 17s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                    </svg>
                </div>
            </div>
            <div class="min-w-0">
                <p id="player-title" class="text-sm font-medium text-white truncate">No track selected</p>
                <p id="player-artist" class="text-xs text-white/40 truncate">Select a song to play</p>
            </div>
        </div>

        <div class="flex flex-col items-center flex-1 gap-1 max-w-2xl mx-auto">
            <div class="flex items-center gap-4">
                <button class="player-btn" data-action="shuffle" title="Shuffle">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 17h16l-4-4m0 0l4 4m-4-4l4-4M4 7h16l-4 4m0 0l4-4"/>
                    </svg>
                </button>
                <button class="player-btn" data-action="prev" title="Previous">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
                    </svg>
                </button>
                <button id="player-play-btn" class="flex items-center justify-center w-10 h-10 rounded-full bg-white text-black hover:scale-105 transition-transform" data-action="play-pause" title="Play">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" id="play-icon">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                    <svg class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 24 24" id="pause-icon">
                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                    </svg>
                </button>
                <button class="player-btn" data-action="next" title="Next">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                    </svg>
                </button>
                <button class="player-btn" data-action="repeat" title="Repeat">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </button>
            </div>
            <div class="flex items-center w-full gap-2">
                <span id="player-current-time" class="text-xs text-white/40 w-8 text-right tabular-nums">0:00</span>
                <div class="relative flex-1 h-1 group cursor-pointer" id="player-progress-bar">
                    <div class="absolute inset-0 rounded-full bg-white/10"></div>
                    <div id="player-progress-fill" class="absolute inset-y-0 left-0 rounded-full bg-white group-hover:bg-red-500 transition-colors w-0"></div>
                    <div id="player-progress-thumb" class="absolute top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-white opacity-0 group-hover:opacity-100 transition-opacity -ml-1.5" style="left: 0%;"></div>
                </div>
                <span id="player-duration" class="text-xs text-white/40 w-8 tabular-nums">0:00</span>
            </div>
        </div>

        <div class="flex items-center justify-end w-56 gap-3">
            <button class="player-btn hidden sm:block" data-action="queue" title="Queue">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
            </button>
            <div class="items-center hidden gap-2 md:flex">
                <button class="player-btn" data-action="mute" title="Mute">
                    <svg class="w-4 h-4" id="volume-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z"/>
                    </svg>
                </button>
                <div class="relative w-24 h-1 group cursor-pointer" id="player-volume-bar">
                    <div class="absolute inset-0 rounded-full bg-white/10"></div>
                    <div id="player-volume-fill" class="absolute inset-y-0 left-0 rounded-full bg-white w-full"></div>
                    <div id="player-volume-thumb" class="absolute top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-white opacity-0 group-hover:opacity-100 transition-opacity -ml-1.5" style="left: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <audio id="audio-player" preload="metadata"></audio>
</div>
