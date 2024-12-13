<div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 glass-card shadow p-4 rounded">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-white">Plantillas de Email</h2>
                    <div>
                        <a href="{{ route('cerberus.editor') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nueva Plantilla
                        </a>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($templates as $template)
                        <div class="col">
                            <div class="card h-100 {{ $template['is_default'] ? 'border-primary' : '' }} hover-shadow"
                                 style="transition: all 0.3s ease;">
                                <div class="position-relative">
                                    <img src="{{ $template['thumbnail'] }}" 
                                         class="card-img-top" 
                                         alt="{{ $template['name'] }}"
                                         style="height: 200px; object-fit: cover;">
                                    @if($template['is_default'])
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-primary">Por Defecto</span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="card-body">
                                    <h5 class="card-title">{{ $template['name'] }}</h5>
                                    <p class="card-text text-muted">{{ $template['description'] }}</p>
                                </div>
                                
                                <div class="card-footer bg-transparent border-0 pb-3">
                                    <div class="d-flex gap-2">
                                        <button wire:click="selectTemplate({{ $template['id'] }})" 
                                                class="btn btn-primary flex-grow-1">
                                            <i class="fas fa-edit me-2"></i>
                                            @if($template['id'])
                                                Editar
                                            @else
                                                Usar
                                            @endif
                                        </button>
                                        @if($template['id'] >= 2)
                                            <button wire:click="confirmDelete({{ $template['id'] }})" 
                                                    class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>