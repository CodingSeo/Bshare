<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hiworks Login Page</title>
    </head>
    <script>
        var json_data = @json($json_data);
        window.onload = function() {
            console.log(json_data);
            window.opener.postMessage(json_data, '*');
        };
    </script>
    <body>
        logged_in
    </body>
</html>
