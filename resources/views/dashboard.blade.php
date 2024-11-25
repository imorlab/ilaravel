@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-10">
            <div class="col-auto text-center mb-4">
            <img src="{{ asset('/img/laravel_96.png') }}" class="img-fluid ms-auto me-auto d-block mb-1">
            </div>
            <div class="card shadow glass-card">
                <div class="card-header glass-header">
                    <h2 class="mb-0 text-light">Dashboard</h2>
                </div>
                <div class="card-body glass-body">
                    <!-- Tarjetas de Resumen -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card glass-stat">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Tareas Pendientes</h5>
                                    <h2 class="card-text text-light">12</h2>
                                    <p class="mb-0 text-light-50"><small>3 para hoy</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card glass-stat success">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Tareas Completadas</h5>
                                    <h2 class="card-text text-light">45</h2>
                                    <p class="mb-0 text-light-50"><small>Esta semana</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card glass-stat">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Newsletters</h5>
                                    <h2 class="card-text text-light">8</h2>
                                    <p class="mb-0 text-light-50"><small>Enviadas este mes</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card glass-stat warning">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Notas</h5>
                                    <h2 class="card-text text-light">23</h2>
                                    <p class="mb-0 text-light-50"><small>Total activas</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos y Estadísticas -->
                    <div class="row">
                        <!-- Progreso de Tareas -->
                        <div class="col-md-6 mb-4">
                            <div class="card glass-panel">
                                <div class="card-header glass-header">
                                    <h5 class="mb-0 text-light">Progreso de Tareas</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="taskProgressChart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Actividad Reciente -->
                        <div class="col-md-6 mb-4">
                            <div class="card glass-panel">
                                <div class="card-header glass-header">
                                    <h5 class="mb-0 text-light">Actividad Reciente</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group glass-list">
                                        <a href="#" class="list-group-item glass-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1 text-light">Newsletter enviada</h6>
                                                <small class="text-light-50">Hace 3 horas</small>
                                            </div>
                                            <p class="mb-1 text-light-75">Newsletter mensual enviada a 150 suscriptores</p>
                                        </a>
                                        <a href="#" class="list-group-item glass-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1 text-light">Nueva nota creada</h6>
                                                <small class="text-light-50">Hace 5 horas</small>
                                            </div>
                                            <p class="mb-1 text-light-75">Nota "Ideas para el proyecto" creada en categoría Trabajo</p>
                                        </a>
                                        <a href="#" class="list-group-item glass-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1 text-light">Tareas completadas</h6>
                                                <small class="text-light-50">Hace 1 día</small>
                                            </div>
                                            <p class="mb-1 text-light-75">5 tareas marcadas como completadas</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendario -->
                        <div class="col-md-12">
                            <div class="card glass-panel">
                                <div class="card-header glass-header">
                                    <h5 class="mb-0 text-light">Calendario de Actividades</h5>
                                </div>
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <h5 class="text-center" style="color: #d54040">#ImlBeonww2024</h5>
            <a href="{{ '/' }}" type="button" class="btn btn-outline-warning btn-circle p-0">
                <i class="bi bi-house-fill p-0"></i>
            </a>
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
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    height: 100%;
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
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuración del gráfico de progreso de tareas
    var ctx = document.getElementById('taskProgressChart').getContext('2d');
    var taskProgressChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Tareas Completadas',
                data: [5, 8, 6, 9, 7, 4, 6],
                borderColor: 'rgba(213, 64, 64, 1)',
                backgroundColor: 'rgba(213, 64, 64, 0.1)',
                tension: 0.4,
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: 'rgba(213, 64, 64, 1)',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#fff',
                        font: {
                            family: "'Source Code Pro', monospace"
                        }
                    }
                }
            },
            scales: {
                y: {
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
