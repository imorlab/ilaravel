<tr>
    <td width="{{ $content['container_width'] ?? '250' }}" 
        align="{{ $content['alignment'] ?? 'left' }}" 
        style="font-weight: {{ $content['font_weight'] ?? 'bold' }}; 
               text-align: {{ $content['alignment'] ?? 'left' }}; 
               font-family: sans-serif; 
               font-size: {{ $content['font_size'] ?? '12' }}px; 
               line-height: {{ $content['height'] ?? '34' }}px; 
               color: {{ $content['text_color'] ?? '#000000' }}; 
               padding-top: {{ $content['padding_top'] ?? '25' }}px;
               padding-bottom: {{ $content['padding_bottom'] ?? '30' }}px; 
               background-color: {{ $content['background_color'] ?? '#ffffff' }}; 
               margin: 0;" 
        class="darkmode-bg">
        <table cellspacing="0" cellpadding="0" border="0" 
               width="{{ $content['container_width'] ?? '250' }}" 
               align="{{ $content['alignment'] ?? 'left' }}">
            <tr>
                <td align="{{ $content['alignment'] ?? 'left' }}" 
                    style="font-family: Arial, Helvetica, sans-serif; 
                           text-align: {{ $content['alignment'] ?? 'left' }}; 
                           vertical-align: middle;">
                    <div class="btn-rounded" style="font-family: Arial, Helvetica, sans-serif;">
                        <!--[if mso]>
                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" 
                                    xmlns:w="urn:schemas-microsoft-com:office:word"
                                    href="{{ $content['url'] ?? '#' }}"
                                    style="height:{{ $content['height'] ?? '34' }}px;
                                           v-text-anchor:middle;
                                           width:{{ $content['width'] ?? '100' }}px;" 
                                    arcsize="{{ $content['border_radius'] ?? '32' }}%" 
                                    stroke="f" 
                                    fillcolor="{{ $content['button_background_color'] ?? '#FFD102' }}">
                            <w:anchorlock/>
                            <center style="color:{{ $content['text_color'] ?? '#000000' }}; 
                                         font-family:Arial, sans-serif; 
                                         font-size:{{ $content['font_size'] ?? '12' }}px; 
                                         font-weight:{{ $content['font_weight'] ?? 'bold' }}; 
                                         line-height:{{ $content['height'] ?? '34' }}px; 
                                         text-align:center; 
                                         display: block; 
                                         margin: auto 0;">
                                {{ $content['text'] ?? 'ACCEDE' }}
                            </center>
                        </v:roundrect>
                        <![endif]-->
                        <!--[if !mso]><!-->
                        <a class="keep-black" 
                           href="{{ $content['url'] ?? '#' }}"
                           style="display: inline-block; 
                                  font-weight: {{ $content['font_weight'] ?? 'bold' }}; 
                                  background-color: {{ $content['button_background_color'] ?? '#FFD102' }}; 
                                  border-radius: {{ $content['border_radius'] ?? '32' }}px; 
                                  color: {{ $content['text_color'] ?? '#000000' }}; 
                                  font-family: Arial, Helvetica, sans-serif; 
                                  font-size: {{ $content['font_size'] ?? '12' }}px; 
                                  line-height: {{ $content['height'] ?? '34' }}px; 
                                  text-align: center; 
                                  text-decoration: none; 
                                  width: {{ $content['width'] ?? '100' }}px; 
                                  -webkit-text-size-adjust: none; 
                                  height: {{ $content['height'] ?? '34' }}px; 
                                  vertical-align: middle;">
                            {{ $content['text'] ?? 'ACCEDE' }}
                        </a>
                        <!--<![endif]-->
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
