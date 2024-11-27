document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.custom-card');
    
    cards.forEach(card => {
        // Asegurarse de que existe el elemento shine
        if (!card.querySelector('.shine')) {
            const shine = document.createElement('div');
            shine.className = 'shine';
            card.appendChild(shine);
        }
        
        card.addEventListener('mousemove', handleMouseMove);
        card.addEventListener('mouseleave', handleMouseLeave);
    });

    function handleMouseMove(e) {
        const card = e.currentTarget;
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        
        const rotateX = (y - centerY) / 20;
        const rotateY = -(x - centerX) / 20;
        
        card.style.transform = `
            perspective(1000px) 
            rotateX(${rotateX}deg) 
            rotateY(${rotateY}deg) 
            translateZ(10px)
        `;
        
        const shine = card.querySelector('.shine');
        if (shine) {
            const moveX = (x / rect.width) * 100;
            const moveY = (y / rect.height) * 100;
            shine.style.background = `
                radial-gradient(
                    circle at ${moveX}% ${moveY}%, 
                    rgba(255,255,255,0.25) 0%, 
                    rgba(255,255,255,0) 60%
                )
            `;
            shine.style.opacity = '1';
        }
    }

    function handleMouseLeave(e) {
        const card = e.currentTarget;
        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
        
        const shine = card.querySelector('.shine');
        if (shine) {
            shine.style.opacity = '0';
        }
    }
});
