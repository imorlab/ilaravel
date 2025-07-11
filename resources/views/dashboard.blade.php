@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row min-vh-100 align-items-center justify-content-center">
        <!-- Contenido Principal -->
        <div class="col-10">
            <div class="">
                <div class="text-center mb-4">
                    <img src="{{ asset('/img/laravel_96.png') }}" class="img-fluid ms-auto me-auto d-block mb-1">
                </div>
                <div class="card glass-card">
                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 text-light">iDashboard</h2>
                </div>
                    <div class="card-body glass-body">
                        <!-- Tarjetas de Resumen -->
                        <div class="row p-4">
                            <div class="col-md-3">
                                <div class="card glass-stat success">
                                    <div class="shine"></div>
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Newsletters</h5>
                                        <h2 class="card-text text-light">{{ App\Models\Newsletter::countThisMonth() }}</h2>
                                        <p class="mb-0 text-light-50"><small>Enviadas este mes</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card glass-stat">
                                    <div class="shine"></div>
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Tareas Pendientes</h5>
                                        <h2 class="card-text text-light">{{ App\Models\Todo::getPendingTasksCount() }}</h2>
                                        <p class="mb-0 text-light-50"><small>{{ App\Models\Todo::getPendingTasksForToday() }} para hoy</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card glass-stat">
                                    <div class="shine"></div>
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Tareas Completadas</h5>
                                        <h2 class="card-text text-light">{{ App\Models\Todo::getCompletedTasksThisWeek() }}</h2>
                                        <p class="mb-0 text-light-50"><small>Esta semana</small></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card glass-stat warning">
                                    <div class="shine"></div>
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Notas</h5>
                                        <h2 class="card-text text-light">{{ App\Models\Note::getActiveNotesCount() }}</h2>
                                        <p class="mb-0 text-light-50"><small>Total activas</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gráficos y Estadísticas -->
                        <div class="row p-4">
                            <div class="col-md-6">
                                <div class="card glass-card">
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Newsletters Enviadas</h5>
                                        <canvas id="newsletterChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card glass-card">
                                    <div class="card-body">
                                        <h5 class="card-title text-light">Progreso de Tareas</h5>
                                        <canvas id="taskChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos base para glassmorphism */
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-header {
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.glass-body {
    background: transparent;
}

/* Tarjetas de estadísticas */
.glass-stat {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.glass-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.glass-stat.success {
    background: rgba(40, 167, 69, 0.1);
    border-color: rgba(40, 167, 69, 0.2);
}

.glass-stat.warning {
    background: rgba(255, 193, 7, 0.1);
    border-color: rgba(255, 193, 7, 0.2);
}

/* Paneles de contenido */
.glass-panel {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
}

.glass-panel .card-header {
    background: rgba(255, 255, 255, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px 15px 0 0;
}

.glass-panel .card-body {
    padding: 1.25rem;
}

/* Lista de actividades */
.glass-list .glass-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.glass-list .glass-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
}

.glass-list .glass-item:last-child {
    margin-bottom: 0;
}

/* Utilidades de texto */
.text-light-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

.text-light-50 {
    color: rgba(255, 255, 255, 0.5) !important;
}

/* Estilos para el panel de productividad */
.glass-progress {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

.glass-progress .progress-bar {
    transition: width 0.6s ease;
}

.glass-panel .card-body {
    padding: 1.5rem;
}

.glass-panel h6 {
    font-weight: 600;
    margin-bottom: 1rem;
}

.glass-panel .progress {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Ajustes para el contenido principal */
.main-content {
    margin-bottom: 2rem;
}

/* Estilos para los botones de actualización */
.btn-outline-light {
    border-color: rgba(255, 255, 255, 0.2);
    padding: 0.25rem 0.5rem;
}

.btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.3);
}

/* Estilos para el menú lateral y el botón de toggle */
.sidebar-menu {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: 100vh;
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(10px);
    z-index: 1000;
    transition: right 0.3s ease;
    overflow-y: auto;
    padding: 2rem 1rem;
}

.sidebar-menu.active {
    right: 0;
}

.sidebar-content {
    padding-top: 1rem;
}

.btn-sidebar-toggle {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1001;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-sidebar-toggle:hover {
    background: rgba(255, 255, 255, 0.2);
}

.btn-sidebar-toggle i {
    font-size: 1.2rem;
}

/* Ajuste para el contenido principal */
.main-content {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.shine {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, #fff, #fff);
    background-size: 400px 400px;
    background-position: 0% 0%;
    background-repeat: no-repeat;
    filter: blur(30px);
    opacity: 0.2;
    transform: translateZ(0);
    animation: shine 3s ease-out infinite;
}

@keyframes shine {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/card-effects.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gráfica de newsletters
        const newsletterData = @json(App\Models\Newsletter::getMonthlyStats());
        const newsletterCtx = document.getElementById('newsletterChart').getContext('2d');
        new Chart(newsletterCtx, {
            type: 'line',
            data: {
                labels: newsletterData.map(item => item.month),
                datasets: [{
                    data: newsletterData.map(item => item.total),
                    borderColor: '#d54040',
                    backgroundColor: 'rgba(213, 64, 64, 0.1)',
                    tension: 0.4,
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#d54040',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    }
                }
            }
        });

        // Gráfica de tareas
        const taskData = @json(App\Models\Todo::getWeeklyCompletedTasks());
        const taskCtx = document.getElementById('taskChart').getContext('2d');
        new Chart(taskCtx, {
            type: 'line',
            data: {
                labels: Object.keys(taskData),
                datasets: [{
                    data: Object.values(taskData),
                    borderColor: '#3d0b46',
                    backgroundColor: 'rgba(61, 11, 70, 0.1)',
                    tension: 0.4,
                    borderWidth: 2,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3d0b46',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            color: '#fff'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush

@endsection
