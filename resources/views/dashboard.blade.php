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
                            <div class="card glass-stat success">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Newsletters</h5>
                                    <h2 class="card-text text-light">{{ App\Models\Newsletter::countThisMonth() }}</h2>
                                    <p class="mb-0 text-light-50"><small>Enviadas este mes</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card glass-stat">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Tareas Pendientes</h5>
                                    <h2 class="card-text text-light">{{ App\Models\Todo::getPendingTasksCount() }}</h2>
                                    <p class="mb-0 text-light-50"><small>{{ App\Models\Todo::getPendingTasksForToday() }} para hoy</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card glass-stat">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Tareas Completadas</h5>
                                    <h2 class="card-text text-light">{{ App\Models\Todo::getCompletedTasksThisWeek() }}</h2>
                                    <p class="mb-0 text-light-50"><small>Esta semana</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card glass-stat warning">
                                <div class="card-body">
                                    <h5 class="card-title text-light">Notas</h5>
                                    <h2 class="card-text text-light">{{ App\Models\Note::getActiveNotesCount() }}</h2>
                                    <p class="mb-0 text-light-50"><small>Total activas</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráficos y Estadísticas -->
                    <div class="row mt-4">
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

                    <!-- Actividad Reciente -->
                    <div class="row">
                        <div class="col-md-6 my-4">
                            <div class="card glass-panel">
                                <div class="card-header glass-header">
                                    <h5 class="mb-0 text-light">Actividad Reciente</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group glass-list">
                                        @forelse(App\Models\Activity::getRecentActivities() as $activity)
                                            <div class="list-group-item glass-item">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h6 class="mb-1 text-light">{{ $activity['title'] }}</h6>
                                                    <small class="text-light-50">{{ $activity['time_ago'] }}</small>
                                                </div>
                                                <p class="mb-1 text-light-75">{{ $activity['description'] }}</p>
                                            </div>
                                        @empty
                                            <div class="list-group-item glass-item">
                                                <p class="mb-0 text-light-75">No hay actividades recientes</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Widgets -->
                        <div class="col-md-6">
                            <!-- Widget del Clima -->
                            <div class="card glass-panel mb-4">
                                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-light">Clima en Sevilla</h5>
                                    <button class="btn btn-link text-light p-0" onclick="refreshWeather()" title="Actualizar clima">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                                <div class="card-body" id="weather-widget">
                                    @php
                                        $weather = app(App\Services\WeatherService::class)->getCurrentWeather();
                                    @endphp
                                    @if($weather)
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ $weather['icon'] }}" alt="Clima" class="me-3" style="width: 64px;">
                                            <div>
                                                <h2 class="mb-0 text-light">{{ $weather['temp_c'] }}°C</h2>
                                                <p class="mb-0 text-light-75">{{ $weather['condition'] }}</p>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col">
                                                <p class="mb-0 text-light-75">Humedad</p>
                                                <h5 class="text-light">{{ $weather['humidity'] }}%</h5>
                                            </div>
                                            <div class="col">
                                                <p class="mb-0 text-light-75">Viento</p>
                                                <h5 class="text-light">{{ $weather['wind_kph'] }} km/h</h5>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-light-75">No se pudo obtener la información del clima. Por favor, intente más tarde.</p>
                                    @endif
                                </div>
                            </div>
                        
                            <!-- Widget de Noticias -->
                            <div class="card glass-panel">
                                <div class="card-header glass-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 text-light">Últimas Noticias</h5>
                                    <button class="btn btn-link text-light p-0" onclick="refreshNews()" title="Actualizar noticias">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="news-list" id="news-widget">
                                        @php
                                            $news = app(App\Services\RssService::class)->getNews();
                                        @endphp
                                        @forelse($news as $item)
                                            <div class="news-item mb-3">
                                                <h6 class="text-light mb-1">
                                                    <a href="{{ $item['link'] }}" target="_blank" class="text-light text-decoration-none">
                                                        {{ $item['title'] }}
                                                    </a>
                                                </h6>
                                                <p class="mb-1 text-light-75 small">{{ Str::limit(strip_tags($item['description']), 100) }}</p>
                                                <small class="text-light-50">{{ $item['date'] }} - {{ $item['source'] }}</small>
                                            </div>
                                        @empty
                                            <div class="news-item mb-3">
                                                <p class="text-light-75">No hay noticias disponibles</p>
                                            </div>
                                        @endforelse
                                    </div>
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

/* Estilos para los widgets */
.news-item a:hover {
    color: rgba(255, 255, 255, 0.8) !important;
    text-decoration: underline !important;
}

.news-list {
    max-height: 400px;
    overflow-y: auto;
}

.news-list::-webkit-scrollbar {
    width: 8px;
}

.news-list::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.news-list::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 4px;
}

.news-list::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Funciones de actualización de widgets
    function refreshWeather() {
        const button = document.querySelector('#weather-widget').previousElementSibling.querySelector('button');
        const widget = document.querySelector('#weather-widget');
        
        button.disabled = true;
        button.querySelector('i').classList.add('spin');
        
        widget.innerHTML = '<p class="text-light-75">Actualizando información del clima...</p>';

        fetch('{{ route('dashboard.refresh-weather') }}')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    widget.innerHTML = '<p class="text-light-75">' + data.error + '</p>';
                } else {
                    widget.innerHTML = `
                        <div class="d-flex align-items-center mb-3">
                            <img src="${data.icon}" alt="Clima" class="me-3" style="width: 64px;">
                            <div>
                                <h2 class="mb-0 text-light">${data.temp_c}°C</h2>
                                <p class="mb-0 text-light-75">${data.condition}</p>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <p class="mb-0 text-light-75">Humedad</p>
                                <h5 class="text-light">${data.humidity}%</h5>
                            </div>
                            <div class="col">
                                <p class="mb-0 text-light-75">Viento</p>
                                <h5 class="text-light">${data.wind_kph} km/h</h5>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                widget.innerHTML = '<p class="text-light-75">No se pudo actualizar la información del clima. Por favor, intente más tarde.</p>';
            })
            .finally(() => {
                button.disabled = false;
                button.querySelector('i').classList.remove('spin');
            });
    }

    function refreshNews() {
        const button = document.querySelector('#news-widget').previousElementSibling.querySelector('button');
        button.disabled = true;
        button.querySelector('i').classList.add('spin');

        fetch('{{ route('dashboard.refresh-news') }}')
            .then(response => response.json())
            .then(data => {
                if (data.error || !data.length) {
                    document.querySelector('#news-widget').innerHTML = 
                        '<p class="text-light-75">No hay noticias disponibles</p>';
                } else {
                    document.querySelector('#news-widget').innerHTML = data.map(item => `
                        <div class="news-item mb-3">
                            <h6 class="text-light mb-1">
                                <a href="${item.link}" target="_blank" class="text-light text-decoration-none">
                                    ${item.title}
                                </a>
                            </h6>
                            <p class="mb-1 text-light-75 small">${item.description}</p>
                            <small class="text-light-50">${item.date} - ${item.source}</small>
                        </div>
                    `).join('');
                }
            })
            .catch(() => {
                document.querySelector('#news-widget').innerHTML = 
                    '<p class="text-light-75">No hay noticias disponibles</p>';
            })
            .finally(() => {
                button.disabled = false;
                button.querySelector('i').classList.remove('spin');
            });
    }

    // Estilos para la animación de actualización
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .spin {
            animation: spin 1s linear infinite;
            display: inline-block;
        }
    `;
    document.head.appendChild(style);

    // Gráficas existentes...
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
