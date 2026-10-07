const scrollTracker = document.querySelector('.scroll-tracker');


function updateScrollProgress() {
  
    const scrollTop = window.scrollY;
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const progress = maxScroll > 0 ? (scrollTop / maxScroll) * 100 : 0;

    if (scrollTracker) {
        scrollTracker.style.width = `${progress}%`;
    }
}

window.addEventListener('scroll', updateScrollProgress, { passive: true });
window.addEventListener('load', updateScrollProgress);
window.addEventListener('resize', updateScrollProgress);
