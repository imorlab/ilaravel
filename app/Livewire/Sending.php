<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class Sending extends Component
{
    public $email;
    public $html;

    protected $rules = [
        'email' => 'required|email',
        'html' => 'required'
    ];

    protected $messages = [
        'email.required' => 'El email es obligatorio',
        'email.email' => 'El email debe ser válido',
        'html.required' => 'El contenido HTML es obligatorio'
    ];

    public function send()
    {
        try {
            $this->validate();

            // Enviar el email
            Mail::to($this->email)->send(new OrderShipped($this->html));

            // Registrar el envío
            Newsletter::create([
                'email' => $this->email,
                'content' => $this->html,
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
