<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
</head>
<body>
    <h4>Hallo {{ $details['email'] }} Kami Menerima Reset Password</h4>
    <p>berikut ini adalah link reset password anda</p>
    <a href="{{ $details['link'] }}">Klik</a>
</body>
</html>