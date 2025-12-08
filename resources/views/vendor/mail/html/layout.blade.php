<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<style>
@media only screen and (max-width: 600px) {
  .inner-body { width: 100% !important; }
  .footer { width: 100% !important; }
}
</style>
</head>

<body style="
    margin:0; padding:0;
    background: linear-gradient(135deg, #ff7a00, #ff9e32, #ff7a00);
    font-family: Arial, sans-serif;
    color: #fff;
">

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="center" style="padding:40px 0;">

    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;">

        {{-- HEADER --}}
        {{ $header ?? '' }}

        <tr>
            <td class="inner-body" style="padding:20px 28px;">

                {{-- BODY CONTENT --}}
                <div style="font-size:16px; line-height:1.6; color:white;">
                    {!! Illuminate\Mail\Markdown::parse($slot) !!}
                </div>

                {{-- SUBCOPY --}}
                <div style="margin-top:20px; font-size:13px; opacity:0.9;">
                    {{ $subcopy ?? '' }}
                </div>

            </td>
        </tr>

        {{-- FOOTER --}}
        {{ $footer ?? '' }}

    </table>

</td>
</tr>
</table>

</body>
</html>
