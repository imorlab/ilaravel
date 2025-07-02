@extends('layouts.app')

@section('content')
<div class="container">
    <div class="arrow arrow--top">
        <svg xmlns="http://www.w3.org/2000/svg" width="270.11" height="649.9" overflow="visible">
            <g class="item-to bounce-1">
                <path class="geo-arrow draw-in" d="M135.06 142.564L267.995 275.5 135.06 408.434 2.125 275.499z" />
            </g>
            <circle class="geo-arrow item-to bounce-2" cx="194.65" cy="69.54" r="7.96" />
            <circle class="geo-arrow draw-in" cx="194.65" cy="39.5" r="7.96" />
            <circle class="geo-arrow item-to bounce-3" cx="194.65" cy="9.46" r="7.96" />
            <g class="geo-arrow item-to bounce-2">
                <path class="st0 draw-in" d="M181.21 619.5l13.27 27 13.27-27zM194.48 644.5v-552" />
            </g>
        </svg>
    </div>
    <div class="arrow arrow--bottom">
        <svg xmlns="http://www.w3.org/2000/svg" width="31.35" height="649.9" overflow="visible">
            <g class="item-to bounce-1">
                <circle class="geo-arrow item-to bounce-3" cx="15.5" cy="580.36" r="7.96" />
                <circle class="geo-arrow draw-in" cx="15.5" cy="610.4" r="7.96" />
                <circle class="geo-arrow item-to bounce-2" cx="15.5" cy="640.44" r="7.96" />
                <g class="item-to bounce-2">
                    <path class="geo-arrow draw-in" d="M28.94 30.4l-13.26-27-13.27 27zM15.68 5.4v552" />
                </g>
            </g>
        </svg>
    </div>
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-8">
            <div class="col-auto text-center mb-5 position-relative">
                @if(env('SHOW_CHRISTMAS_ELEMENTS', false))
                <img src="{{ asset('img/christmas-hat.png') }}" class="position-absolute" style="width: 45px; top: -5px; left: calc(50% - 60px); z-index: 100;">
                @endif
                <img src="{{ asset('/img/laravel_96.png') }}" class="img-fluid ms-auto me-auto d-block mb-1 animate__animated animate__fadeIn">
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <a href="{{ '/sending' }}" class="text-decoration-none">
                        <div class="atvImg" 
                             x-data="{ 
                                shine: false,
                                handleMove(e) {
                                    const elem = this.$el;
                                    const w = elem.clientWidth;
                                    const h = elem.clientHeight;
                                    const rect = elem.getBoundingClientRect();
                                    const pageX = e.clientX;
                                    const pageY = e.clientY;
                                    
                                    const offsetX = 0.52 - (pageX - rect.left) / w;
                                    const offsetY = 0.52 - (pageY - rect.top) / h;
                                    
                                    const dy = (pageY - rect.top) - h / 2;
                                    const dx = (pageX - rect.left) - w / 2;
                                    
                                    const yRotate = (offsetX - dx) * (0.07 * (320/w));
                                    const xRotate = (dy - offsetY) * (0.1 * (320/w));
                                    
                                    const arad = Math.atan2(dy, dx);
                                    const angle = arad * 180 / Math.PI - 90;
                                    
                                    const cssTransform = `rotateX(${xRotate}deg) rotateY(${yRotate}deg)${this.shine ? ' scale3d(1.07,1.07,1.07)' : ''}`;
                                    
                                    elem.querySelector('.atvImg-container').style.transform = cssTransform;
                                    
                                    if (this.shine) {
                                        const shineBg = `linear-gradient(${angle}deg, rgba(255,255,255,${(pageY - rect.top)/h * 0.4}) 0%,rgba(255,255,255,0) 80%)`;
                                        elem.querySelector('.shine').style.background = shineBg;
                                    }
                                }
                             }"
                             @mouseenter="shine = true"
                             @mouseleave="shine = false; $el.querySelector('.atvImg-container').style.transform = ''; $el.querySelector('.shine').style.background = ''"
                             @mousemove="handleMove">
                            <div class="atvImg-container">
                                <div class="atvImg-shadow"></div>
                                <div class="atvImg-layers">
                                    <div class="card custom-card bg-glass h-100 animate__animated animate__fadeInLeft">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon me-3">
                                                    <img src="{{ asset('/img/icons/mail_96.png') }}" alt="Mail" class="icon-image">
                                                </div>
                                                <h4 class="card-title mb-0">{{ __('Envío de Newsletter') }}</h4>
                                            </div>
                                            <p class="card-text">{{ __('¿Quieres enviar una newsletter?') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ '/notes' }}" class="text-decoration-none">
                        <div class="atvImg" 
                             x-data="{ 
                                shine: false,
                                handleMove(e) {
                                    const elem = this.$el;
                                    const w = elem.clientWidth;
                                    const h = elem.clientHeight;
                                    const rect = elem.getBoundingClientRect();
                                    const pageX = e.clientX;
                                    const pageY = e.clientY;
                                    
                                    const offsetX = 0.52 - (pageX - rect.left) / w;
                                    const offsetY = 0.52 - (pageY - rect.top) / h;
                                    
                                    const dy = (pageY - rect.top) - h / 2;
                                    const dx = (pageX - rect.left) - w / 2;
                                    
                                    const yRotate = (offsetX - dx) * (0.07 * (320/w));
                                    const xRotate = (dy - offsetY) * (0.1 * (320/w));
                                    
                                    const arad = Math.atan2(dy, dx);
                                    const angle = arad * 180 / Math.PI - 90;
                                    
                                    const cssTransform = `rotateX(${xRotate}deg) rotateY(${yRotate}deg)${this.shine ? ' scale3d(1.07,1.07,1.07)' : ''}`;
                                    
                                    elem.querySelector('.atvImg-container').style.transform = cssTransform;
                                    
                                    if (this.shine) {
                                        const shineBg = `linear-gradient(${angle}deg, rgba(255,255,255,${(pageY - rect.top)/h * 0.4}) 0%,rgba(255,255,255,0) 80%)`;
                                        elem.querySelector('.shine').style.background = shineBg;
                                    }
                                }
                             }"
                             @mouseenter="shine = true"
                             @mouseleave="shine = false; $el.querySelector('.atvImg-container').style.transform = ''; $el.querySelector('.shine').style.background = ''"
                             @mousemove="handleMove">
                            <div class="atvImg-container">
                                <div class="atvImg-shadow"></div>
                                <div class="atvImg-layers">
                                    <div class="card custom-card bg-glass h-100 animate__animated animate__fadeInRight">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon me-3">
                                                    <img src="{{ asset('/img/icons/rubik_96.png') }}" alt="Notes" class="icon-image">
                                                </div>
                                                <h4 class="card-title mb-0">{{ __('Notas Personales') }}</h4>
                                            </div>
                                            <p class="card-text">{{ __('Organiza tus ideas y documentos') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <a href="{{ '/todo' }}" class="text-decoration-none">
                        <div class="atvImg" 
                             x-data="{ 
                                shine: false,
                                handleMove(e) {
                                    const elem = this.$el;
                                    const w = elem.clientWidth;
                                    const h = elem.clientHeight;
                                    const rect = elem.getBoundingClientRect();
                                    const pageX = e.clientX;
                                    const pageY = e.clientY;
                                    
                                    const offsetX = 0.52 - (pageX - rect.left) / w;
                                    const offsetY = 0.52 - (pageY - rect.top) / h;
                                    
                                    const dy = (pageY - rect.top) - h / 2;
                                    const dx = (pageX - rect.left) - w / 2;
                                    
                                    const yRotate = (offsetX - dx) * (0.07 * (320/w));
                                    const xRotate = (dy - offsetY) * (0.1 * (320/w));
                                    
                                    const arad = Math.atan2(dy, dx);
                                    const angle = arad * 180 / Math.PI - 90;
                                    
                                    const cssTransform = `rotateX(${xRotate}deg) rotateY(${yRotate}deg)${this.shine ? ' scale3d(1.07,1.07,1.07)' : ''}`;
                                    
                                    elem.querySelector('.atvImg-container').style.transform = cssTransform;
                                    
                                    if (this.shine) {
                                        const shineBg = `linear-gradient(${angle}deg, rgba(255,255,255,${(pageY - rect.top)/h * 0.4}) 0%,rgba(255,255,255,0) 80%)`;
                                        elem.querySelector('.shine').style.background = shineBg;
                                    }
                                }
                             }"
                             @mouseenter="shine = true"
                             @mouseleave="shine = false; $el.querySelector('.atvImg-container').style.transform = ''; $el.querySelector('.shine').style.background = ''"
                             @mousemove="handleMove">
                            <div class="atvImg-container">
                                <div class="atvImg-shadow"></div>
                                <div class="atvImg-layers">
                                    <div class="card custom-card bg-glass h-100 animate__animated animate__fadeInLeft">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon me-3">
                                                    <img src="{{ asset('/img/icons/new_96.png') }}" alt="Todo" class="icon-image">
                                                </div>
                                                <h4 class="card-title mb-0">{{ __('Lista de Tareas') }}</h4>
                                            </div>
                                            <p class="card-text">{{ __('Planea tu día y administra tu vida') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ '/dashboard' }}" class="text-decoration-none">
                        <div class="atvImg" 
                             x-data="{ 
                                shine: false,
                                handleMove(e) {
                                    const elem = this.$el;
                                    const w = elem.clientWidth;
                                    const h = elem.clientHeight;
                                    const rect = elem.getBoundingClientRect();
                                    const pageX = e.clientX;
                                    const pageY = e.clientY;
                                    
                                    const offsetX = 0.52 - (pageX - rect.left) / w;
                                    const offsetY = 0.52 - (pageY - rect.top) / h;
                                    
                                    const dy = (pageY - rect.top) - h / 2;
                                    const dx = (pageX - rect.left) - w / 2;
                                    
                                    const yRotate = (offsetX - dx) * (0.07 * (320/w));
                                    const xRotate = (dy - offsetY) * (0.1 * (320/w));
                                    
                                    const arad = Math.atan2(dy, dx);
                                    const angle = arad * 180 / Math.PI - 90;
                                    
                                    const cssTransform = `rotateX(${xRotate}deg) rotateY(${yRotate}deg)${this.shine ? ' scale3d(1.07,1.07,1.07)' : ''}`;
                                    
                                    elem.querySelector('.atvImg-container').style.transform = cssTransform;
                                    
                                    if (this.shine) {
                                        const shineBg = `linear-gradient(${angle}deg, rgba(255,255,255,${(pageY - rect.top)/h * 0.4}) 0%,rgba(255,255,255,0) 80%)`;
                                        elem.querySelector('.shine').style.background = shineBg;
                                    }
                                }
                             }"
                             @mouseenter="shine = true"
                             @mouseleave="shine = false; $el.querySelector('.atvImg-container').style.transform = ''; $el.querySelector('.shine').style.background = ''"
                             @mousemove="handleMove">
                            <div class="atvImg-container">
                                <div class="atvImg-shadow"></div>
                                <div class="atvImg-layers">
                                    <div class="card custom-card bg-glass h-100 animate__animated animate__fadeInRight">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="feature-icon me-3">
                                                    <img src="{{ asset('/img/icons/toolbox_96.png') }}" alt="Dashboard" class="icon-image">
                                                </div>
                                                <h4 class="card-title mb-0">{{ __('Panel de Control') }}</h4>
                                            </div>
                                            <p class="card-text">{{ __('Visualiza tus métricas y progreso') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endpush

@push('scripts')
@endpush
