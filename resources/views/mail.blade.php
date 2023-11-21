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
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

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
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">  -->
    <!--<![endif]-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

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
	            font-size: 20px !important;
	        }

	    }

        /* Dark Mode Styles : BEGIN */
        @media (prefers-color-scheme: dark) {
			.email-bg {
				background: #222222 !important;
			}
            .darkmode-bg {
                background: #3D72AB !important;
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
				background: #FFCC3E !important;
				border-color: #FD9F00 !important;
				color: #F4391B !important;
			}
			td.button-td-primary:hover,
			td.button-td-primary a:hover {
				background: #FFCC3E !important;
				border-color: #FD9F00 !important;
                color: #F4391B !important;
			}
			.footer td {
				color: #F7F7F9 !important;
			}
            .darkmode-fullbleed-bg {
                background-color: #111111 !important;
            }
		}
        /* Dark Mode Styles : END */
    </style>
    <!-- Progressive Enhancements : END -->

</head>
<!--
	The email background color (#ffffff) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #ffffff;" class="email-bg">
	<center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: #ffffff;" class="email-bg">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff;" class="email-bg">
    <tr>
    <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="max-height:0; overflow:hidden; mso-hide:all;" aria-hidden="true">

        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
	        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
        -->
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
            <td>
            <![endif]-->

	        <!-- Email Body : BEGIN -->
	        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;">

                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td style="background-color: #3D72AB;">
                        <img src="https://media.beonworldwide.com/newsletters/airbus/carteros_reales/hero.png" width="600" height="" alt="alt_text" border="0" style="width: 100%; height: auto; background: #ffffff; margin: 0; display: block;" class="darkmode-bg">
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td width="600" style="background-color: #3D72AB;" class="darkmode-bg">
                        <table role="presentation" cellspacing="0" cellpadding="0" align="center" border="0" width="475">
                            <!-- Hero Image, Flush : END -->
                            <tr>
                                <td aria-hidden="true" height="40" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                            <!-- 2 Even Columns : BEGIN -->
                            <tr>
                                <td style="background-color: #3D72AB;" class="darkmode-bg">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="475">
                                        <tr>
                                            <td style="text-align: left; font-family: 'Montserrat Black', sans-serif; font-size: 24px; line-height: 26px; font-weight: bold; color: #FFE82E; padding: 0px 0px 0px 20px;">
                                                <span style="margin: 0; font-family: 'Montserrat Black', sans-serif; font-size: 24px; line-height: 26px; font-weight: bold; color: #FFE82E;">¡Los Carteros Reales ya están aquí!</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                            <!-- 2 Even Columns : END -->
                            <tr>
                                <td style="padding: 0; font-family: 'Montserrat Regular', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                    <p style="margin: 0; font-family: 'Montserrat Regular', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                        ¡Un año más vuelven los emisarios de los Reyes Magos! Airbus hará entrega de los regalos a los hijos de empleados, y queremos compartir este momento en un acto en el que los más pequeños también podrán hacer entrega de las cartas para Sus Majestades.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; font-family: 'Montserrat Regular', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                    <p style="margin: 0; font-family: 'Montserrat Regular', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                        Os invitamos a participar a todos los padres y madres con hijos entre 0 y 12 años (nacidos a partir del 01/01/2011) que trabajéis en Tablada y San Pablo. Además, os pedimos que, en medida de lo posible, traigáis un juguete en buen estado para donarlo a una ONG, ayudando así a que otros niños sin recursos también puedan disfrutar de la magia de la Navidad.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; font-family: 'Montserrat Regular', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                    <p style="margin: 0; font-family: 'Montserrat Regular', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                        Por motivos de Seguridad, el acceso a la Planta será mediante invitación, por lo que no olvides traerla el día del evento, así como tu tarjeta de empleado. Asimismo, os recordamos que podéis traer vuestro desayuno de casa.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; font-family: 'Montserrat Light', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                    <p style="margin: 0; font-family: 'Montserrat Light', sans-serif; font-size: 18px; line-height: 26px; color: #555555;">
                                        (Recuerda que es necesario tener a tus hijos dados de alta en MyPulse)
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0; font-family: 'Montserrat Light', sans-serif; font-style: italic; font-size: 18px; line-height: 26px; color: #555555;">
                                    <p style="margin: 0; font-family: 'Montserrat Light', sans-serif; font-style: italic; font-size: 18px; line-height: 26px; color: #555555;">
                                        *Cada empleado es responsable de los acompañantes con los que acceda a la planta.
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td style="background-color: #3D72AB;" class="darkmode-bg">
                        <table role="presentation" cellspacing="0" cellpadding="0" align="center" border="0" width="475">
                            <tr>
                                <td aria-hidden="true" height="60" style="font-size: 0; line-height: 0px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <!-- 2 Even Columns : BEGIN -->
                            <tr>
                                <td style="background-color: #3D72AB;" class="darkmode-bg">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="475">
                                        <tr>
                                            <td valign="middle" width="10%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0;">
                                                            <img src="https://media.beonworldwide.com/newsletters/airbus/carteros_reales/clock.png" width="79" height="" alt="alt_text" border="0" style="width: 79px; max-width: 79px; background: #3D72AB; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;" class="darkmode-bg">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td aria-hidden="true" width="10" style="font-size: 0; line-height: 0px;">
                                                &nbsp;
                                            </td>
                                            <td valign="middle" width="80%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: left; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 18px; line-height: 26px; color: #555555;">
                                                            <p style="margin: 0; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 18px; line-height: 26px; color: #555555;">16 de diciembre 2023, De 10:00h a 13:00h</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: #3D72AB;" class="darkmode-bg">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="475">
                                        <tr>
                                            <td valign="middle" width="10%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: center; padding: 0;">
                                                            <img src="https://media.beonworldwide.com/newsletters/airbus/carteros_reales/star.png" width="55" height="" alt="alt_text" border="0" style="width: 55px; max-width: 55px; background: #3D72AB; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; padding-left: 10px;" class="darkmode-bg">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td aria-hidden="true" width="10" style="font-size: 0; line-height: 0px;">
                                                &nbsp;
                                            </td>
                                            <td valign="middle" width="80%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: left; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 18px; line-height: 26px; color: #555555;">
                                                            <p style="margin: 0; font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 18px; line-height: 26px; color: #555555;">
                                                                Explanada de Airframe, Nave A400M <br>
                                                                (San Pablo)</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="60" style="font-size: 0; line-height: 0px;">
                                    &nbsp;
                                </td>
                            </tr>
                            <!-- 2 Even Columns : END -->
                            <tr>
                                <td style="padding: 0 20px;">
                                    <!-- Button : BEGIN -->
                                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                        <tr>
                                            <td class="button-td button-td-primary" style="border-radius: 4px; background: #FFCC3E;">
											     <a class="button-a button-a-primary" href="https://google.com/" style="background: #FFCC3E; border: 3px solid #FD9F00; font-family: 'Montserrat Black', sans-serif; font-size: 18px; line-height: 26px; text-decoration: none; padding: 23px 67px; color: #F4391B; display: block; border-radius: 4px; text-transform: uppercase;">
                                                    Confirmar asistencia
                                                </a>
											</td>
                                        </tr>
                                    </table>
                                    <!-- Button : END -->
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="20" style="font-size: 0; line-height: 0px;">
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->

            </table>
            <!-- Email Body : END -->

            <!-- Email Footer : BEGIN -->
	        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;" class="footer">
                <tr>
                    <td aria-hidden="true" height="10" style="font-size: 0; line-height: 0px;" class="darkmode-bg">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #3D72AB;" class="darkmode-bg">
                        <img src="https://media.beonworldwide.com/newsletters/airbus/carteros_reales/footer.png" width="600" height="" alt="alt_text" border="0" style="width: 100%; height: auto; background: #3D72AB; margin: 0; display: block;">
                    </td>
                </tr>
            </table>
            <!-- Email Footer : END -->

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
