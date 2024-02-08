<html lang="en">
    <head>
        <meta charset="UTF-8">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('/app.css') }}">
        <title>Taxi</title>
    </head>

    <body {{ $attributes->merge() }}>
        {{ $slot }}

        <script type="text/javascript" src="{{ asset('/app.js') }}"></script>
    </body>
</html>
