<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pobles de Catalunya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Selecciona una província</h1>
        <div class="list-group">
            @foreach($provincies as $provincia)
            <a href="/provincia/{{ $provincia->provincia }}" class="list-group-item list-group-item-action" id="provincia-{{ $provincia->provincia }}">
                {{ $provincia->provincia }}
            </a>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>