<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ROCTracker | {{ $title }}</title>
</head>

<body style="margin:0px; background: #f8f8f8; ">
<div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
    <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
            <tbody>
            <tr>
                <td style="vertical-align: top; padding-bottom:30px;" align="center"><br/>
                        <a href="javascript:void(0)" class="text-center db"><h1><span style="color: #059B9A;">Roc</span>Tracker</h1></a>
                </td>
            </tr>
            </tbody>
        </table>
        <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
            <tbody>
            <tr>
                @if($type == "success")
                    <td style="background:#8ffb86; padding:20px; color:#fff; text-align:center;">
                @elseif($type == "warning")
                    <td style="background:#f7fb5f; padding:20px; color:#fff; text-align:center;">
                @elseif($type == "info")
                    <td style="background:#6466fb; padding:20px; color:#fff; text-align:center;">
                @elseif($type == "error")
                    <td style="background:#fb9678; padding:20px; color:#fff; text-align:center;">
                @else
                    <td style="background:#8efbea; padding:20px; color:#fff; text-align:center;">
                @endif
                    {{ $title }}
                </td>
            </tr>
            </tbody>
        </table>
        <div style="padding: 40px; background: #fff;">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                <tbody>
                <tr>
                    <td>
                        {{ $text }}
                        <br>
                        <br>
                        <br>
                        <br>
                        <b>- Alvast bedankt, ROCTracker</b> </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
            <p><span style="color: #059B9A;">Roc</span>Tracker</p>
        </div>
    </div>
</div>
</body>
</html>
