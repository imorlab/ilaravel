<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td valign="middle" width="50%">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                <tr>
                    <td valign="middle" width="250" align="center">
                        <table cellspacing="0" cellpadding="0" border="0" width="250" align="center">
                            @if(isset($block['content']['left']['icon']))
                                <tr>
                                    <td align="center" style="padding: 10px;">
                                        <img src="{{ $block['content']['left']['icon'] }}"
                                             width="50"
                                             height="50"
                                             alt="{{ $block['content']['left']['label'] ?? '' }}"
                                             border="0"
                                             style="width: 50px; max-width: 50px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; border-radius: 50%;">
                                    </td>
                                </tr>
                            @endif

                            @if(isset($block['content']['left']['label']))
                                <tr>
                                    <td align="center" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px;">
                                        <p style="margin: 0;">{{ $block['content']['left']['label'] }}</p>
                                    </td>
                                </tr>
                            @endif

                            @if(isset($block['content']['left']['title']))
                                <tr>
                                    <td align="center" style="font-family: sans-serif; font-size: 24px; line-height: 28px; color: #333333; padding: 10px;">
                                        <p style="margin: 0; font-weight: bold;">{{ $block['content']['left']['title'] }}</p>
                                    </td>
                                </tr>
                            @endif

                            @if(isset($block['content']['left']['text']))
                                <tr>
                                    <td align="center" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 10px;">
                                        <p style="margin: 0;">{{ $block['content']['left']['text'] }}</p>
                                    </td>
                                </tr>
                            @endif

                            @if(isset($block['content']['left']['button_text']) && isset($block['content']['left']['button_url']))
                                <tr>
                                    <td align="{{ $block['content']['left']['button_alignment'] ?? 'center' }}" style="padding: 10px;">
                                        <table cellspacing="0" cellpadding="0" border="0" align="{{ $block['content']['left']['button_alignment'] ?? 'center' }}">
                                            <tr>
                                                <td class="button-td button-td-primary" style="border-radius: 4px; background: {{ $block['content']['left']['button_background'] ?? '#222222' }};">
                                                    <a class="button-a button-a-primary" href="{{ $block['content']['left']['button_url'] }}" style="background: {{ $block['content']['left']['button_background'] ?? '#222222' }}; border: 1px solid {{ $block['content']['left']['button_background'] ?? '#222222' }}; font-family: sans-serif; font-size: 15px; line-height: 15px; text-decoration: none; padding: 13px 17px; color: {{ $block['content']['left']['button_text_color'] ?? '#ffffff' }}; display: block; border-radius: 4px;">
                                                        {{ $block['content']['left']['button_text'] }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        </td>

        <td aria-hidden="true" width="20" style="font-size: 0px; line-height: 0px;">
            &nbsp;
        </td>

        <td valign="middle" width="50%">
            @if(isset($block['content']['right']['image']))
                <img src="{{ $block['content']['right']['image'] }}"
                     width="{{ $block['content']['right']['width'] ?? '250' }}"
                     alt="{{ $block['content']['right']['alt'] ?? '' }}"
                     border="0"
                     style="width: 100%; max-width: {{ $block['content']['right']['width'] ?? '250' }}px; height: auto; background: #dddddd; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
            @endif
        </td>
    </tr>
</table>
