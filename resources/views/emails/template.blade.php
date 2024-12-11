<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Newsletter Template</title>

    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <!--[if mso]>
    <style>
        .email-template * {
            font-family: sans-serif !important;
        }
    </style>
    <![endif]-->

    <style>
        :root {
            color-scheme: light;
        }
        
        .email-template {
            /* What it does: Tells the email client that both light and dark styles are provided */
            color-scheme: light;
            supported-color-schemes: light;
            background-color: {{ $blocks['settings']['content']['background_color'] ?? '#fafafa' }};
        }

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        .email-template html,
        .email-template body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        .email-template * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .email-template div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        .email-template #MessageViewBody,
        .email-template #MessageWebViewDiv{
            width: 100% !important;
        }

        .email-template table,
        .email-template td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        .email-template table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        .email-template img {
            -ms-interpolation-mode:bicubic;
        }

        .email-template a {
            text-decoration: none;
        }

        .email-template a[x-apple-data-detectors],
        .email-template .unstyle-auto-detected-links a,
        .email-template .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .email-template .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        .email-template .im {
            color: inherit !important;
        }

        .email-template img.g-img + div {
            display: none !important;
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            .email-template u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-template u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        @media only screen and (min-device-width: 414px) {
            .email-template u ~ div .email-container {
                min-width: 414px !important;
            }
        }

        /* Progressive Enhancements */
        .email-template .button-td,
        .email-template .button-a {
            transition: all 100ms ease-in;
        }
        .email-template .button-td-primary:hover,
        .email-template .button-a-primary:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        @media screen and (max-width: 600px) {
            .email-template .email-container p {
                font-size: 17px !important;
            }
        }

        /* Dark Mode Styles */
        @media (prefers-color-scheme: dark) {
            .email-template .email-bg {
                background: #111111 !important;
            }
            .email-template .darkmode-bg {
                background: #222222 !important;
            }
            .email-template h1,
            .email-template h2,
            .email-template h3,
            .email-template p,
            .email-template li,
            .email-template .darkmode-text,
            .email-template .email-container a:not([class]) {
                color: #F7F7F9 !important;
            }
            .email-template td.button-td-primary,
            .email-template td.button-td-primary a {
                background: #fafafa !important;
                border-color: #fafafa !important;
                color: #222222 !important;
            }
            .email-template td.button-td-primary:hover,
            .email-template td.button-td-primary a:hover {
                background: #cccccc !important;
                border-color: #cccccc !important;
            }
            .email-template .footer td {
                color: #aaaaaa !important;
            }
            .email-template .darkmode-fullbleed-bg {
                background-color: #0F3016 !important;
            }
        }
    </style>
</head>
<body class="email-template" width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }} !important;" class="email-bg">
    <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }} !important;" class="email-bg">
        <!--[if mso | IE]>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }} !important;" class="email-bg">
        <tr>
        <td>
        <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="max-height:0; overflow:hidden; mso-hide:all;" aria-hidden="true">
            {{ $preheader ?? 'Newsletter preview text' }}
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
            <td>
            <![endif]-->

            <!-- Email Body : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                @foreach($blocks as $blockName => $block)
                    @if($block['active'] && $blockName !== 'settings')
                        <tr>
                            <td style="background-color: {{ $block['content']['background_color'] ?? '#fafafa' }}; padding: 0px;">
                                @if($blockName == 'hero')
                                <tr>
                                    <td style="padding: {{ $block['content']['padding'] ?? '0' }}px 0; text-align: center; background-color: {{ $block['content']['background_color'] ?? '#fafafa' }};" class="darkmode-bg">
                                        <img src="{{ $block['content']['image'] }}" 
                                            alt="{{ $block['content']['alt'] }}"
                                            width="{{ $block['content']['width'] ?? '600' }}"
                                            style="width: {{ $block['content']['width'] ?? '600' }}px; max-width: 600px; height: auto; margin: {{ $block['content']['alignment'] == 'center' ? '0 auto' : ($block['content']['alignment'] == 'right' ? '0 0 0 auto' : '0') }}; display: block;"
                                            class="g-img">
                                    </td>
                                </tr>
                                @elseif($blockName == 'header')
                                <tr>
                                    <td style="padding: {{ $block['content']['padding'] ?? '0' }}px 0; text-align: {{ $block['content']['alignment'] ?? 'center' }}; background-color: {{ $block['content']['background_color'] ?? '#fafafa' }};" class="darkmode-bg">
                                        <img src="{{ $block['content']['image'] }}" 
                                             width="{{ $block['content']['width'] ?? '200' }}"
                                             height="{{ $block['content']['height'] ?? '50' }}"
                                             alt="{{ $block['content']['alt'] }}"
                                             border="0"
                                             style="height: auto; background: {{ $block['content']['image_background_color'] ?? '#fafafa' }}; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                    </td>
                                </tr>
                                @elseif($blockName == 'content')
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
                                @elseif($blockName == 'two_columns')
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td valign="middle" width="50%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    @if(isset($block['content']['left']['icon']) || isset($block['content']['left']['label']))
                                                    <tr>
                                                        <td valign="top" width="250" align="center">
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
                                                            <p style="font-family: Century Gothic, sans-serif; padding: 0; font-size: 26px; font-weight: 700; line-height: 30px; color: #000000; text-align: left; margin: 0;">
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
                                                            <p style="font-family: Arial, Helvetica, sans-serif; padding: 0; font-size: 14px; font-weight: 400; line-height: 20px; color: #000000; text-align: left; margin: 0;">
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
                                                        <td width="250" align="center" style="font-weight: bold; text-align: center; font-family: sans-serif; font-size: 12px; line-height: 20px; color: #000000; padding-top: 25px; padding-bottom: 30px; background-color: #fafafa; margin: 0;" class="darkmode-bg">
                                                            <table cellspacing="0" cellpadding="0" border="0" width="250" align="center">
                                                                <tr>
                                                                    <td align="center" style="font-family: Arial, Helvetica, sans-serif; text-align: center; vertical-align: middle;">
                                                                        <div class="btn-rounded" style="font-family: Arial, Helvetica, sans-serif;">
                                                                            <!--[if mso]>
                                                                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                                                                                href="{{ $block['content']['left']['button_url'] }}"
                                                                                style="height:34px;v-text-anchor:middle;width:100px;" arcsize="95%" stroke="f" fillcolor="#FFD102">
                                                                                <w:anchorlock/>
                                                                                <center style="font-family: Arial, Helvetica, sans-serif; color:#000000; font-size:12px; font-weight:bold; line-height:16px; text-align:center; display: block; margin: auto 0;">
                                                                                    {{ $block['content']['left']['button_text'] }}
                                                                                </center>
                                                                            </v:roundrect>
                                                                            <![endif]-->
                                                                            <!--[if !mso]><!-->
                                                                            <a class="keep-black" href="{{ $block['content']['left']['button_url'] }}"
                                                                                style="display: inline-block; font-weight: bold; background-color: #FFD102; border-radius:32px; color:#000000; font-family: Arial, Helvetica, sans-serif; font-size:12px; line-height:34px; text-align:center; text-decoration:none; width:100px; -webkit-text-size-adjust:none; height: 34px; vertical-align: middle;">
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
                                @elseif($blockName == 'button')
                                <!-- Button Block : BEGIN -->
                                <tr>
                                    <td style="padding: 0; background-color: {{ $block['content']['background_color'] ?? '#fafafa' }};" class="darkmode-bg">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="{{ $block['content']['container_width'] ?? '250' }}" 
                                                    align="{{ $block['content']['alignment'] ?? 'left' }}" 
                                                    style="padding-top: {{ $block['content']['padding_top'] ?? '0' }}px;
                                                           padding-bottom: {{ $block['content']['padding_bottom'] ?? '0' }}px;
                                                           padding-left: {{ $block['content']['padding_left'] ?? '0' }}px;
                                                           padding-right: {{ $block['content']['padding_right'] ?? '0' }}px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="{{ $block['content']['width'] ?? '100' }}" align="{{ $block['content']['alignment'] ?? 'left' }}" 
                                                           style="margin: {{ $block['content']['alignment'] == 'center' ? '0 auto' : '0' }};">
                                                        <tr>
                                                            <td align="{{ $block['content']['alignment'] ?? 'left' }}" 
                                                                valign="middle" 
                                                                style="text-align: {{ $block['content']['alignment'] ?? 'left' }};">
                                                                <div class="btn-rounded">
                                                                    <!--[if mso]>
                                                                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" 
                                                                               xmlns:w="urn:schemas-microsoft-com:office:word" 
                                                                               href="{{ $block['content']['url'] ?? '#' }}"
                                                                               style="height:{{ $block['content']['height'] ?? '34' }}px;
                                                                                      v-text-anchor:middle;
                                                                                      width:{{ $block['content']['width'] ?? '100' }}px;" 
                                                                               arcsize="{{ $block['content']['border_radius'] ?? '32' }}%" 
                                                                               stroke="f" 
                                                                               fillcolor="{{ $block['content']['button_background_color'] ?? '#FFD102' }}">
                                                                        <w:anchorlock/>
                                                                        <center style="color:{{ $block['content']['text_color'] ?? '#000000' }};
                                                                                     font-family:Arial, sans-serif;
                                                                                     font-size:{{ $block['content']['font_size'] ?? '12' }}px;
                                                                                     font-weight:{{ $block['content']['font_weight'] ?? 'bold' }};
                                                                                     line-height:{{ $block['content']['height'] ?? '34' }}px;">
                                                                            {{ $block['content']['text'] ?? 'ACCEDE' }}
                                                                        </center>
                                                                    </v:roundrect>
                                                                    <![endif]-->
                                                                    <!--[if !mso]><!-->
                                                                    <a href="{{ $block['content']['url'] ?? '#' }}" 
                                                                       class="keep-black"
                                                                       style="background-color: {{ $block['content']['button_background_color'] ?? '#FFD102' }}; 
                                                                              border-radius: {{ $block['content']['border_radius'] ?? '32' }}px; 
                                                                              color: {{ $block['content']['text_color'] ?? '#000000' }}; 
                                                                              display: inline-block; 
                                                                              font-family: Arial, sans-serif; 
                                                                              font-size: {{ $block['content']['font_size'] ?? '12' }}px; 
                                                                              font-weight: {{ $block['content']['font_weight'] ?? 'bold' }}; 
                                                                              line-height: {{ $block['content']['height'] ?? '34' }}px; 
                                                                              text-align: center; 
                                                                              text-decoration: none; 
                                                                              width: {{ $block['content']['width'] ?? '100' }}px; 
                                                                              height: {{ $block['content']['height'] ?? '34' }}px;
                                                                              vertical-align: middle;
                                                                              -webkit-text-size-adjust: none;">
                                                                        {{ $block['content']['text'] ?? 'ACCEDE' }}
                                                                    </a>
                                                                    <!--<![endif]-->
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <!-- Button Block : END -->
                                @elseif($blockName == 'footer')
                                {{ $block['content']['company'] }}<br>
                                {{ $block['content']['address'] }}<br>
                                {{ $block['content']['phone'] }}
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <!--[if mso]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </div>
        <!--[if mso | IE]>
        </td>
        </tr>
        </table>
        <![endif]-->
    </center>
</body>
</html>