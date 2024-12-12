<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td style="padding: {{ $block['content']['padding'] ?? '20' }}px; font-family: sans-serif; font-size: {{ $block['content']['font_size'] ?? '15' }}px; line-height: {{ $block['content']['line_height'] ?? '20' }}px; color: {{ $block['content']['text_color'] ?? '#000000' }} !important;">
            @if(isset($block['content']['title']))
            <h1 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: {{ $block['content']['title_size'] ?? '25' }}px; line-height: {{ $block['content']['title_line_height'] ?? '30' }}px; color: {{ $block['content']['text_color'] ?? '#000000' }} !important; font-weight: {{ $block['content']['title_weight'] ?? 'normal' }};">
                {{ $block['content']['title'] }}
            </h1>
            @endif
            @if(isset($block['content']['text']))
            <p style="margin: 0; font-family: sans-serif; font-size: {{ $block['content']['font_size'] ?? '15' }}px; line-height: {{ $block['content']['line_height'] ?? '20' }}px; color: {{ $block['content']['text_color'] ?? '#000000' }} !important;">{{ $block['content']['text'] }}</p>
            @endif
        </td>
    </tr>
    @if(isset($block['content']['subtitle']) || isset($block['content']['list_items']) || isset($block['content']['secondary_text']))
    <tr>
        <td style="padding: {{ $block['content']['padding'] ?? '20' }}px; font-family: sans-serif; font-size: {{ $block['content']['font_size'] ?? '15' }}px; line-height: {{ $block['content']['line_height'] ?? '20' }}px; color: {{ $block['content']['text_color'] ?? '#555555' }};">
            @if(isset($block['content']['subtitle']))
            <h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: {{ $block['content']['subtitle_size'] ?? '18' }}px; line-height: {{ $block['content']['subtitle_line_height'] ?? '22' }}px; color: {{ $blocks['settings']['content']['dark_mode'] ? '#fafafa' : '#333333' }}; font-weight: {{ $block['content']['subtitle_weight'] ?? 'bold' }};">
                {{ $block['content']['subtitle'] }}
            </h2>
            @endif
            @if(isset($block['content']['list_items']) && !empty($block['content']['list_items']))
            <ul style="padding: 0; margin: 0 0 10px 0; list-style-type: disc;">
                @foreach(explode("\n", $block['content']['list_items']) as $item)
                    @if(!empty(trim($item)))
                    <li style="margin: {{ $loop->last ? '0 0 10px 30px' : '0 0 0 30px' }}; color: {{ $block['content']['text_color'] ?? '#000000' }} !important;" class="{{ $loop->first ? 'list-item-first' : ($loop->last ? 'list-item-last' : '') }}">
                        {{ $item }}
                    </li>
                    @endif
                @endforeach
            </ul>
            @endif
            @if(isset($block['content']['secondary_text']))
            <p style="margin: 0;">{{ $block['content']['secondary_text'] }}</p>
            @endif
        </td>
    </tr>
    @endif
</table>
