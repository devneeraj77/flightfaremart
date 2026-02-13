<div id="preloader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-base-100  transition-opacity duration-500 ease-out">
    <div class="relative flex items-center justify-center w-20 h-20 mb-4">
        <div class="absolute inset-0 border-4 border-base-300/30 rounded-full"></div>
        <div class="absolute inset-0 border-4 border-accent border-t-transparent rounded-full animate-spin"></div>
        <svg class="w-8 h-8 text-accent transform -rotate-45" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
        </svg>
    </div>
    <span class="text-accent font-bold tracking-[0.2em] text-sm animate-pulse">LOADING...</span>
</div>

<script>
  window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    preloader.classList.add('opacity-0', 'pointer-events-none');
    setTimeout(() => {
        preloader.style.display = 'none';
    }, 500);
  });
</script>