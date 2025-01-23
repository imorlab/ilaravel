<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Pro360Newsletter extends Component
{
    use WithFileUploads;

    public $excelFile;
    public $generatedHtml;
    public $masterTemplate;
    public $principalTemplate;
    public $noticiaTemplate;

    public function mount()
    {
        $this->loadTemplates();
    }

    protected function loadTemplates()
    {
        $this->masterTemplate = file_get_contents(database_path('pro360/maestro.html'));
        $this->principalTemplate = file_get_contents(database_path('pro360/principal.html'));
        $this->noticiaTemplate = file_get_contents(database_path('pro360/noticia.html'));
    }

    public function updatedExcelFile()
    {
        $this->validate([
            'excelFile' => 'required|file|mimes:xlsx,xls',
        ]);

        $path = $this->excelFile->getRealPath();
        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();

        $rows = $worksheet->toArray();
        $headers = array_shift($rows); // Remove headers

        // Get principal news (first row)
        $principalNews = array_shift($rows);

        // Generate HTML
        $html = $this->masterTemplate;

        // Replace principal news
        $principalHtml = $this->generatePrincipalHtml($principalNews);
        $html = str_replace('<!-- PRINCIPAL -->', $principalHtml, $html);

        // Generate secondary news
        $secondaryHtml = '';
        foreach ($rows as $row) {
            $secondaryHtml .= $this->generateNoticiaHtml($row);
        }

        $html = str_replace('<!-- NOTICIA -->', $secondaryHtml, $html);

        $this->generatedHtml = $html;
    }

    protected function generatePrincipalHtml($data)
    {
        $html = $this->principalTemplate;

        // Map Excel columns to template
        $html = str_replace('{BANDERA}', $data[2] ?? '', $html);
        $html = str_replace('{SIN_TEXTO}', $data[3] ?? '', $html);
        $html = str_replace('{TEXTO}', $data[4] ?? '', $html);
        $html = str_replace('{BOTON}', $data[6] ?? '', $html);
        $html = str_replace('{ENLACE}', $data[7] ?? '', $html);

        return $html;
    }

    protected function generateNoticiaHtml($data)
    {
        $html = $this->noticiaTemplate;

        // Map Excel columns to template
        $html = str_replace('{SECCION}', $data[0] ?? '', $html);
        $html = str_replace('{BANDERA}', $data[2] ?? '', $html);
        $html = str_replace('{SIN_TEXTO}', $data[3] ?? '', $html);
        $html = str_replace('{TEXTO}', $data[4] ?? '', $html);
        $html = str_replace('{BOTON}', $data[6] ?? '', $html);
        $html = str_replace('{ENLACE}', $data[7] ?? '', $html);

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

    public function render()
    {
        return view('livewire.pro360-newsletter');
    }
}
