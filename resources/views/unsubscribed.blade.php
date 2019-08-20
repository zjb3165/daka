<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
</head>
<body>
    <div>
        <div class="qrcode"><img src="{{ image_url($setting['qrcode']) }}"></div>
        <div class="tip">请长按二维码，关注我们的公众号</div>
    </div>
</body>
</html>