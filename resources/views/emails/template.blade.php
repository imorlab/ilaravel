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
            background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ffffff' }};
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
                background: #ffffff !important;
                border-color: #ffffff !important;
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
<body class="email-template" width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ffffff' }} !important;" class="email-bg">
    <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ffffff' }} !important;" class="email-bg">
        <!--[if mso | IE]>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ffffff' }} !important;" class="email-bg">
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
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
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
                            <td style="background-color: {{ $block['content']['background_color'] ?? '#f8f8f8' }}; padding: 0px;">
                                @if($blockName == 'header')
                                <img src="{{ $block['content']['logo'] }}" 
                                     alt="{{ $block['content']['alt'] }}"
                                     style="width: {{ $block['content']['width'] ?? '200' }}px; max-width: 600px;">
                                @elseif($blockName == 'hero')
                                <img src="{{ $block['content']['image'] }}" 
                                     alt="{{ $block['content']['alt'] }}"
                                     width="{{ $block['content']['width'] ?? '600' }}"
                                     style="width: {{ $block['content']['width'] ?? '600' }}px; max-width: 600px; height: auto; margin: {{ $block['content']['alignment'] == 'center' ? '0 auto' : ($block['content']['alignment'] == 'right' ? '0 0 0 auto' : '0') }}; display: block;"
                                     class="g-img">
                                @elseif($blockName == 'content')
                                <h1 style="margin: 0 0 10px 0; font-size: 25px; line-height: 30px; color: {{ $blocks['settings']['content']['dark_mode'] ? '#ffffff' : '#333333' }}; font-weight: normal;">
                                    {{ $block['content']['title'] }}
                                </h1>
                                <p style="margin: 0; font-size: 16px; line-height: 22px; color: {{ $blocks['settings']['content']['dark_mode'] ? '#aaaaaa' : '#555555' }};">
                                    {{ $block['content']['text'] }}
                                </p>
                                <div style="text-align: center; margin-top: 20px;">
                                    <a href="{{ $block['content']['button']['url'] }}" style="background: {{ $blocks['settings']['content']['dark_mode'] ? '#ffffff' : '#222222' }}; color: {{ $blocks['settings']['content']['dark_mode'] ? '#222222' : '#ffffff' }}; text-decoration: none; padding: 13px 17px; border-radius: 4px; display: inline-block;">{{ $block['content']['button']['text'] }}</a>
                                </div>
                                @elseif($blockName == 'two_columns')
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                    <tr>
                                        <td valign="top" width="50%" style="padding: 10px;">
                                            <img src="{{ $block['content']['left']['image'] }}" width="200" height="" alt="Left column image" style="width: 100%; max-width: 200px;">
                                            <p style="margin: 10px 0 0 0; color: {{ $blocks['settings']['content']['dark_mode'] ? '#aaaaaa' : '#555555' }};">{{ $block['content']['left']['text'] }}</p>
                                        </td>
                                        <td valign="top" width="50%" style="padding: 10px;">
                                            <img src="{{ $block['content']['right']['image'] }}" width="200" height="" alt="Right column image" style="width: 100%; max-width: 200px;">
                                            <p style="margin: 10px 0 0 0; color: {{ $blocks['settings']['content']['dark_mode'] ? '#aaaaaa' : '#555555' }};">{{ $block['content']['right']['text'] }}</p>
                                        </td>
                                    </tr>
                                </table>
                                @elseif($blockName == 'button')
                                <!-- Button Block : BEGIN -->
                                <tr>
                                    <td style="padding: 0; background-color: {{ $block['content']['background_color'] ?? '#ffffff' }};">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td width="{{ $block['content']['container_width'] ?? '250' }}" 
                                                    align="{{ $block['content']['alignment'] ?? 'left' }}" 
                                                    style="padding-top: {{ $block['content']['padding_top'] ?? '0' }}px;
                                                           padding-bottom: {{ $block['content']['padding_bottom'] ?? '0' }}px;
                                                           padding-left: {{ $block['content']['padding_left'] ?? '0' }}px;
                                                           padding-right: {{ $block['content']['padding_right'] ?? '0' }}px;">
                                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="{{ $block['content']['width'] ?? '100' }}" 
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