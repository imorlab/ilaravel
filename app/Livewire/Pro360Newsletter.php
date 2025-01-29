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
    protected $proximamenteTemplate;
    public $selectedSheet = 'ESP';
    protected $lastUploadedFile;
    public $previewHtml = '';

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
            'privacy_text' => 'A Prosegur Gestión de Activos S.L. (doravante "PROSEGUR") é a entidade responsável pelo tratamento dos seus dados pessoais. Trataremos os seus dados por forma a poder mantê-la/o informada/o, através do envio de uma newsletter, das vantagens oferecidas pela campanha de bem-estar e saúde PRO360 da PROSEGUR, com base na relação contratual existente entre si e a PROSEGUR. Pode exercitar os seus direitos de proteção de dados enviando um e-mail para: protecciondedatos@prosegur.com . Pode consultar informações adicionais sobre privacidade acedendo ao seguinte link: https://www.prosegur.com/politica-privacidad/prosegur-empleados',
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
        
        $futureDate = strtotime('+10 days');
        return $monthCodes[(int)date('m', $futureDate)];
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
        $this->proximamenteTemplate = file_get_contents(database_path('pro360/proximamente.html'));
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
            
            // Get language config
            $langConfig = self::LANGUAGE_CONFIG[$this->selectedSheet];
            $currentMonth = $this->getCurrentMonthCode();
            
            // Replace language specific content
            $html = str_replace('cab1a-es.png', "cab1a-{$langConfig['image_code']}.png", $html);
            $html = str_replace('/ene/', "/{$currentMonth}/", $html);
            
            // Replace contact text and other texts
            $html = str_replace('Contacta con el equipo PRO360', $langConfig['contact_text'], $html);
            $html = str_replace('{{ VIEW_PROBLEMS_TEXT }}', $langConfig['view_problems'], $html);
            $html = str_replace('{{ CLICK_HERE_TEXT }}', $langConfig['click_here'], $html);
            
            // Replace legal text
            $legalText = $langConfig['privacy_text'];
            $email = 'protecciondedatos@prosegur.com';
            $privacy_url = 'https://www.prosegur.com/politica-privacidad/prosegur-empleados';
            
            $legalText = str_replace(
                ['[email]', '[privacy_url]'],
                [
                    '<a href="mailto:' . $email . '" style="color: #000000; text-decoration: underline;">' . $email . '</a>',
                    '<a href="' . $privacy_url . '" style="color: #000000; text-decoration: underline;">' . $privacy_url . '</a>'
                ],
                $legalText
            );
            
            $legalText .= '<br><br><b style="color: #000000;">&copy; Copyright 2024 Prosegur</b>';
            $html = str_replace('{{ LEGAL_TEXT }}', $legalText, $html);

            // Replace principal news
            $principalHtml = $this->generatePrincipalHtml($principalNews);
            $html = str_replace('<!-- PRINCIPAL -->', $principalHtml, $html);

            // Generate secondary news and proximamente
            $secondaryHtml = '';
            $proximamenteHtml = '';
            $noticiaIndex = 0;
            $imageCounter = 2;
            
            foreach ($rows as $index => $row) {
                if (empty(array_filter($row, function($cell) {
                    return !empty(trim((string)$cell));
                }))) {
                    continue;
                }

                $firstColumn = trim(strtoupper((string)($row[0] ?? '')));

                // Check if it's a proximamente section
                if (in_array($firstColumn, ['PRÓXIMAMENTE', 'PROXIMAMENTE'])) {
                    $proximamenteHtml = $this->generateProximamenteHtml($row, $langConfig['image_code'], $imageCounter);
                    \Log::info('Generado HTML de Próximamente', [
                        'length' => strlen($proximamenteHtml)
                    ]);
                    $imageCounter++;
                } else {
                    $template = ($noticiaIndex % 2 === 0) ? $this->noticiaIzquierdaTemplate : $this->noticiaDerechaTemplate;
                    $secondaryHtml .= $this->generateNoticiaHtml($row, $template);
                    $noticiaIndex++;
                    $imageCounter++;
                }
            }

            // Replace sections in the master template
            $html = str_replace('<!-- NOTICIA -->', $secondaryHtml, $html);
            $html = str_replace("\t\t\t\t<!-- PROXIMAMENTE -->", $proximamenteHtml, $html);

            // Replace button after processing all templates
            $html = str_replace('btn-es.png', "btn-{$langConfig['image_code']}.png", $html);
            
            $this->generatedHtml = $html;

        } catch (\Exception $e) {
            \Log::error('Error al procesar Excel: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            session()->flash('error', $e->getMessage());
            $this->generatedHtml = null;
        }
    }

    protected function generatePrincipalHtml($data)
    {
        $html = $this->principalTemplate;
        $currentMonth = $this->getCurrentMonthCode();
        
        // Replace month in image paths for other images
        $html = str_replace('/2025/ene/', "/2025/{$currentMonth}/", $html);
        $html = str_replace('{{ IMAGE_NAME }}', 'imagen-1.png', $html);

        // Map Excel columns to template
        $replacements = [
            '{{ TITULO }}' => $data[3] ?? '',
            '{{ TEXTO }}' => $data[4] ?? '',
            '{{ LINK }}' => $data[8] ?? ''
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
        $currentMonth = $this->getCurrentMonthCode();

        // Replace month in image paths for other images
        $html = str_replace('/2025/ene/', "/2025/{$currentMonth}/", $html);
        $html = str_replace('{{ IMAGE_NAME }}', "imagen-{$imageCounter}.png", $html);
        $imageCounter++;

        // Map Excel columns to template
        $replacements = [
            '{{ SPAN }}' => $data[0] ?? '', // Sección
            '{{ TITULO }}' => $data[3] ?? '', // Título
            '{{ TEXTO }}' => $data[4] ?? '', // Texto principal
            'href="{{ LINK }}"' => 'href="' . ($data[8] ?? '') . '"', // Enlace en ambas versiones
            '{{ TEXTO_BOTON }}' => $data[6] ?? '' // Texto del botón en ambas versiones
        ];

        foreach ($replacements as $search => $replace) {
            $html = str_replace($search, $replace, $html);
        }

        return $html;
    }

    protected function generateProximamenteHtml($data, $langCode, $imageCounter)
    {
        $html = $this->proximamenteTemplate;
        $currentMonth = $this->getCurrentMonthCode();

        // Replace language specific image in title
        $html = str_replace(
            'https://media.beonworldwide.com/newsletters/prosegur/2024/resources/prox-ES.png',
            "https://media.beonworldwide.com/newsletters/prosegur/2024/resources/prox-{$langCode}.png",
            $html
        );

        // Replace month in image paths for other images
        $html = str_replace('/2025/ene/', "/2025/{$currentMonth}/", $html);

        // Map Excel columns to template
        $replacements = [
            '{{ TITULO }}' => $data[3] ?? '', // Título
            '{{ TEXTO }}' => $data[4] ?? '', // Descripción
            '{{ IMAGE_NAME }}' => "imagen-{$imageCounter}.png", // Usar el contador dinámico
            '{{ LINK }}' => $data[8] ?? ''
        ];

        // Replace text content
        foreach ($replacements as $search => $replace) {
            $html = str_replace($search, $replace, $html);
        }

        // Handle optional button
        $buttonHtml = '<tr>
            <td align="left" style="font-family: Arial, Helvetica, sans-serif;text-align: left;margin: 10px 0px 0px 20px;">
                <a class="keep-black" href="' . ($data[7] ?? '#') . '">
                    <img src="https://media.beonworldwide.com/newsletters/prosegur/2025/' . $currentMonth . '/img/btn-prox-' . $langCode . '.png"
                    alt="pro360" width="96" height="" border="0" align="left"
                    style="width: 96px; height: auto; mso-height-rule: exactly; background-color: #637A7C; text-align: left;margin: 0px 0px 20px 20px;">
                </a>
            </td>
        </tr>';

        // Replace button placeholder with actual button or empty string
        $html = str_replace(
            '{{ IMAGE_BTN }}',
            !empty($data[6]) ? $buttonHtml : '',
            $html
        );

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

    public function generatePdf()
    {
        if (empty($this->generatedHtml)) {
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'Primero debes generar el contenido de la newsletter',
                'timer' => 1500
            ]);
            return;
        }

        try {
            \Log::info('Iniciando generación de PDF');

            // Renderizar la vista del PDF con el contenido
            $html = view('pdf.newsletter', ['content' => $this->generatedHtml])->render();

            // Generar PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html);
            $pdf->setPaper('A4', 'portrait');
            
            $pdf->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'dpi' => 96,
                'defaultPaperSize' => 'A4',
                'enable_php' => false,
                'enable_javascript' => false,
                'enable_remote' => true,
                'enable_html5_parser' => true,
                'zoom' => 0.5
            ]);

            // Generar nombre del archivo
            $filename = 'newsletter_' . now()->format('Y-m-d_His') . '.pdf';
            $tempPdfPath = storage_path('app/' . $filename);

            // Guardar PDF
            $pdf->save($tempPdfPath);

            \Log::info('PDF generado en: ' . $tempPdfPath);

            // Devolver el archivo y luego eliminarlo
            return response()->download($tempPdfPath, $filename)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            \Log::error('Error al generar PDF: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'No se pudo generar el PDF: ' . $e->getMessage(),
                'timer' => 3000
            ]);
        }
    }

    public function previewNewsletter()
    {
        if (empty($this->generatedHtml)) {
            $this->dispatch('swal:error', [
                'title' => 'Error',
                'text' => 'Primero debes generar el contenido de la newsletter',
                'timer' => 1500
            ]);
            return;
        }

        $this->previewHtml = '<!DOCTYPE html>
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                    body { 
                        font-family: Arial, sans-serif;
                        background: #f0f0f0;
                        color: black;
                        margin: 0;
                        padding: 20px;
                    }
                    * {
                        box-sizing: border-box;
                    }
                    img { 
                        max-width: 100%;
                        height: auto;
                        display: block;
                    }
                    .preview-container {
                        width: ' . $this->cropWidth . 'px;
                        min-height: ' . $this->cropHeight . 'px;
                        margin: 0 auto;
                        background: white;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                        position: relative;
                    }
                    .content {
                        width: 100%;
                        min-height: 100%;
                        padding: ' . $this->cropPadding . 'px;
                        background: white;
                    }
                    .controls {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: white;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    }
                    .controls label {
                        display: block;
                        margin-bottom: 10px;
                    }
                    .controls input {
                        width: 100px;
                        margin-bottom: 15px;
                    }
                    table {
                        width: 100% !important;
                        margin: 0 !important;
                        border-collapse: collapse !important;
                    }
                    td {
                        padding: 5px !important;
                    }
                </style>
            </head>
            <body>
                <div class="preview-container">
                    <div class="content">' . $this->generatedHtml . '</div>
                </div>
                <div class="controls">
                    <label>Ancho (px):
                        <input type="number" value="' . $this->cropWidth . '" 
                            onchange="window.livewire.dispatch(\'updateCropDimensions\', {width: this.value, height: null, padding: null})">
                    </label>
                    <label>Alto (px):
                        <input type="number" value="' . $this->cropHeight . '" 
                            onchange="window.livewire.dispatch(\'updateCropDimensions\', {width: null, height: this.value, padding: null})">
                    </label>
                    <label>Padding (px):
                        <input type="number" value="' . $this->cropPadding . '" 
                            onchange="window.livewire.dispatch(\'updateCropDimensions\', {width: null, height: null, padding: this.value})">
                    </label>
                    <button onclick="window.livewire.dispatch(\'generatePdf\')" 
                        style="width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
                        Generar PDF
                    </button>
                </div>
            </body>
            </html>';

        $this->showPreview = true;
    }

    public function updateCropDimensions($width = null, $height = null, $padding = null)
    {
        if ($width !== null) $this->cropWidth = (int)$width;
        if ($height !== null) $this->cropHeight = (int)$height;
        if ($padding !== null) $this->cropPadding = (int)$padding;
        
        $this->previewNewsletter();
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
