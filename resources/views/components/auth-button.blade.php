@if (Route::has('login'))
    @auth
        <div class="user-menu">
            <button class="user-name" onclick="toggleUserMenu()">
                <i class="fas fa-user"></i>
                <span>{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-up menu-arrow"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="btn-login">
            <i class="fas fa-sign-in-alt"></i><span>Accede</span>
        </a>
    @endauth
@endif

@push('scripts')
<script>
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    const button = document.querySelector('.user-name');
    if (dropdown && button) {
        dropdown.classList.toggle('show');
        button.classList.toggle('active');
    }
}

// Cerrar el menú al hacer clic fuera
window.addEventListener('click', function(e) {
    if (!e.target.closest('.user-menu')) {
        const dropdown = document.getElementById('userDropdown');
        const button = document.querySelector('.user-name');
        if (dropdown && button && dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
            button.classList.remove('active');
        }
    }
});
</script>
@endpush
