<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td style="padding: {{ $block['content']['padding'] ?? '20' }}px; font-family: sans-serif; font-size: {{ $block['content']['font_size'] ?? '12' }}px; line-height: {{ $block['content']['line_height'] ?? '15' }}px; text-align: center; color: {{ $block['content']['text_color'] ?? '#888888' }};">
            @if(isset($block['content']['company']))
                <p style="margin: 0;">{{ $block['content']['company'] }}</p>
            @endif
            
            @if(isset($block['content']['address']))
                <p style="margin: 5px 0;">{{ $block['content']['address'] }}</p>
            @endif
            
            @if(isset($block['content']['phone']))
                <p style="margin: 5px 0;">{{ $block['content']['phone'] }}</p>
            @endif
        </td>
    </tr>
</table>
