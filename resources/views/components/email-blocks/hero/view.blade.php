@if(isset($block['content']['image']))
<tr>
    <td style="padding: {{ $block['content']['padding'] ?? '0' }}px 0; text-align: center; background-color: {{ $block['content']['background_color'] ?? '#fafafa' }};" class="darkmode-bg">
        <img src="{{ $block['content']['image'] }}"
             width="{{ $block['content']['width'] ?? '600' }}"
             alt="{{ $block['content']['alt'] ?? 'Hero image' }}"
             border="0"
             style="width: 100%; max-width: {{ $block['content']['width'] ?? '600' }}px; height: auto; font-family: sans-serif; font-size: 15px; line-height: 15px; color: #555555;">
    </td>
</tr>
@endif
