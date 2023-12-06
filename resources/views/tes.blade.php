<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('transaction.store') }}" method="POST">
        @csrf
        <input type="text" value="tes" name="tes">
        <button type="submit">klik</button>
    </form>
</body>

</html>
