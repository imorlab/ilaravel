<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td style="padding: {{ $block['content']['padding'] ?? '20' }}px; font-family: sans-serif; font-size: {{ $block['content']['font_size'] ?? '15' }}px; line-height: {{ $block['content']['line_height'] ?? '20' }}px; color: {{ $block['content']['text_color'] ?? '#000000' }} !important;">
            @if(isset($block['content']['title']))
                <h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: {{ $block['content']['title_font_size'] ?? '18' }}px; line-height: {{ $block['content']['title_line_height'] ?? '22' }}px; color: {{ $block['content']['title_color'] ?? '#333333' }}; font-weight: bold;">
                    {{ $block['content']['title'] }}
                </h2>
            @endif

            @if(isset($block['content']['text']))
                <p style="margin: 0 0 10px 0;">{{ $block['content']['text'] }}</p>
            @endif

            @if(isset($block['content']['button']))
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                    <tr>
                        <td class="button-td button-td-primary" style="border-radius: 4px; background: {{ $block['content']['button']['background'] ?? '#222222' }};">
                            <a class="button-a button-a-primary" href="{{ $block['content']['button']['url'] }}" style="background: {{ $block['content']['button']['background'] ?? '#222222' }}; border: 1px solid {{ $block['content']['button']['background'] ?? '#222222' }}; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: #ffffff; display: block; border-radius: 4px;">
                                {{ $block['content']['button']['text'] }}
                            </a>
                        </td>
                    </tr>
                </table>
            @endif
        </td>
    </tr>
</table>
