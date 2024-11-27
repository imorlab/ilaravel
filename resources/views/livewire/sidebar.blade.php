<div class="sidebar-wrapper">
    <!-- Botón toggle -->
    <button wire:click="toggleSidebar" class="toggle-button">
        <i class="fas {{ $isOpen ? 'fa-times' : 'fa-user-astronaut' }} {{ $isOpen ? 'rotate' : '' }}"></i>
    </button>
    <div class="sidebar-menu {{ $isOpen ? 'active' : '' }}" @if(!$isOpen) style="display: none;" @endif>
        <!-- Botón de cierre -->
        <button wire:click="toggleSidebar" class="close-button">
            <i class="fas fa-times"></i>
        </button>
        <!-- Weather Widget -->
        <div class="widget weather-widget">
            <div class="widget-header">
                <h3>El Tiempo</h3>
                <button wire:click="refreshWeather" class="btn-refresh" title="Actualizar">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            @if($weather)
                <div class="weather-info">
                    <div class="weather-icon">
                        <img src="{{ $weather['icon'] }}" alt="Weather Icon">
                    </div>
                    <div class="weather-temp">{{ $weather['temp_c'] }}°C</div>
                    <div class="weather-details">
                        <div class="condition">{{ $weather['condition'] }}</div>
                        <div class="weather-stats">
                            <div class="humidity">
                                <i class="fas fa-tint"></i>
                                {{ $weather['humidity'] }}%
                            </div>
                            <div class="wind">
                                <i class="fas fa-wind"></i>
                                {{ $weather['wind_kph'] }} km/h
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Recent Activities Widget -->
        <div class="widget activities-widget">
            <div class="widget-header">
                <h3>Actividad Reciente</h3>
                <button wire:click="refreshActivities" class="btn-refresh" title="Actualizar">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            @if($activities)
                <ul class="activity-list">
                    @foreach($activities as $activity)
                        <li class="activity-item">
                            <div class="activity-title">{{ $activity['title'] }}</div>
                            <div class="activity-description">{{ $activity['description'] }}</div>
                            <div class="activity-time">{{ $activity['time_ago'] }}</div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Latest News Widget -->
        <div class="widget news-widget">
            <div class="widget-header">
                <h3>Últimas Noticias</h3>
                <button wire:click="refreshNews" class="btn-refresh" title="Actualizar">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            @if($news)
                <ul class="news-list">
                    @foreach($news as $item)
                        <li class="news-item">
                            <a href="{{ $item['link'] }}" target="_blank" class="news-link">
                                <h4 class="news-title">{{ $item['title'] }}</h4>
                                <p class="news-description">{{ $item['description'] }}</p>
                                <div class="news-meta">
                                    <span class="news-date">{{ $item['date'] }}</span>
                                    <span class="news-source">{{ $item['source'] }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .sidebar-menu {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            height: 100vh;
            background: linear-gradient(180deg, 
                rgba(15, 15, 20, 0.95) 0%,
                rgba(35, 17, 44, 0.95) 50%,
                rgba(59, 7, 100, 0.95) 100%
            );
            backdrop-filter: blur(10px);
            z-index: 1000;
            padding: 2rem;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-menu.active {
            transform: translateX(0);
        }

        .widget {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(147, 51, 234, 0.2);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }

        .widget:hover {
            border-color: rgba(147, 51, 234, 0.4);
            box-shadow: 0 4px 15px rgba(147, 51, 234, 0.1);
        }

        .widget-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(147, 51, 234, 0.2);
            padding-bottom: 0.5rem;
        }

        .widget-header h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #9333ea;
        }

        .btn-refresh {
            background: rgba(147, 51, 234, 0.2);
            border: 1px solid rgba(147, 51, 234, 0.3);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-refresh:hover {
            background: rgba(147, 51, 234, 0.3);
            transform: rotate(180deg);
        }

        .btn-refresh i {
            font-size: 0.9rem;
        }

        /* Weather Widget Styles */
        .weather-info {
            text-align: center;
            padding: 1rem 0;
        }

        .weather-icon {
            margin-bottom: 1rem;
        }

        .weather-icon img {
            width: 80px;
            height: 80px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .weather-temp {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .weather-details {
            color: rgba(255, 255, 255, 0.9);
        }

        .condition {
            font-size: 1.1rem;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .weather-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .humidity, .wind {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .humidity i, .wind i {
            color: #9333ea;
        }

        /* Activities Widget */
        .activity-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-item {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s ease;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .activity-title {
            font-weight: bold;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .activity-description {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* News Widget */
        .news-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .news-item {
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .news-item:hover {
            transform: translateX(5px);
        }

        .news-link {
            text-decoration: none;
            color: inherit;
            display: block;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .news-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: inherit;
        }

        .news-title {
            font-size: 1rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .news-description {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-meta {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 768px) {
            .sidebar-menu {
                width: 100%;
            }
        }
    </style>
</div>
