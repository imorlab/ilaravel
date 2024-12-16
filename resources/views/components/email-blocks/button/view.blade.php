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
                                               fillcolor="{{ $block['content']['button_background_color'] ?? '#007bff' }}">
                                        <w:anchorlock/>
                                        <center style="color:{{ $block['content']['text_color'] ?? '#fafafa' }};
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
                                       style="background-color: {{ $block['content']['button_background_color'] ?? '#007bff' }};
                                              border-radius: {{ $block['content']['border_radius'] ?? '32' }}px;
                                              color: {{ $block['content']['text_color'] ?? '#fafafa' }};
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
