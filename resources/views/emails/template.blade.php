<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no"> <!-- Tell iOS not to automatically link certain text strings. -->
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ $blocks['settings']['content']['title'] ?? 'Newsletter Template' }}</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <!-- Web Font / @font-face : BEGIN -->
    <!-- NOTE: If web fonts are not required, lines 23 - 41 can be safely removed. -->

    <!-- Desktop Outlook chokes on web font references and defaults to Times New Roman, so we force a safe fallback font. -->
    <!--[if mso]>
        <style>
            * {
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: https://web.archive.org/web/20190717120616/http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Tells the email client that both light and dark styles are provided. A duplicate of meta color-scheme meta tag above. */
        :root {
          color-scheme: light dark;
          supported-color-schemes: light dark;
        }

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: forces Samsung Android mail clients to use the entire viewport */
        #MessageViewBody, #MessageWebViewDiv{
            width: 100% !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        a[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links a,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>
    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

	    /* What it does: Hover styles for buttons */
	    .button-td,
	    .button-a {
	        transition: all 100ms ease-in;
	    }
	    .button-td-primary:hover,
	    .button-a-primary:hover {
	        background: #555555 !important;
	        border-color: #555555 !important;
	    }

	    /* Media Queries */
	    @media screen and (max-width: 600px) {

	        /* What it does: Adjust typography on small screens to improve readability */
	        .email-container p {
	            font-size: 17px !important;
	        }

	    }

        /* Dark Mode Styles : BEGIN */
        /* @media (prefers-color-scheme: dark) {
			.email-bg {
				background: #ededed !important;
			}
            .darkmode-bg {
                background: #fafafa !important;
            }
			h1,
			h2,
			h3,
			p,
			li,
			.darkmode-text,
			.email-container a:not([class]) {
				color: #F7F7F9 !important;
			}
			td.button-td-primary,
			td.button-td-primary a {
				background: #ffffff !important;
				border-color: #ffffff !important;
				color: #222222 !important;
			}
			td.button-td-primary:hover,
			td.button-td-primary a:hover {
				background: #cccccc !important;
				border-color: #cccccc !important;
			}
			.footer td {
				color: #aaaaaa !important;
			}
            .darkmode-fullbleed-bg {
                background-color: #0F3016 !important;
            }
		} */
        /* Dark Mode Styles : END */
    </style>
    <!-- Progressive Enhancements : END -->

</head>
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }} !important;" class="email-bg">
    <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }} !important;" class="email-bg">
        <!--[if mso | IE]>
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: {{ $blocks['settings']['content']['background_color'] ?? '#ebebeb' }} !important;" class="email-bg">
        <tr>
        <td>
        <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="max-height:0; overflow:hidden; mso-hide:all;" aria-hidden="true">
            {{ $blocks['settings']['content']['preheader'] ?? 'Newsletter preview text' }}
        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
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
                @php
                    $orderedBlocks = collect($blocks)
                        ->filter(function($block, $name) {
                            return $name !== 'settings';
                        })
                        ->sortBy(function($block) {
                            return $block['order'] ?? PHP_INT_MAX;
                        });
                @endphp
                @foreach($orderedBlocks as $blockName => $block)
                    <tr>
                        <td style="background-color: {{ $block['content']['background_color'] ?? '#fafafa' }}; padding: 0px;" class="darkmode-bg">
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
                            <tr>
                                <td style="background-color: {{ $block['content']['background_color'] ?? '#fafafa' }};" class="darkmode-bg">
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
                                </td>
                            </tr>
                            @elseif($blockName == 'two_columns')
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
                            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="darkmode-bg">
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
                            @endif
                        </td>
                    </tr>
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
