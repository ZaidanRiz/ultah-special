document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const letterClosed = document.getElementById('letter-closed');
    const openCard = document.getElementById('open-card');
    const musicBtn = document.getElementById('music-btn');
    const confettiBtn = document.getElementById('confetti-btn');
    const messageBtn = document.getElementById('message-btn');
    const birthdaySong = document.getElementById('birthday-song');
    const cakeContainer = document.getElementById('cake-container');
    const cake = document.getElementById('cake');
    const messagePopup = document.getElementById('message-popup');
    const closeBtn = document.querySelector('.close-btn');
    const successPopup = document.getElementById('success-popup');
    const closeSuccessBtn = document.querySelector('.close-success-btn');
    
    // Variables
    let musicPlaying = false;
    
    // Open letter
    letterClosed.addEventListener('click', function() {
        letterClosed.style.transform = 'perspective(1000px) rotateX(60deg)';
        letterClosed.style.opacity = '0';
        
        setTimeout(() => {
            letterClosed.style.display = 'none';
            openCard.style.display = 'block';
            createConfetti(30);
        }, 800);
    });
    
    // Music control
    musicBtn.addEventListener('click', function() {
        if (musicPlaying) {
            birthdaySong.pause();
            musicBtn.innerHTML = '🎵 Putar Musik';
        } else {
            birthdaySong.play();
            musicBtn.innerHTML = '⏸️ Jeda Musik';
        }
        musicPlaying = !musicPlaying;
    });
    
    // Confetti - FIXED VERSION
    confettiBtn.addEventListener('click', function() {
        createConfetti(100);
    });
    
    // Cake cutting
    cakeContainer.addEventListener('click', function() {
        cake.src = "assets/images/cake-sliced.png";
        cake.style.transform = "rotate(5deg)";
        document.getElementById('candle').style.display = "none";
        document.getElementById('flame').style.display = "none";
        createConfetti(20);
    });
    
    // Message popup
    messageBtn.addEventListener('click', function() {
        messagePopup.style.display = 'flex';
    });
    
    closeBtn.addEventListener('click', function() {
        messagePopup.style.display = 'none';
    });
    
    if (closeSuccessBtn) {
        closeSuccessBtn.addEventListener('click', function() {
            successPopup.style.display = 'none';
        });
    }
    
    // Close popup when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === messagePopup) {
            messagePopup.style.display = 'none';
        }
        if (successPopup && event.target === successPopup) {
            successPopup.style.display = 'none';
        }
    });
    


function createConfetti(count) {
    // Clear existing confetti first
    document.querySelectorAll('.confetti').forEach(el => el.remove());
    
    for (let i = 0; i < count; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        
        // Random properties
        const colors = ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5'];
        const shapes = ['circle', 'square', 'triangle'];
        const randomColor = colors[Math.floor(Math.random() * colors.length)];
        const randomShape = shapes[Math.floor(Math.random() * shapes.length)];
        
        // Set styles - start higher up
        confetti.style.backgroundColor = randomColor;
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.top = -50 + 'px'; // Start above the visible area
        confetti.style.width = Math.random() * 12 + 8 + 'px';
        confetti.style.height = confetti.style.width;
        confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
        confetti.style.opacity = Math.random() * 0.5 + 0.5;
        confetti.style.position = 'fixed';
        confetti.style.zIndex = '9999';
        
        // Shape variations
        if (randomShape === 'square') {
            confetti.style.borderRadius = '2px';
        } else if (randomShape === 'triangle') {
            confetti.style.clipPath = 'polygon(50% 0%, 0% 100%, 100% 100%)';
            confetti.style.height = '0';
            confetti.style.borderLeft = confetti.style.width + ' solid transparent';
            confetti.style.borderRight = confetti.style.width + ' solid transparent';
            confetti.style.borderBottom = confetti.style.width + ' solid ' + randomColor;
            confetti.style.backgroundColor = 'transparent';
        }
        
        document.body.appendChild(confetti);
        
        // Remove after animation
        setTimeout(() => {
            if (confetti.parentNode) {
                confetti.parentNode.removeChild(confetti);
            }
        }, 5000);
    }
}
});