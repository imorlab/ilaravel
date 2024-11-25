<div 
    x-data="{ open: false }"
    x-init="$watch('open', value => $wire.set('isOpen', value))"
    class="sidebar-wrapper"
>
    <!-- Botón para mostrar/ocultar sidebar -->
    <button 
        @click="open = !open"
        class="btn btn-sidebar-toggle"
        :class="{ 'active': open }"
        title="Panel de Información"
    >
        <i class="fas" :class="{ 'fa-times': open, 'fa-user-astronaut': !open }"></i>
    </button>

    <!-- Sidebar Menu -->
    <div 
        class="sidebar-menu"
        :class="{ 'active': open }"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-x-full"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-full"
        @click.away="open = false"
        @keydown.escape.window="open = false"
    >
        <!-- Weather Widget -->
        <div class="widget weather-widget">
            @if($weather)
                <div class="weather-info">
                    <h3>Current Weather</h3>
                    <div class="weather-details">
                        <img src="{{ $weather['icon'] }}" alt="Weather Icon">
                        <div class="temp">{{ $weather['temp_c'] }}°C</div>
                        <div class="condition">{{ $weather['condition'] }}</div>
                        <div class="humidity">Humidity: {{ $weather['humidity'] }}%</div>
                        <div class="wind">Wind: {{ $weather['wind_kph'] }} km/h</div>
                    </div>
                </div>
            @endif
            <button wire:click="refreshWeather" class="btn btn-refresh">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>

        <!-- Recent Activities Widget -->
        <div class="widget activities-widget">
            <h3>Recent Activities</h3>
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
            <button wire:click="refreshActivities" class="btn btn-refresh">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>

        <!-- Latest News Widget -->
        <div class="widget news-widget">
            <h3>Latest News</h3>
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
            <button wire:click="refreshNews" class="btn btn-refresh">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
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
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            z-index: 1000;
            transition: transform 0.3s ease;
            transform: translateX(100%);
            overflow-y: auto;
            padding: 2rem;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
        }

        .sidebar-menu.active {
            transform: translateX(0);
        }

        .btn-sidebar-toggle {
            position: fixed;
            bottom: 1rem;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-sidebar-toggle i {
            font-size: 1.4rem;
            transition: transform 0.3s ease;
        }

        .btn-sidebar-toggle.active {
            background: rgba(213, 64, 64, 0.2);
            border-color: rgba(213, 64, 64, 0.3);
        }

        .btn-sidebar-toggle.active i {
            transform: rotate(180deg);
        }

        .widget {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .widget h3 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #d54040;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.5rem;
        }

        /* Weather Widget */
        .weather-widget .weather-info {
            text-align: center;
            margin-bottom: 1rem;
        }

        .weather-widget .weather-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            align-items: center;
            margin: 1rem 0;
        }

        .weather-widget .temp {
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
        }

        .weather-widget .condition {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
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

        .btn-refresh {
            width: 100%;
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 5px;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }

        .btn-refresh:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-refresh i {
            margin-right: 0.5rem;
        }

        @media (max-width: 768px) {
            .sidebar-menu {
                width: 100%;
            }
        }
    </style>
</div>
