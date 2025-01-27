<tr>
    <td style="padding: 20px; background-color: #fafafa;" class="darkmode-bg">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td width="{{ $block['content']['left']['width'] ?? '280' }}" valign="middle" align="center" style="text-align: left;">
                    <img src="{{ $block['content']['left']['image'] }}"
                        alt="{{ $block['content']['left']['alt'] ?? '' }}"
                        width="{{ $block['content']['left']['width'] ?? '280' }}"
                        height="" border="0" align="center"
                        class="darkmode-bg"
                        style="width: {{ $block['content']['left']['width'] ?? '280' }}px; max-width: {{ $block['content']['left']['width'] ?? '280' }}px; height: auto; background: #fafafa; mso-height-rule: exactly;">
                </td>
                <td aria-hidden="true" width="20" style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
                    &nbsp;
                </td>
                <td valign="middle" width="50%">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        @if(isset($block['content']['right']['icon']) || isset($block['content']['right']['label']))
                        <tr>
                            <td valign="middle" width="280" align="center">
                                <table cellspacing="0" cellpadding="0" border="0" width="250" align="center">
                                    <tr>
                                        @if(isset($block['content']['right']['icon']))
                                        <td width="{{ $block['content']['right']['icon_width'] ?? '30' }}">
                                            <img src="{{ $block['content']['right']['icon'] }}"
                                                alt="" width="{{ $block['content']['right']['icon_width'] ?? '30' }}" height="" border="0"
                                                align="center" class="darkmode-bg"
                                                style="width: {{ $block['content']['right']['icon_width'] ?? '30' }}px; max-width: {{ $block['content']['right']['icon_width'] ?? '30' }}px; height: auto; background: #fafafa; mso-height-rule: exactly;">
                                        </td>
                                        <td aria-hidden="true" width="10" style="font-size: 0px; line-height: 0px; background-color: #fafafa;" class="darkmode-bg">
                                            &nbsp;
                                        </td>
                                        @endif
                                        @if(isset($block['content']['right']['label']))
                                        <td width="{{ isset($block['content']['right']['icon']) ? '210' : '250' }}" align="left">
                                            <p style="font-family: Arial, Helvetica, sans-serif; font-weight: 400; padding: 0; font-size: 12px; font-weight: 400; line-height: 18px; color: #000000; text-align: left; text-transform: uppercase;">
                                                {{ $block['content']['right']['label'] }}
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
                        @if(isset($block['content']['right']['title']))
                        <tr>
                            <td align="left">
                                <p style="font-family: Century Gothic, sans-serif; padding: 0; font-size: 26px; font-weight: 700; line-height: 30px; color: #000000; text-align: left; margin: 0 0 0 20px;">
                                    @if(isset($block['content']['right']['highlight_text']))
                                    <span style="color: {{ $block['content']['right']['highlight_color'] ?? '#78CBCF' }};">{{ $block['content']['right']['highlight_text'] }}</span>
                                    @endif
                                    {{ $block['content']['right']['title'] }}
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
                        @if(isset($block['content']['right']['text']))
                        <tr>
                            <td align="left">
                                <p style="font-family: Arial, Helvetica, sans-serif; padding: 0; font-size: 14px; font-weight: 400; line-height: 20px; color: #000000; text-align: left; margin: 0 0 0 20px;">
                                    {{ $block['content']['right']['text'] }}
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
                        @if(isset($block['content']['right']['button_text']) && isset($block['content']['right']['button_url']))
                        <tr>
                            <td width="300" align="{{ $block['content']['right']['button_alignment'] ?? 'center' }}" style="font-weight: bold; text-align: {{ $block['content']['right']['button_alignment'] ?? 'center' }}; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #000000; padding: 20px; background-color: #fafafa; margin: 0;" class="darkmode-bg">
                                <table cellspacing="0" cellpadding="0" border="0" width="300" align="{{ $block['content']['right']['button_alignment'] ?? 'center' }}">
                                    <tr>
                                        <td align="{{ $block['content']['right']['button_alignment'] ?? 'center' }}" style="font-family: Arial, Helvetica, sans-serif; text-align: {{ $block['content']['right']['button_alignment'] ?? 'center' }}; vertical-align: middle;">
                                            <div class="btn-rounded" style="font-family: Arial, Helvetica, sans-serif;">
                                                <!--[if mso]>
                                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                                                    href="{{ $block['content']['right']['button_url'] }}"
                                                    style="height:34px;v-text-anchor:middle;width:100px;" arcsize="95%" stroke="f" fillcolor="{{ $block['content']['right']['button_background'] ?? '#007bff' }}">
                                                    <w:anchorlock/>
                                                    <center style="font-family: Arial, Helvetica, sans-serif; color:{{ $block['content']['right']['button_text_color'] ?? '#fafafa' }}; font-size:12px; font-weight:bold; line-height:16px; text-align:center; display: block; margin: auto 0;">
                                                        {{ $block['content']['right']['button_text'] }}
                                                    </center>
                                                </v:roundrect>
                                                <![endif]-->
                                                <!--[if !mso]><!-->
                                                <a class="keep-black" href="{{ $block['content']['right']['button_url'] }}"
                                                    style="display: inline-block; font-weight: bold; background-color: {{ $block['content']['right']['button_background'] ?? '#007bff' }}; border-radius:32px; color: {{ $block['content']['right']['button_text_color'] ?? '#fafafa' }}; font-family: Arial, Helvetica, sans-serif; font-size:12px; line-height:34px; text-align:center; text-decoration:none; width:100px; -webkit-text-size-adjust:none; height: 34px; vertical-align: middle;">
                                                    {{ $block['content']['right']['button_text'] }}
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
            </tr>
        </table>
    </td>
</tr>