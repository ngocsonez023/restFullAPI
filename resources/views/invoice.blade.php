<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
</head>
<body>
    @foreach($data as $key => $value)
        <h1>{{ $value}}</h1>
        <h1>{{ ++$key }}</h1>
    @endforeach
<h2>hello world pdfController</h2>
</body>
</html>
