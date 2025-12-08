@props(['url'])

<table width="100%" cellpadding="0" cellspacing="0" style="text-align:center; margin-top:20px;">
<tr>
<td>
<a href="{{ $url }}" target="_blank"
style="
background:#cc5f00;
color:white;
padding:14px 28px;
border-radius:10px;
text-decoration:none;
font-weight:bold;
font-size:16px;
display:inline-block;
box-shadow:0px 4px 12px rgba(0,0,0,0.25);
">
{{ $slot }}
</a>
</td>
</tr>
</table>
