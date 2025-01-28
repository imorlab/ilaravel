<nav class="notch-nav">
    <div class="nav-content">
        <div class="notch-container">
            <!-- Left Menu Items -->
            <div class="nav-group left-menu">
                <a href="/sending" class="nav-item" data-side="left">
                    <i class="bi bi-envelope"></i>
                    <span class="nav-text">Envíos</span>
                </a>
                <a href="/cerberus" class="nav-item" data-side="right">
                    <i class="bi bi-speedometer2"></i>
                    <span class="nav-text">Cerberus</span>
                </a>
            </div>

            <!-- Home Icon -->
            <a href="/" class="home-link">
                <img src="{{ asset('/img/laravel_96.png') }}" class="home-icon" alt="">
            </a>

            <!-- Right Menu Items -->
            <div class="nav-group right-menu">
                <a href="/pro360-newsletter" class="nav-item" data-side="right">
                    <i class="bi bi-newspaper"></i>
                    <span class="nav-text">PRO360</span>
                </a>
                <a href="/todo" class="nav-item" data-side="left">
                    <i class="bi bi-check2-square"></i>
                    <span class="nav-text">Todo</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
/* Variables */
:root {
    --nav-height: 20px;
    --notch-height: 35px;
    --notch-expanded-width: 270px;
    --notch-collapsed-width: 50px;
    --primary-color: rgba(25, 25, 25, 1);
    --secondary-color: rgba(40, 40, 40, 0.95);
    --text-color: #fff;
    --animation-speed: 1s;
}

/* Base styles */
.notch-nav {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: var(--nav-height);
    z-index: 1000;
    /* backdrop-filter: blur(10px); */
    background-color: var(--primary-color);
}

.nav-content {
    position: relative;
    height: 50px;
    width: var(--notch-collapsed-width);
    margin: 0 auto;
    transition: width var(--animation-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
    background-color: var(--primary-color);
    border-radius: 0 0 15px 15px;
    overflow: visible;
}

.notch-container {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 1rem;
    height: 100%;
    width: var(--notch-expanded-width);
    transform: translateX(calc((var(--notch-collapsed-width) - var(--notch-expanded-width)) / 2));
    transition: transform var(--animation-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
}

.nav-content:hover {
    width: var(--notch-expanded-width);
    background-color: var(--primary-color);
}

.nav-content:hover .notch-container {
    transform: translateX(0);
}

.nav-group {
    display: flex;
    gap: 2rem;
    align-items: center;
    opacity: 0;
    visibility: hidden;
    transition: all var(--animation-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
    transform: translateY(-20px);
    position: relative;
    z-index: 3;
}

.nav-content:hover .nav-group {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.nav-item {
    position: relative;
    color: var(--text-color);
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all var(--animation-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
    transform: translateY(-20px);
    opacity: 0;
    z-index: 3;
    top: 3px;
}

.nav-content:hover .nav-item {
    transform: translateY(0);
    opacity: 1;
    transition-delay: calc(var(--delay, 0) * 0.1s);
}

.left-menu .nav-item:nth-child(1) { --delay: 1; }
.left-menu .nav-item:nth-child(2) { --delay: 2; }
.right-menu .nav-item:nth-child(1) { --delay: 2; }
.right-menu .nav-item:nth-child(2) { --delay: 1; }

.nav-item i {
    font-size: 1.2rem;
    position: relative;
    z-index: 3;
}

.nav-text {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(5px);
    padding-top: 0.5rem;
    opacity: 0;
    transition: all var(--animation-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
    white-space: nowrap;
    color: var(--text-color);
    font-size: 0.85rem;
    pointer-events: none;
    z-index: 5;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.nav-item:hover .nav-text {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
}

/* Home icon styles */
.home-link {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 15px;
    z-index: 10;
}

.home-icon {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-color);
    transition: all var(--animation-speed) cubic-bezier(0.34, 1.56, 0.64, 1);
}

.home-icon:hover {
    transform: scale(1.1);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    :root {
        --notch-expanded-width: 280px;
        --notch-collapsed-width: 60px;
    }

    .nav-group {
        gap: 1rem;
    }
    
    .nav-item i {
        font-size: 1rem;
    }
    
    .nav-text {
        font-size: 0.8rem;
    }

    .home-icon {
        width: 25px;
        height: 25px;
    }
}
</style>