<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;
use App\Models\Newsletter;
use Livewire\Attributes\On;

class Pro360Newsletter extends Component
{
    use WithFileUploads;

    public $excelFile;
    public $generatedHtml;
    public $emailsToSend = '';
    protected $masterTemplate;
    protected $principalTemplate;
    protected $noticiaIzquierdaTemplate;
    protected $noticiaDerechaTemplate;
    public $selectedSheet = 'ESP';
    protected $lastUploadedFile;

    protected const LANGUAGE_CONFIG = [
        'ESP' => [
            'url_code' => 'ES',
            'image_code' => 'es',
            'contact_text' => 'Contacta con el equipo PRO360',
            'privacy_text' => 'Prosegur Gestión de Activos S.L. (en adelante, "PROSEGUR") es la entidad Responsable del Tratamiento de sus datos personales. Trataremos sus datos con la finalidad de poder mantenerle informado, a través del envío de newsletter, de las ventajas que ofrece la campaña PRO360 de bienestar y salud de PROSEGUR, sobre la base de la relación contractual existente entre Usted y PROSEGUR. Puede ejercitar sus derechos de protección de datos enviando un correo electrónico a: protecciondedatos@prosegur.com. Puede consultar información adicional sobre privacidad accediendo al siguiente enlace: https://www.prosegur.com/politica-privacidad/prosegur-empleados',
            'view_problems' => '¿Problemas para ver el mail? Haz ',
            'click_here' => 'click aquí'
        ],
        'EN' => [
            'url_code' => 'EN',
            'image_code' => 'en',
            'contact_text' => 'Contact the PRO360 team',
            'privacy_text' => 'Prosegur Gestión de Activos S.L. ("PROSEGUR") is the party responsible for processing your personal data (data controller). We will process your data to keep you informed through our newsletters, which contain the advantages of the PROSEGUR PRO360 health and wellness campaign, and based on the existing contractual relationship between you and PROSEGUR. You can exercise your data protection rights by sending an e-mail to: protecciondedatos@prosegur.com. Additional information on privacy can be found at the following link: https://www.prosegur.com/politica-privacidad/prosegur-empleados',
            'view_problems' => 'Problems viewing the mail? ',
            'click_here' => 'Click here'
        ],
        'DE' => [
            'url_code' => 'DE',
            'image_code' => 'de',
            'contact_text' => 'Kontaktieren Sie das PRO360-Team',
            'privacy_text' => 'Prosegur Gestión de Activos, S.L. (im Folgenden „PROSEGUR") gilt als Verantwortlicher für die Verarbeitung Ihrer personenbezogenen Daten. Die von uns durchgeführte Verarbeitung Ihrer Daten dient dazu, Sie gemäß dem bestehenden Vertragsverhältnis zwischen Ihnen und PROSEGUR per Newsletter über die Vorteile der PROSEGUR- Kampagne PRO360 über Wohlbefinden und Gesundheit zu informieren. Sie können Ihre Datenschutzrechte ausüben, indem Sie eine E-Mail an folgende Adresse senden: protecciondedatos@prosegur.com. Weitere Informationen zum Datenschutz finden Sie unter folgendem Link: https://www.prosegur.com/politica-privacidad/prosegur-empleados',
            'view_problems' => 'Probleme beim Anzeigen der E-Mail? ',
            'click_here' => 'Klicken Sie hier'
        ],
        'PT' => [
            'url_code' => 'PT',
            'image_code' => 'pt',
            'contact_text' => 'Contacte a equipa PRO360',
            'privacy_text' => 'A Prosegur Gestión de Activos S.L. (doravante "PROSEGUR") é a entidade responsável pelo tratamento dos seus dados pessoais. Trataremos os seus dados por forma a poder mantê-la/o informada/o, através do envio de uma newsletter, das vantagens oferecidas pela campanha de bem-estar e saúde PRO360 da PROSEGUR, com base na relação contratual existente entre si e a PROSEGUR. Pode exercer os seus direitos de proteção de dados enviando um e-mail para: protecciondedatos@prosegur.com . Pode consultar informações adicionais sobre privacidade acedendo ao seguinte link: https://www.prosegur.com/politica-privacidad/prosegur-empleados',
            'view_problems' => 'Problemas para ver o e-mail? ',
            'click_here' => 'Clique aqui'
        ],
        'PTBR' => [
            'url_code' => 'PT-BR',
            'image_code' => 'pt',
            'contact_text' => 'Entre em contato com a equipe PRO360',
            'privacy_text' => 'Prosegur Gestión de Activos S.L. (doravante, "PROSEGUR") é a entidade responsável pelo tratamento de seus dados pessoais. Processaremos seus dados para mantê-lo informado, através do envio de newsletters, das vantagens oferecidas pela campanha de bem-estar e saúde PRO360 da PROSEGUR, com base na relação contratual existente entre você e a PROSEGUR. Você pode exercer seus direitos de proteção de dados enviando um e-mail para: protecciondedatos@prosegur.com . Você pode consultar informações adicionais sobre privacidade acessando o seguinte link: https://www.prosegur.com/politica-privacidad/prosegur-empleados',
            'view_problems' => 'Problemas para ver o e-mail? ',
            'click_here' => 'Clique aqui'
        ]
    ];

    protected function getCurrentMonthCode()
    {
        $monthCodes = [
            1 => 'ene', 2 => 'feb', 3 => 'mar', 4 => 'abr', 
            5 => 'may', 6 => 'jun', 7 => 'jul', 8 => 'ago',
            9 => 'sep', 10 => 'oct', 11 => 'nov', 12 => 'dic'
        ];
        
        return $monthCodes[(int)date('m')];
    }

    public function mount()
    {
        $this->loadTemplates();
    }

    public function booted()
    {
        // Asegurarse de que las plantillas estén cargadas después de que el componente se inicie
        $this->loadTemplates();
    }

    protected function loadTemplates()
    {
        $this->masterTemplate = file_get_contents(database_path('pro360/maestro.html'));
        $this->principalTemplate = file_get_contents(database_path('pro360/principal.html'));
        $this->noticiaIzquierdaTemplate = file_get_contents(database_path('pro360/noticia-izquierda.html'));
        $this->noticiaDerechaTemplate = file_get_contents(database_path('pro360/noticia-derecha.html'));
    }

    public function updatePreview()
    {
        if (!$this->excelFile) {
            session()->flash('error', 'Por favor, primero sube un archivo Excel.');
            return;
        }

        $this->processExcelFile();
    }

    public function updatedExcelFile()
    {
        $this->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls',
        ]);

        $this->processExcelFile();
    }

    protected function processExcelFile()
    {
        try {
            $path = $this->excelFile->getRealPath();
            $spreadsheet = IOFactory::load($path);
            
            // Seleccionar la pestaña específica
            $worksheet = $spreadsheet->getSheetByName($this->selectedSheet);
            if (!$worksheet) {
                throw new \Exception("La pestaña {$this->selectedSheet} no existe en el archivo Excel.");
            }

            $rows = $worksheet->toArray();
            $headers = array_shift($rows); // Remove headers

            // Get principal news (first row)
            $principalNews = array_shift($rows);

            // Generate HTML
            $html = $this->masterTemplate;

            // Replace language-specific content
            $langConfig = self::LANGUAGE_CONFIG[$this->selectedSheet];
            $currentMonth = $this->getCurrentMonthCode();
            
            // Reemplazar la URL y la imagen primero
            $html = str_replace('pro360_ES.html', "pro360_{$langConfig['url_code']}.html", $html);
            $html = str_replace('cab1a-es.png', "cab1a-{$langConfig['image_code']}.png", $html);
            $html = str_replace('/ene/', "/{$currentMonth}/", $html);
            
            // Reemplazar el texto de contacto
            $html = str_replace(
                'Contacta con el equipo PRO360',
                $langConfig['contact_text'],
                $html
            );
            
            // Reemplazar el texto de problemas de visualización
            $html = str_replace(
                '{{ VIEW_PROBLEMS_TEXT }}',
                $langConfig['view_problems'],
                $html
            );
            
            // Reemplazar el texto del enlace
            $html = str_replace(
                '{{ CLICK_HERE_TEXT }}',
                $langConfig['click_here'],
                $html
            );
            
            // Reemplazar el texto legal usando el placeholder
            $legalText = $langConfig['privacy_text'];
            
            // Añadir los enlaces con el estilo correcto
            $email = 'protecciondedatos@prosegur.com';
            $privacy_url = 'https://www.prosegur.com/politica-privacidad/prosegur-empleados';
            
            $legalText = str_replace(
                $email,
                '<a href="mailto:' . $email . '" style="text-decoration: none; color: #B7B7B7;">' . $email . '</a>',
                $legalText
            );
            
            $legalText = str_replace(
                $privacy_url,
                '<a href="' . $privacy_url . '" style="text-decoration: none; color: #B7B7B7;">' . $privacy_url . '</a>',
                $legalText
            );
            
            $legalText .= '<br><br><b style="color: #000000;">&copy; Copyright 2024 Prosegur</b>';
            
            $html = str_replace('{{ LEGAL_TEXT }}', $legalText, $html);

            // Replace principal news
            $principalHtml = $this->generatePrincipalHtml($principalNews);
            $html = str_replace('<!-- PRINCIPAL -->', $principalHtml, $html);

            // Generate secondary news
            $secondaryHtml = '';
            foreach ($rows as $index => $row) {
                if (empty(array_filter($row, function($cell) {
                    return !empty(trim((string)$cell));
                }))) {
                    continue;
                }

                $template = ($index % 2 === 0) ? $this->noticiaIzquierdaTemplate : $this->noticiaDerechaTemplate;
                $secondaryHtml .= $this->generateNoticiaHtml($row, $template);
            }

            $html = str_replace('<!-- NOTICIA -->', $secondaryHtml, $html);

            // Reemplazar el botón después de procesar todas las plantillas
            $html = str_replace('btn-es.png', "btn-{$langConfig['image_code']}.png", $html);

            $this->generatedHtml = $html;

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            $this->generatedHtml = null;
        }
    }

    protected function generatePrincipalHtml($data)
    {
        $html = $this->principalTemplate;

        // Reemplazar la imagen
        $html = str_replace('{{ IMAGE_NAME }}', 'imagen-1.png', $html);

        // Map Excel columns to template
        $replacements = [
            // Título (columna 4)
            'Título noticia principal' => $data[3] ?? '',
            // Texto principal (columna 5)
            'Descripción noticia principal' => $data[4] ?? '',
            // Enlace (columna 8)
            'enlace-noticia-principal' => $data[7] ?? ''
        ];

        foreach ($replacements as $search => $replace) {
            $html = str_replace($search, $replace, $html);
        }

        return $html;
    }

    protected function generateNoticiaHtml($data, $template)
    {
        static $imageCounter = 2;
        $html = $template;

        // Reemplazar la imagen
        $html = str_replace('{{ IMAGE_NAME }}', "imagen-{$imageCounter}.png", $html);
        $imageCounter++;

        // Map Excel columns to template
        $replacements = [
            'Span' => $data[0] ?? '', // Sección
            'Título noticia' => $data[3] ?? '', // Título
            'Descripción noticia' => $data[4] ?? '', // Texto principal
            'href="enlace-noticia"' => 'href="' . ($data[7] ?? '') . '"', // Reemplazar en ambas versiones
            'Texto botón' => $data[6] ?? '' // Reemplazar en ambas versiones
        ];

        foreach ($replacements as $search => $replace) {
            $html = str_replace($search, $replace, $html);
        }

        return $html;
    }

    public function downloadNewsletter()
    {
        if (!$this->generatedHtml) {
            return;
        }

        $filename = 'pro360_newsletter_' . date('Y_m_d_His') . '.html';
        return response()->streamDownload(function () {
            echo $this->generatedHtml;
        }, $filename);
    }

    public function hydrate()
    {
        // Recargar las plantillas después de cada actualización de Livewire
        $this->loadTemplates();
    }

    public function dehydrate()
    {
        // Limpiar recursos cuando el componente se deshidrata
        if ($this->lastUploadedFile && file_exists($this->lastUploadedFile)) {
            @unlink($this->lastUploadedFile);
        }
    }

    public function render()
    {
        return view('livewire.pro360-newsletter');
    }

    public function send()
    {
        if (!auth()->check()) {
            $this->dispatch('swal:confirm', [
                'title' => 'Autenticación requerida',
                'text' => 'Para enviar newsletters, necesitas iniciar sesión o registrarte.',
                'icon' => 'warning',
                'confirmButtonText' => 'Iniciar sesión',
                'cancelButtonText' => 'Cancelar',
                'next' => [
                    'event' => 'redirect',
                    'params' => [
                        'url' => '/login'
                    ]
                ]
            ]);
            return;
        }

        if (empty($this->generatedHtml)) {
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'Primero debes generar el contenido de la newsletter',
                'timer' => 1500
            ]);
            return;
        }

        $this->dispatch('swal:confirm', [
            'title' => 'Enviar Newsletter',
            'text' => 'Introduce los emails de los destinatarios (separados por comas)',
            'icon' => 'info',
            'confirmButtonText' => 'Enviar',
            'cancelButtonText' => 'Cancelar',
            'next' => [
                'event' => 'sendNewsletterToEmails'
            ]
        ]);
    }

    #[On('sendNewsletterToEmails')]
    public function sendNewsletterToEmails()
    {
        \Log::info('Enviando a emails: ' . $this->emailsToSend);
        
        if (empty($this->emailsToSend)) {
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'El formato de los emails no es válido',
                'timer' => 1500
            ]);
            return;
        }

        $emailList = explode(',', $this->emailsToSend);
        $emailList = array_map('trim', $emailList);
        
        try {
            foreach ($emailList as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new \Exception("El email $email no es válido");
                }

                Mail::to($email)->send(new OrderShipped($this->generatedHtml));

                Newsletter::create([
                    'email' => $email,
                    'content' => $this->generatedHtml,
                    'sent_at' => now(),
                    'status' => 'sent'
                ]);
            }

            $message = count($emailList) > 1 
                ? sprintf('Newsletter enviada a %s y %d destinatario(s) más', $emailList[0], count($emailList) - 1)
                : sprintf('Newsletter enviada a %s', $emailList[0]);

            $this->dispatch('swal:success', [
                'title' => 'Newsletter enviada',
                'text' => $message,
                'timer' => 1500
            ]);

            $this->emailsToSend = '';

        } catch (\Exception $e) {
            \Log::error('Error al enviar newsletter: ' . $e->getMessage());
            
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => $e->getMessage(),
                'timer' => 1500
            ]);
        }
    }
}
