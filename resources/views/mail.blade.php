<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no"> <!-- Tell iOS not to automatically link certain text strings. -->
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>ANFABRA</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- What it does: Makes background images in 72ppi Outlook render at correct size. -->
    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
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
                font-family: 'Roboto', arial, sans-serif !important;
            }
        </style>
    <![endif]-->

    <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:300, 400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>
        @media screen {
            @font-face {
                font-family:'Gilroy ExtraBold';
                font-style:extrabold;
                font-weight:900;
                font-display:swap;
                src:url(https://media.beonworldwide.com/newsletters/anfabra/nov/Gilroy-ExtraBold.woff) format('woff');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }
        }
        /* What it does: Tells the email client that only light styles are provided but the client can transform them to dark. A duplicate of meta color-scheme meta tag above. */
        :root {
          color-scheme: light;
          supported-color-schemes: light;
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

        /* What it does: Replaces default bold style. */
        th {
        	font-weight: normal;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
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

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
           display: none !important;
           opacity: 0.01 !important;
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


        }

    </style>
    <!-- Progressive Enhancements : END -->

</head>
<!--
	The email background color (#00283C) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #ffffff;">
  <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: #ffffff;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #ffffff;">
    <tr>
    <td>
    <![endif]-->

        <!-- Visually Hidden Preheader Text : BEGIN -->
        <div style="max-height:0; overflow:hidden; mso-hide:all;" aria-hidden="true">

        </div>
        <!-- Visually Hidden Preheader Text : END -->

        <!-- Create white space after the desired preview text so email clients don’t pull other distracting text into the inbox preview. Extend as necessary. -->
        <!-- Preview Text Spacing Hack : BEGIN -->
        <div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: 'Roboto', arial, sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
        <!-- Preview Text Spacing Hack : END -->
        <div style="width: 600px; margin: 0 auto; background: #00283C;" class="email-container">
            <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
            <td>
            <![endif]-->
            <!-- Email Body : BEGIN -->
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto; background-color: #00283C;" class="email-container">

                <!-- Email Header : BEGIN -->
                <tr>
                    <td style="padding: 20px 0; text-align: center">
                        <img src="https://media.beonworldwide.com/newsletters/anfabra/nov/hero.png" width="440" height="" alt="ANFABRA" border="0" style="height: auto; background: #00283C; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                    </td>
                </tr>
                <!-- Email Header : END -->

                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td style="background-color: #00283C;">
                        <table role="presentation" cellspacing="0" cellpadding="0" align="center" border="0" width="550">
                            <tr>
                                <td style="padding: 20px 0; font-family: Gilroy ExtraBold, sans-serif; font-weight: 900; font-size: 16px; line-height: 27px; letter-spacing: 3px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 20px; font-size: 18px; line-height: 27px; color: #FF9537; font-weight: bold;">ASOCIACIÓN DE BEBIDAS REFRESCANTES 2023</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #00283C;">
                        <table role="presentation" cellspacing="0" cellpadding="0" align="center" border="0" width="600">
                            <tr>
                                <td style="padding: 0; text-align: center">
                                    <img src="https://media.beonworldwide.com/newsletters/anfabra/nov/logo.png" width="570" height="128" alt="ANFABRA" border="0" style="height: auto; background: #00283C; font-family: 'Roboto', arial, sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- CLEAR SPACE -->
                <tr>
                    <td aria-hidden="true" height="60" style="font-size: 0px; line-height: 0px; background-color: #00283C;">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #00283C;">
                        <table role="presentation" cellspacing="0" cellpadding="0" align="center" border="0" width="550">
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Black', arial, sans-serif; font-size: 24px; line-height: 28px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 10px; font-size: 24px; line-height: 28px; color: #ffffff; font-weight: normal;">
                                        GRACIAS
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Light', arial, sans-serif; font-size: 20px; line-height: 28px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 10px; font-size: 20px; line-height: 28px; color: #FF9537; font-weight: normal;">
                                        Muchas gracias por acompañarnos en nuestro encuentro anual <b>‘Transformando el futuro de los refrescos’</b>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Light', arial, sans-serif; font-size: 20px; line-height: 28px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 10px; font-size: 20px; line-height: 28px; color: #FF9537; font-weight: normal;">
                                        Ha sido un placer compartir contigo nuestros compromisos con el bienestar de los consumidores y celebrar juntos que, en menos de 20 años, <b>¡hemos conseguido reducir un 45% el contenido en azúcar de los refrescos en España!</b>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Light', arial, sans-serif; font-size: 20px; line-height: 28px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 10px; font-size: 20px; line-height: 28px; color: #FF9537; font-weight: normal;">
                                        Esperamos que hayas disfrutado de la jornada tanto como nosotros.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Light', arial, sans-serif; font-size: 20px; line-height: 28px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 10px; font-size: 20px; line-height: 28px; color: #FF9537; font-weight: normal;">
                                        Te enviamos un video resumen como recuerdo del <b>ENCUENTRO ANUAL DEL SECTOR DE LAS BEBIDAS REFRESCANTES 2023</b>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="600" bgcolor="#00283C" valign="top" align="center" style="text-align: center;">
                                    <table width="500" role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" valign="top">
                                        <tr>
                                            <td width="500" bgcolor="#00283C" valign="top" align="center" style="text-align: center;">
                                                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0"
                                                    style="margin: 0;">
                                                    <tr>
                                                        <td width="60" align="center">
                                                            <p class="center" style="text-align: left; vertical-align: bottom; font-family: Scania Sans Bold, sans-serif; font-weight: 700; font-size: 18px; line-height: 30px; color: #ffffff; margin: 0; border-bottom: 2px solid #34A483;">
                                                                &nbsp;
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Light', arial, sans-serif; font-size: 20px; line-height: 28px; color: #ffffff;">
                                    <p style="text-align:center; margin: 0 0 10px; font-size: 20px; line-height: 28px; color: #FF9537; font-weight: normal;">
                                        Síguenos en:
                                    </p>
                                </td>
                            </tr>
                            <!-- 2 Even Columns : BEGIN -->
                            <tr>
                                <td style="padding: 0; background-color: #00283C;" align="center" class="darkmode-bg">
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100">
                                        <tr>
                                            <td valign="middle" width="50%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: right; padding: 0 10px;">
                                                            <img src="https://media.beonworldwide.com/newsletters/anfabra/nov/in.png" width="29" height="" alt="linkedin" border="0" style="width: 29px; max-width: 29px; height: auto; background: #00283C; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block; text-align: right;" class="g-img">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td valign="bottom" width="50%">
                                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                                    <tr>
                                                        <td style="text-align: left; padding: 0 10px;">
                                                            <img src="https://media.beonworldwide.com/newsletters/anfabra/nov/x.png" width="29" height="" alt="x" border="0" style="width: 29px; max-width: 29px; height: auto; background: #00283C; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block; text-align: left;" class="g-img">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- 2 Even Columns : END -->

                        </table>
                    </td>
                </tr>

                <!-- 1 Column Text + Button : END -->
                <tr>
					<td width="600" bgcolor="#00283C" valign="top" align="center" style="text-align: center;">
						<table width="500" role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" valign="top">
							<tr>
								<td width="500" bgcolor="#00283C" valign="top" align="center" style="text-align: center;">
									<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0"
										style="margin: 0;">
										<tr>
											<td width="60" align="center">
												<p class="center" style="text-align: left; vertical-align: bottom; font-family: Scania Sans Bold, sans-serif; font-weight: 700; font-size: 18px; line-height: 30px; color: #ffffff; margin: 0; border-bottom: 2px solid #34A483;">
                                                    &nbsp;
                                                </p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>

                <tr>
                    <td aria-hidden="true" height="30" style="font-size: 0px; line-height: 0px; background-color: #00283C;">
                        &nbsp;
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0; background-color: #00283C;">
                        <table role="presentation" cellspacing="0" cellpadding="0" align="center" border="0" width="550">
                            <tr>
                                <td style="padding: 20px 20px; font-family: 'Roboto Regular', arial, sans-serif; font-size: 33px; line-height: 39px; color: #FF9537; background-color: #00283C;">
                                    <p style="text-align:center; padding: 10px; font-size: 33px; line-height: 39px; color: #FF9537; font-weight: normal;"><a href="http://www.refrescantes.es" style="text-decoration: none; color: #FF9537;text-align:center; padding: 10px; font-size: 33px; line-height: 39px; color: #FF9537; font-weight: normal;">www.refrescantes.es</a></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
            <!-- Email Body : END -->
            <!-- Email Footer : BEGIN -->
            <table align="center" bgcolor="#00283C" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="margin: auto;" class="footer">
                <tr>
                    <td align="center" style="background-color: #00283C;">
                        <img src="https://media.beonworldwide.com/newsletters/anfabra/nov/footer.png" width="405" height="" alt="Anfabra" border="0" style="width: 405px; max-width: 405px; height: auto; background: #00283C; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block; text-align: center;" class="g-img">
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
