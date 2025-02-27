@if(isset($block['content']['image']))
<tr>
    <td style="
        padding: {{ $block['content']['padding'] ?? '20' }}px;
        text-align: {{ $block['content']['alignment'] ?? 'center' }};
        background-color: {{ $block['content']['background_color'] ?? '#ffffff' }};
        " class="darkmode-bg" wire:key="header-{{ $block['content']['background_color'] ?? 'default' }}">
        <img src="{{ $block['content']['image'] }}"
             width="{{ $block['content']['width'] ?? '200' }}"
             alt="{{ $block['content']['alt'] ?? 'Logo' }}"
             border="0"
             style="
                width: {{ $block['content']['width'] ?? '200' }}px;
                max-width: 100%;
                height: auto;
                font-family: sans-serif;
                font-size: 15px;
                line-height: 15px;
                color: {{ $block['content']['color'] ?? '#555555' }};
             ">
    </td>
</tr>
@endif
