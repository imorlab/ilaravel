@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-auto floating text-center my-3">
            <img src="{{ asset('/img/underwater_jelly.svg') }}" class="img-fluid ms-auto me-auto d-block mb-1">
        </div>
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h2 class="mb-0">Dashboard Personal</h2>
                </div>
                <div class="card-body">
                    <!-- Tarjetas de Resumen -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Tareas Pendientes</h5>
                                    <h2 class="card-text">12</h2>
                                    <p class="mb-0"><small>3 para hoy</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Tareas Completadas</h5>
                                    <h2 class="card-text">45</h2>
                                    <p class="mb-0"><small>Esta semana</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-dark text-white shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Newsletters</h5>
                                    <h2 class="card-text">8</h2>
                                    <p class="mb-0"><small>Enviadas este mes</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Notas</h5>
                                    <h2 class="card-text">23</h2>
                                    <p class="mb-0"><small>Total activas</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos y Estadísticas -->
                    <div class="row">
                        <!-- Progreso de Tareas -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-dark shadow">
                                <div class="card-header bg-dark text-white">
                                    Progreso de Tareas
                                </div>
                                <div class="card-body">
                                    <canvas id="taskProgressChart" width="400" height="300"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Actividad Reciente -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-dark shadow">
                                <div class="card-header bg-dark text-white">
                                    Actividad Reciente
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Newsletter enviada</h6>
                                                <small class="text-muted">Hace 3 horas</small>
                                            </div>
                                            <p class="mb-1">Newsletter mensual enviada a 150 suscriptores</p>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Nueva nota creada</h6>
                                                <small class="text-muted">Hace 5 horas</small>
                                            </div>
                                            <p class="mb-1">Nota "Ideas para el proyecto" creada en categoría Trabajo</p>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">Tareas completadas</h6>
                                                <small class="text-muted">Hace 1 día</small>
                                            </div>
                                            <p class="mb-1">5 tareas marcadas como completadas</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calendario -->
                        <div class="col-md-12">
                            <div class="card border-dark shadow">
                                <div class="card-header bg-dark text-white">
                                    Calendario de Actividades
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
                borderColor: '#212529',
                backgroundColor: 'rgba(33, 37, 41, 0.1)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: "'Nunito', sans-serif"
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush

@endsection
