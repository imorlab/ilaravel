<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use Illuminate\Support\HtmlString;

class Sending extends Component
{
    public $email = '';
    public $html = '';

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'html' => 'required|min:10'
    ];

    protected $messages = [
        'email.required' => 'El email es obligatorio',
        'email.email' => 'El formato del email no es válido',
        'html.required' => 'El contenido HTML es obligatorio',
        'html.min' => 'El contenido HTML debe tener al menos 10 caracteres'
    ];

    public function mount()
    {
        $this->email = '';
        $this->html = '';
    }

    public function getPreviewHtmlProperty()
    {
        if (empty($this->html)) {
            return new HtmlString('<div class="text-muted">La vista previa aparecerá aquí...</div>');
        }
        return new HtmlString($this->html);
    }

    public function updated($field)
    {
        $this->resetErrorBag($field);
    }

    public function send()
    {
        if (!auth()->check()) {
            $this->dispatch('swal:auth', [
                'title' => 'Autenticación requerida',
                'text' => 'Para enviar newsletters, necesitas iniciar sesión o registrarte.',
                'showLoginButton' => true,
                'showRegisterButton' => true
            ]);
            return;
        }

        $validatedData = $this->validate();

        try {
            Mail::to($validatedData['email'])->send(new OrderShipped($validatedData['html']));

            Newsletter::create([
                'email' => $validatedData['email'],
                'content' => $validatedData['html'],
                'sent_at' => now(),
                'status' => 'sent'
            ]);

            $this->dispatch('swal:success', [
                'position' => 'top-end',
                'icon' => 'success',
                'title' => 'Newsletter enviada correctamente',
                'timer' => 1500
            ]);

            $this->reset(['email', 'html']);
        } catch (\Exception $e) {
            \Log::error('Error al enviar newsletter: ' . $e->getMessage());
            
            $this->dispatch('swal:error', [
                'position' => 'top-end',
                'icon' => 'error',
                'title' => 'Error al enviar la newsletter',
                'text' => 'Hubo un problema al enviar el correo. Por favor, inténtalo de nuevo.',
                'showConfirmButton' => false,
                'timer' => 1500
            ]);
        }
    }

    public function render()
    {
        return view('livewire.sending');
    }
}
