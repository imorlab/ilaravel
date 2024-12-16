<div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 glass-card shadow p-4 rounded">
                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-white">Plantillas de Email</h2>
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#newTemplateModal" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nueva Plantilla
                        </button>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- Plantilla en blanco -->
                    <div class="col">
                        <div class="card h-100 hover-shadow" style="transition: all 0.3s ease;">
                            <div class="position-relative">
                                <img src="{{ asset('img/cerberus/blank-template.jpg') }}" 
                                     class="card-img-top" 
                                     alt="Plantilla en blanco"
                                     style="height: 200px; object-fit: cover; object-position: top;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Plantilla en blanco</h5>
                                <p class="card-text text-muted">Comenzar con una plantilla en blanco</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 pb-3">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#newTemplateModal" class="btn btn-primary w-100">
                                    <i class="fas fa-plus me-2"></i> Crear
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Plantilla por defecto y plantillas del usuario -->
                    @foreach($templates as $template)
                        @if($template['id'])
                            <div class="col">
                                <div class="card h-100 {{ $template['is_default'] ? 'border-primary' : '' }} hover-shadow"
                                     style="transition: all 0.3s ease;">
                                    <div class="position-relative">
                                        <img src="{{ $template['thumbnail'] }}" 
                                             class="card-img-top" 
                                             alt="{{ $template['name'] }}"
                                             style="height: 200px; object-fit: cover; object-position: top;">
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
                                            @if($template['is_default'])
                                                <button type="button" 
                                                        wire:click="setDefaultAsBase({{ $template['id'] }})"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#newTemplateModal"
                                                        class="btn btn-primary flex-grow-1">
                                                    <i class="fas fa-copy me-2"></i> Usar como base
                                                </button>
                                            @else
                                                <button wire:click="editTemplate({{ $template['id'] }})" 
                                                        class="btn btn-primary flex-grow-1">
                                                    <i class="fas fa-edit me-2"></i> Editar
                                                </button>
                                                <button wire:click="confirmDelete({{ $template['id'] }})" 
                                                        class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para nueva plantilla -->
    <div class="modal fade" id="newTemplateModal" tabindex="-1" aria-labelledby="newTemplateModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTemplateModalLabel">Nueva Plantilla</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="createTemplate">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="templateName" class="form-label">Nombre de la plantilla</label>
                            <input type="text" class="form-control" id="templateName" wire:model="newTemplateName" required>
                            @error('newTemplateName') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="templateDescription" class="form-label">Descripción (opcional)</label>
                            <textarea class="form-control" id="templateDescription" wire:model="newTemplateDescription"></textarea>
                            @error('newTemplateDescription') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Escuchar el evento closeModal
            @this.on('closeModal', (data) => {
                const modalId = data.modal;
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                }
                // También eliminar el backdrop si existe
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                // Restaurar el scroll del body
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });
    </script>
    @endpush
</div>