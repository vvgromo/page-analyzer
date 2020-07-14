<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <h1>Page Analyzer</h1>
        <p>Check web pages for free</p>
        <form action="/domains" method="post">
            {{ csrf_field() }}
            <input type="text" name="domain[name]" value="" placeholder="https://www.example.com">
            <button type="submit">Check</button>
        </form>
    </body>
</html>
