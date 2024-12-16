@props(['content' => []])

<div style="background-color: {{ $content['background_color'] ?? '#ebebeb' }}; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto;">
        <h1 style="color: {{ isset($content['dark_mode']) && $content['dark_mode'] ? '#ffffff' : '#000000' }};">
            {{ $content['title'] ?? 'Newsletter Template' }}
        </h1>
        @if(isset($content['preheader']))
            <p style="color: {{ isset($content['dark_mode']) && $content['dark_mode'] ? '#ffffff' : '#000000' }};">
                {{ $content['preheader'] }}
            </p>
        @endif
    </div>
</div>
