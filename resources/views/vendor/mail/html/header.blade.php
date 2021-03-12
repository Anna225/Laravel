<tr>
    <td class="email-masthead">
        <a href="{{ $url }}" class="f-fallback email-masthead_name">
            {{ Illuminate\Mail\Markdown::parse($slot) }}
        </a>
    </td>
</tr>
