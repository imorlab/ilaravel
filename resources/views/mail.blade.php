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
    <title>La historia interminable, el musical</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

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
                font-family: sans-serif !important;
            }
        </style>
    <![endif]-->

   <!-- All other clients get the webfont reference; some will render the font and others will silently fail to the fallbacks. More on that here: http://stylecampaign.com/blog/2015/02/webfont-support-in-email/ -->
    <!--[if !mso]><!-->
    <!-- insert web font reference, eg: <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'> -->
    <!--<![endif]-->

    <!-- Web Font / @font-face : END -->

    <!-- CSS Reset : BEGIN -->
    <style>

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

        @media screen {
            @font-face {
                font-family:'Benguiat';
                font-weight:600;
                font-display:swap;
                src:url(https://www.lahistoriainterminablemusical.com/newsletter/template/Benguiat-Bold-2.woff) format('woff');
                unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
            }
        }


        li{

            list-style: none;
            margin: 15px 0;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');


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
	        background: #fff !important;
	        border-color: #fff !important;
	    }

	    /* Media Queries */
	    @media screen and (max-width: 600px) {

	        /* What it does: Adjust typography on small screens to improve readability */
	        .email-container p {
	            font-size: 17px !important;
	        }

	    }

    </style>
    <!-- Progressive Enhancements : END -->

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://kit.fontawesome.com/771ee084d5.css" crossorigin="anonymous">

</head>
<!--
	The email background color (#222222) is defined in three places:
	1. body tag: for most email clients
	2. center tag: for Gmail and Inbox mobile apps and web versions of Gmail, GSuite, Inbox, Yahoo, AOL, Libero, Comcast, freenet, Mail.ru, Orange.fr
	3. mso conditional: For Windows 10 Mail
-->
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #050A30;">
	<center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: #050A30;">
    <!--[if mso | IE]>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #050A30;">
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
            🎟 ENTRADAS YA DISPONIBLES con un 20%dto. por compra anticipada y tiempo limitado
        </div>
        <!-- Preview Text Spacing Hack : END -->

        <!--
            Set the email width. Defined in two places:
            1. max-width for all clients except Desktop Windows Outlook, allowing the email to squish on narrow but never go wider than 600px.
            2. MSO tags for Desktop Windows Outlook enforce a 600px width.
            Note: The Fluid and Responsive templates have a different width (600px). The hybrid grid is more "fragile", and I've found that 600px is a good width. Change with caution.
        -->
        <div style="max-width: 600px; margin: 0 auto; background-color: #050A30;" class="email-container">
            <!--[if mso]>
            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600">
            <tr>
            <td>
            <![endif]-->

	        <!-- Email Body : BEGIN -->
	        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto; background-color: #050A30;" align="center">


                 <!-- Hero Image, Flush : BEGIN -->
                 <tr>
                    <td style="background-color: #050A30;" align="center">
                        <a href="https://entradas.gruposmedia.com/entradas/historiainterminable-apo?utm_source=newsletter&utm_medium=email&utm_campaign=LHI_BCN&utm_term=banner_sup" target="_blank"><img src="https://www.beon-entertainment.com/newsletter/lhi/barcelona-1-semana/bcn-1-semana.jpeg" width="600" height="auto" alt="La Historia Interminable" border="0" style="display: block;"></a>
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->



                <!-- 1 Column Text + Button : BEGIN -->
                <tr>
                    <td style="background-color: #050A30; color:#EFC317;">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="600" style="background-color: #050A30;">

                            <tr>
                                <td style="padding: 0px 40px; font-family: 'Montserrat', sans-serif; line-height: 20px; color: #fff; text-align: center;" align="center">
                                    <p style="font-size: 24px; line-height: 34px; ">
                                        ¡Agarra tu Auryn y prepárate porque La historia interminable, el musical llega a <span style="color:#EFC317; font-weight: bold;">BARCELONA</span>!
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px; background-color: #050A30;" class="darkmode-bg">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                        <tr>
                                            <td align="center">
                                                <table valign="center" width="500" cellspacing="0" cellpadding="0" border="0">
                                                    <tr>
                                                        <td valign="center" align="center" style="background-color: #050A30; color: #ffffff; width: 500px; height: 100%; padding: 0px;">
                                                            <img src="https://gen.sendtric.com/countdown/wm4k0jaxlx" style="display: block;width:500px" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 40px; font-family: 'Montserrat', sans-serif; line-height: 20px; color: #fff; text-align: center;" align="center">
                                    <p style="margin: 0 0 0px; font-size: 20px; line-height: 32px; ">
                                        Ven a conocer a Bastian, Atreyu,  Fújur, Ártax y todos los personajes del Reino de Fantasia a partir del 22 de noviembre en el Teatre Apolo
                                    </p>
                                </td>
                            </tr>


                            <tr>
                                <td style="padding: 60px; font-family: 'Montserrat', sans-serif; line-height: 20px; color: #fff; text-align: center;" align="center">
                                    <p style="font-size: 22px; line-height: 38px;">
                                        <span style="color:#fff; font-weight: bold;">Si compras tus entradas esta semana obtendrás un<br>
                                        <span style="color:#EFC317; font-weight: bold; font-size: 32px;">20% de descuento...</span> <br>
                                        ¡Vuela, quedan muy pocos días para que acabe la promoción!
                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding: 20px;">
                                    <!-- Button : BEGIN -->
                                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto;">
                                        <tr>
                                            <td class="button-td button-td-primary" style="border-radius: 4px; background: #EFC317; padding: 8px 12px;" align="center">
											     <a class="button-a button-a-primary" href="https://entradas.gruposmedia.com/entradas/historiainterminable-apo?utm_source=newsletter&utm_medium=email&utm_campaign=LHI_BCN&utm_term=btn_entradas" target="_blank" style="background: #EFC317; border: 1px solid #EFC317; font-family: 'Montserrat', sans-serif; font-size: 16px; font-weight: bold; line-height: 15px; text-decoration: none; padding: 8px 12px; color: #050A30; display: block; border-radius: 4px; text-align: center;">ENTRADAS DISPONIBLES</a>
											</td>
                                        </tr>
                                    </table>
                                     <!-- Button : END -->
                                </td>
                            </tr>


                            <tr>
                                <td style="padding: 0 20px 0px;" align="center">
                                    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: auto; background-color: #050A30;">
                                        <tr style="text-align: center;">
                                            <td align="center">
                                                <a href="https://www.lahistoriainterminablemusical.com/" target="_blank">
                                                    <img src="https://www.beon-entertainment.com/newsletter/lhi/ZARAGOZA/logos%20premios.png" width="550" height="auto" alt="la historia interminable" border="0" align="center" style="width: 550px; max-width: 550px; height: auto; background: #050A30; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block; text-align: center;" class="g-img">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 20px; text-align: center;">
                                                <p style="margin: 0px; font-size: 24px; line-height: 30px; color: #EFC317; font-weight: bold; font-family: 'Benguiat', 'Times New Roman', Times, serif; text-align: center;">DONDE SIEMPRE<br>QUERRÁS VOLVER</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding:20px 0" align="center">
                                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" align="center" style="max-width: 600px; background-color: #050A30;">
                                        <tr>
                                            <td style="color: #ffffff; text-align: center;" align="center">
                                                <p style="margin:0px; font-size: 16px; line-height: 20px; color: #ffffff; font-weight: bold; font-family: 'Benguiat', 'Times New Roman', Times, serif;">Más información</p>
                                                <a href="https://www.lahistoriainterminablemusical.com/" target="_blank" style="color:#EFC317">lahistoriainterminablemusical.com</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- 1 Column Text + Button : END -->



            </table>
            <!-- Email Body : END -->

            <!-- Email Footer : BEGIN -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="max-width: 600px; background-color: #050A30;">
                <tr>
                    <td style="background-color: #050A30; padding: 20px; text-align: center;">
                        <p style="margin: 0px; font-size: 8px; color: #fff; text-align: center;">UNA PRODUCCIÓN DE</p>
                        <a href="https://www.beon-entertainment.com/" target="_blank">
                            <img src="https://beon-entertainment.com/newsletter/lhi/template/logo-beon-entertainment.png" width="120" height="auto" alt="beon entertainment" border="0" align="center" style=" max-width: 120px; height: auto; margin: auto; text-align: center;" class="g-img">
                        </a>

                    </td>
                </tr>
                <tr>
                    <td>
                        <p style=" font-family: sans-serif; line-height: 20px; color: #fff; text-align: center; margin: 0px; font-size: 16px;">Otros espectáculos de beon. Entertainment:</p>
                    </td>
                </tr>

                 <!-- Hero Image, Flush : BEGIN -->
                 <tr>
                    <td style="background-color: #050A30; padding: 10px;" align="center">
                        <a href="https://www.beon-entertainment.com/el-tiempo-entre-costuras-musical/" target="_blank"><img src="https://www.beon-entertainment.com/newsletter/beon-entertainment/template/imagen/etec.jpg" width="500" height="auto" alt="La Historia Interminable" style=" border:1px solid #EFC317; max-width: 500px; height: auto; margin: auto; display: block;" class="g-img"></a>
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td style="background-color: #050A30; padding: 10px;" align="center">
                        <a href="https://www.beon-entertainment.com/forever-van-gogh/" target="_blank"><img src="https://www.beon-entertainment.com/newsletter/beon-entertainment/template/imagen/fvg.jpg" width="500" height="auto" alt="La Historia Interminable" style=" border:1px solid #EFC317; max-width: 500px; height: auto; margin: auto; display: block;" class="g-img"></a>
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

                <!-- Hero Image, Flush : BEGIN -->
                <tr>
                    <td style="background-color: #050A30; padding: 10px;" align="center">
                        <a href="https://www.beon-entertainment.com/shakespeare-97-minutos/" target="_blank"><img src="https://www.beon-entertainment.com/newsletter/beon-entertainment/template/imagen/shakespeare.jpg" width="500" height="auto" alt="La Historia Interminable" style=" border:1px solid #EFC317; max-width: 500px; height: auto; margin: auto; display: block;" class="g-img"></a>
                    </td>
                </tr>
                <!-- Hero Image, Flush : END -->

            </table>
            <!-- Email Footer : END -->

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="max-width: 600px; background-color: #050A30;">

                <!-- SEPARADOR : BEGIN -->
                <tr>
                    <td style="background-color: #050A30; padding: 20px 0;" align="center">
                        <img src="https://www.beon-entertainment.com/newsletter/lhi/SEMANA-SANTA/auryn-(1)-(1).png" width="580" height="" alt="auryn" border="0" style="width: 580px; max-width: 580px; height: auto; background: #050A30; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img">
                    </td>
                </tr>
                <!-- SEPARADOR : END -->



                <tr style="text-align: center;">
                    <td style="padding:20px 0" align="center">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="450" align="center">
                            <tr>
                                <td style="font-family: sans-serif; line-height: 20px; color: #fff; text-align: center;" align="center">
                                    <h4 style="margin:0px; font-size: 14px; line-height: 20px; color: #fff; font-weight: bold; font-family: 'Montserrat', sans-serif; text-align: center;">Síguenos en redes sociales y sé el primero en enterarte de nuestras novedades y promociones</h4>
                                </td>
                            </tr>
                            <!-- REDES SOCIALES -->
                            <tr>
                                <td align="center">
                                    <table align="center">
                                        <tr style="text-align: center;">
                                            <td style="padding:10px">
                                                <a href="https://www.instagram.com/lahistoriainterminablemusical/" target="_blank"><img src="https://beon-entertainment.com/newsletter/lhi/template/rrss/instagram.png" alt="instagram" width="26"></a>
                                            </td>
                                            <td style="padding:10px">
                                                <a href="https://www.facebook.com/lahistoriainterminablemusical" target="_blank"><img src="https://beon-entertainment.com/newsletter/lhi/template/rrss/facebook.png" alt="faebook" width="26"></a>
                                            </td>
                                            <td style="padding:10px">
                                                <a href="https://www.tiktok.com/@lhimusical" target="_blank"><img src="https://beon-entertainment.com/newsletter/lhi/template/rrss/tiktok.png" alt="tiktok" width="26"></a>
                                            </td>
                                            <td style="padding:10px">
                                                <a href="https://twitter.com/lhielmusical" target="_blank"><img src="https://beon-entertainment.com/newsletter/lhi/template/rrss/twitter.png" alt="twitter" width="26"></a>
                                            </td>
                                            <td style="padding:10px">
                                                <a href="https://www.youtube.com/channel/UCnttpuWyRTngiZiVqJ9Ua1Q" target="_blank"><img src="https://beon-entertainment.com/newsletter/lhi/template/rrss/youtube.png" alt="YouTube" width="26"></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!-- REDES SOCIALES -->
                        </table>
                    </td>
                </tr>

                <!-- SEPARADOR : BEGIN -->
                <tr>
                    <td style="background-color: #050A30; padding: 20px 0;" align="center">
                        <img src="https://www.beon-entertainment.com/newsletter/lhi/SEMANA-SANTA/auryn-(1)-(1).png" width="580" height="" alt="auryn" border="0" style="width: 580px; max-width: 580px; height: auto; background: #050A30; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555; margin: auto; display: block;" class="g-img">
                    </td>
                </tr>
                <!-- SEPARADOR : END -->

            </table>

            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="600" style="max-width: 600px; background-color: #050A30; color:#fff">
                <tr style="text-align: center;">
                    <td style="padding:0" align="center">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="450" align="center">
                            <tr>
                                <td style="padding:0; font-family: sans-serif; font-size: 14px; background-color: #050A30; color:#fff" align="center">
                                    <p>Copyright © 2023 beon. Entertainment<br>Todos los derechos reservados.</p>
                                    <p>Recibes este correo porque te has suscrito a alguna de las newsletter de las producciones de beon. Entertainment</p>
                                </td>
                            </tr>
                            <tr>
                                <td aria-hidden="true" height="30" style="font-size: 0; line-height: 0px;">
                                  &nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
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
