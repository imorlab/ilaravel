<nav class="notch-nav">
    <div class="nav-content">
        <div class="notch-container">
            <!-- Left Menu Items -->
            <div class="nav-group left-menu">
                <a href="/sending" class="nav-item" data-side="left">
                    <i class="bi bi-envelope"></i>
                    <span class="nav-text">Envíos</span>
                </a>
                <a href="/todo" class="nav-item" data-side="left">
                    <i class="bi bi-check2-square"></i>
                    <span class="nav-text">Todo</span>
                </a>
            </div>

            <!-- Notch SVG -->
            <svg class="notch-svg" viewBox="0 0 300 60" preserveAspectRatio="none">
                <path class="notch-path" d="M 150,0 C 150,0 140,0 140,10 C 140,20 160,20 160,10 C 160,0 150,0 150,0" />
            </svg>

            <!-- Home Icon -->
            <a href="/" class="home-link">
                <div class="home-icon">
                    <i class="bi bi-house-heart"></i>
                </div>
            </a>

            <!-- Right Menu Items -->
            <div class="nav-group right-menu">
                <a href="/notes" class="nav-item" data-side="right">
                    <i class="bi bi-journal-text"></i>
                    <span class="nav-text">Notas</span>
                </a>
                <a href="/dashboard" class="nav-item" data-side="right">
                    <i class="bi bi-speedometer2"></i>
                    <span class="nav-text">Panel</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Variables */
:root {
    --nav-height: 20px;
    --notch-height: 60px;
    --notch-expanded-width: 300px;
    --primary-color: #7c3aed;
    --secondary-color: #4f46e5;
    --text-color: #fff;
    --animation-speed: 0.4s;
    --cubic-bezier: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Navigation Bar */
.notch-nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: var(--nav-height);
    z-index: 1000;
    background: var(--primary-color);
    display: flex;
    justify-content: center;
    align-items: center;
}

.nav-content {
    position: relative;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.nav-group {
    display: flex;
    align-items: center;
    gap: 2rem;
    opacity: 0;
    pointer-events: none;
    transform: translateY(10px);
    transition: opacity var(--animation-speed) var(--cubic-bezier),
                transform var(--animation-speed) var(--cubic-bezier);
}

.nav-group.left-menu {
    position: absolute;
    left: 20%;
}

.nav-group.right-menu {
    position: absolute;
    right: 20%;
}

.nav-item {
    color: var(--text-color);
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    transition: opacity var(--animation-speed) var(--cubic-bezier);
    opacity: 0.7;
}

.nav-item:hover {
    opacity: 1;
}

.nav-item i {
    font-size: 1.5rem;
}

.nav-item .nav-text {
    font-size: 0.9rem;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity var(--animation-speed) var(--cubic-bezier),
                transform var(--animation-speed) var(--cubic-bezier);
}

.nav-item:hover .nav-text {
    opacity: 1;
    transform: translateY(0);
}

.notch-container {
    position: relative;
    height: var(--notch-height);
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}

.notch-svg {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: var(--notch-height);
    width: 60px;
    transition: all var(--animation-speed) var(--cubic-bezier);
}

.notch-path {
    fill: var(--primary-color);
    transition: d var(--animation-speed) var(--cubic-bezier);
}

.home-link {
    position: relative;
    z-index: 2;
    width: 50px;
    height: 50px;
    margin-top: 10px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--text-color);
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.home-link:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.home-icon {
    font-size: 1.5rem;
}

/* Hover Effects */
.notch-container:hover .nav-group {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}

.notch-container:hover .notch-svg {
    width: var(--notch-expanded-width);
}

.notch-container:hover .notch-path {
    d: path("M 0,0 C 0,0 120,0 150,0 C 180,0 300,0 300,0 C 300,0 300,60 150,60 C 0,60 0,0 0,0");
}

/* Responsive */
@media (max-width: 768px) {
    .nav-group {
        gap: 1rem;
    }

    .nav-item i {
        font-size: 1.2rem;
    }

    .nav-item .nav-text {
        font-size: 0.8rem;
    }

    .home-link {
        width: 40px;
        height: 40px;
    }

    .home-icon {
        font-size: 1.2rem;
    }
}
</style>
