@if($showFooter)
<style>
.btn-circle {
    width: 35px;
    height: 35px;
    padding: 0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(8px);
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 193, 7, 0.2);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    color: #ffc107;
}

.btn-circle:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 8px 25px rgba(255, 193, 7, 0.25);
    background: rgba(255, 193, 7, 0.15);
    border-color: rgba(255, 193, 7, 0.4);
    color: #ffc107;
}

.btn-circle:active {
    transform: translateY(-2px) scale(0.95);
}

.btn-circle i {
    font-size: 1.2rem;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.footer-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}
</style>

<div class="fixed-bottom footer-container mb-2">
    <h5 class="text-center m-0 brand-text">#imorlab{{ date('Y') }}</h5>
    <a href="{{ route('home') }}" type="button" class="btn btn-circle">
        <i class="bi bi-house-door"></i>
    </a>
</div>
@endif
