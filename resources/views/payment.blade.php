<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <form action="{{ route('enviarPagamentoPicPay') }}" method="POST">
        @csrf
        <button type="submit" name="generate_qr_code">
            Gerar QR CODE
        </button>
    </form>

</body>

</html>
