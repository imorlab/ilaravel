<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td valign="middle" width="50%">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                @if(isset($block['content']['left']['icon']) || isset($block['content']['left']['label']))
                <tr>
                    <td valign="middle" width="250" align="center">
                        <table cellspacing="0" cellpadding="0" border="0" width="250" align="center">
                            <tr>
                                @if(isset($block['content']['left']['icon']))
                                <td width="{{ $block['content']['left']['icon_width'] ?? '30' }}">
                                    <img src="{{ $block['content']['left']['icon'] }}"
                                        alt="" width="{{ $block['content']['left']['icon_width'] ?? '30' }}" height="" border="0"
                                        align="center" class="darkmode-bg"
                                        style="width: {{ $block['content']['left']['icon_width'] ?? '30' }}px; max-width: {{ $block['content']['left']['icon_width'] ?? '30' }}px; height: auto; background: #fafafa; mso-height-rule: exactly;">
                                </td>
                                <td aria-hidden="true" width="10" style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
                                    &nbsp;
                                </td>
                                @endif
                                @if(isset($block['content']['left']['label']))
                                <td width="{{ isset($block['content']['left']['icon']) ? '210' : '250' }}" align="left">
                                    <p style="font-family: Arial, Helvetica, sans-serif; font-weight: 400; padding: 0; font-size: 12px; font-weight: 400; line-height: 18px; color: #000000; text-align: left; text-transform: uppercase;">
                                        {{ $block['content']['left']['label'] }}
                                    </p>
                                </td>
                                @endif
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td aria-hidden="true" height="20"
                        style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
                        &nbsp;
                    </td>
                </tr>
                @endif
                @if(isset($block['content']['left']['title']))
                <tr>
                    <td align="left">
                        <p style="font-family: Century Gothic, sans-serif; padding: 0; font-size: 26px; font-weight: 700; line-height: 30px; color: #000000; text-align: left; margin: 0 0 0 20px;">
                            @if(isset($block['content']['left']['highlight_text']))
                            <span style="color: {{ $block['content']['left']['highlight_color'] ?? '#78CBCF' }};">{{ $block['content']['left']['highlight_text'] }}</span>
                            @endif
                            {{ $block['content']['left']['title'] }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td aria-hidden="true" height="20"
                        style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
                        &nbsp;
                    </td>
                </tr>
                @endif
                @if(isset($block['content']['left']['text']))
                <tr>
                    <td align="left">
                        <p style="font-family: Arial, Helvetica, sans-serif; padding: 0; font-size: 14px; font-weight: 400; line-height: 20px; color: #000000; text-align: left; margin: 0 0 0 20px;">
                            {{ $block['content']['left']['text'] }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td aria-hidden="true" height="20"
                        style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
                        &nbsp;
                    </td>
                </tr>
                @endif
                @if(isset($block['content']['left']['button_text']) && isset($block['content']['left']['button_url']))
                <tr>
                    <td width="250" align="{{ $block['content']['left']['button_alignment'] ?? 'center' }}" style="font-weight: bold; text-align: {{ $block['content']['left']['button_alignment'] ?? 'center' }}; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #000000; padding: 20px; background-color: #fafafa; margin: 0;" class="darkmode-bg">
                        <table cellspacing="0" cellpadding="0" border="0" width="250" align="{{ $block['content']['left']['button_alignment'] ?? 'center' }}">
                            <tr>
                                <td align="{{ $block['content']['left']['button_alignment'] ?? 'center' }}" style="font-family: Arial, Helvetica, sans-serif; text-align: {{ $block['content']['left']['button_alignment'] ?? 'center' }}; vertical-align: middle;">
                                    <div class="btn-rounded" style="font-family: Arial, Helvetica, sans-serif;">
                                        <!--[if mso]>
                                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                                            href="{{ $block['content']['left']['button_url'] }}"
                                            style="height:34px;v-text-anchor:middle;width:100px;" arcsize="95%" stroke="f" fillcolor="{{ $block['content']['left']['button_background'] ?? '#007bff' }}">
                                            <w:anchorlock/>
                                            <center style="font-family: Arial, Helvetica, sans-serif; color:{{ $block['content']['left']['button_text_color'] ?? '#fafafa' }}; font-size:12px; font-weight:bold; line-height:16px; text-align:center; display: block; margin: auto 0;">
                                                {{ $block['content']['left']['button_text'] }}
                                            </center>
                                        </v:roundrect>
                                        <![endif]-->
                                        <!--[if !mso]><!-->
                                        <a class="keep-black" href="{{ $block['content']['left']['button_url'] }}"
                                            style="display: inline-block; font-weight: bold; background-color: {{ $block['content']['left']['button_background'] ?? '#007bff' }}; border-radius:32px; color: {{ $block['content']['left']['button_text_color'] ?? '#fafafa' }}; font-family: Arial, Helvetica, sans-serif; font-size:12px; line-height:34px; text-align:center; text-decoration:none; width:100px; -webkit-text-size-adjust:none; height: 34px; vertical-align: middle;">
                                            {{ $block['content']['left']['button_text'] }}
                                        </a>
                                        <!--<![endif]-->
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endif
            </table>
        </td>
        <td aria-hidden="true" width="20" style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
            &nbsp;
        </td>
        <td width="{{ $block['content']['right']['width'] ?? '280' }}" valign="middle" align="center" style="text-align: right;">
            <img src="{{ $block['content']['right']['image'] }}"
                alt="{{ $block['content']['right']['alt'] ?? '' }}"
                width="{{ $block['content']['right']['width'] ?? '280' }}"
                height="" border="0" align="center"
                class="darkmode-bg"
                style="width: {{ $block['content']['right']['width'] ?? '280' }}px; max-width: {{ $block['content']['right']['width'] ?? '280' }}px; height: auto; background: #fafafa; mso-height-rule: exactly;">
        </td>
    </tr>
</table>
