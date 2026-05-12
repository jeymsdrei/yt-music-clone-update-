class Player {
    constructor(audio) {
        this.audio = audio;
        this.queue = [];
        this.currentIndex = -1;
        this.isPlaying = false;
        this.isShuffled = false;
        this.repeatMode = 'none';
        
        this.init();
    }
    
    init() {
        this.audio.addEventListener('timeupdate', () => this.updateProgress());
        this.audio.addEventListener('ended', () => this.next());
        this.audio.addEventListener('loadedmetadata', () => this.updateDuration());
    }
    
    play() {
        this.audio.play();
        this.isPlaying = true;
        this.updatePlayButton();
    }
    
    pause() {
        this.audio.pause();
        this.isPlaying = false;
        this.updatePlayButton();
    }
    
    togglePlay() {
        this.isPlaying ? this.pause() : this.play();
    }
    
    loadSong(song) {
        this.audio.src = song.file_path;
        this.audio.load();
        this.play();
        this.updateSongInfo(song);
    }
    
    playSong(song, queue = null) {
        if (queue) {
            this.queue = queue;
            this.currentIndex = queue.findIndex(s => s.id === song.id);
        }
        this.loadSong(song);
    }
    
    playPlaylist(songs, index = 0) {
        this.queue = songs;
        this.currentIndex = index;
        if (songs.length > 0) this.loadSong(songs[index]);
    }
    
    next() {
        if (this.queue.length === 0) return;
        if (this.repeatMode === 'one') {
            this.audio.currentTime = 0;
            this.play();
            return;
        }
        let nextIndex;
        if (this.isShuffled) {
            nextIndex = Math.floor(Math.random() * this.queue.length);
        } else {
            nextIndex = this.currentIndex + 1;
        }
        if (nextIndex >= this.queue.length) {
            if (this.repeatMode === 'all') {
                nextIndex = 0;
            } else {
                return;
            }
        }
        this.currentIndex = nextIndex;
        this.loadSong(this.queue[nextIndex]);
    }
    
    previous() {
        if (this.queue.length === 0) return;
        if (this.audio.currentTime > 3) {
            this.audio.currentTime = 0;
            return;
        }
        let prevIndex = this.currentIndex - 1;
        if (prevIndex < 0) prevIndex = this.queue.length - 1;
        this.currentIndex = prevIndex;
        this.loadSong(this.queue[prevIndex]);
    }
    
    seek(time) {
        this.audio.currentTime = time;
    }
    
    setVolume(volume) {
        this.audio.volume = volume / 100;
    }
    
    toggleShuffle() {
        this.isShuffled = !this.isShuffled;
    }
    
    toggleRepeat() {
        const modes = ['none', 'one', 'all'];
        const currentIndex = modes.indexOf(this.repeatMode);
        this.repeatMode = modes[(currentIndex + 1) % modes.length];
    }
    
    updateProgress() {
        const progress = document.getElementById('progress-bar');
        const currentTime = document.getElementById('current-time');
        if (progress && this.audio.duration) {
            progress.value = (this.audio.currentTime / this.audio.duration) * 100;
        }
        if (currentTime) {
            currentTime.textContent = this.formatTime(this.audio.currentTime);
        }
    }
    
    updateDuration() {
        const duration = document.getElementById('total-time');
        if (duration) {
            duration.textContent = this.formatTime(this.audio.duration);
        }
    }
    
    updatePlayButton() {
        const btns = document.querySelectorAll('.play-btn');
        btns.forEach(btn => {
            btn.innerHTML = this.isPlaying 
                ? '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>'
                : '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"/></svg>';
        });
    }
    
    updateSongInfo(song) {
        const title = document.getElementById('player-title');
        const artist = document.getElementById('player-artist');
        const cover = document.getElementById('player-cover');
        if (title) title.textContent = song.title;
        if (artist) artist.textContent = song.artist?.name || '';
        if (cover) cover.src = song.cover_image || '/images/default-song.png';
        
        const miniTitle = document.getElementById('mini-player-title');
        const miniArtist = document.getElementById('mini-player-artist');
        if (miniTitle) miniTitle.textContent = song.title;
        if (miniArtist) miniArtist.textContent = song.artist?.name || '';
    }
    
    formatTime(seconds) {
        if (isNaN(seconds)) return '0:00';
        const m = Math.floor(seconds / 60);
        const s = Math.floor(seconds % 60);
        return `${m}:${s.toString().padStart(2, '0')}`;
    }
    
    addToQueue(song) {
        this.queue.push(song);
        if (this.currentIndex === -1) {
            this.currentIndex = 0;
            this.loadSong(song);
        }
    }
    
    clearQueue() {
        this.queue = [];
        this.currentIndex = -1;
        this.audio.pause();
        this.isPlaying = false;
    }
}

export default Player;
