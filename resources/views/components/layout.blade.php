<html lang="en">
    <head>
        <meta charset="UTF-8">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('/app.css') }}">
        <script type="text/javascript" src="{{ asset('/app.js') }}" defer></script>
        <title>Taxi</title>
    </head>

    <body {{ $attributes->merge() }}>
        {{ $slot }}
    </body>
</html>
