<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <h1>This is a h1</h1>
        <br>
        <a href="http://bbc.co.uk">This is a visited link</a>
        <br>
        <a href="http://bbc.co.uk2" target="_blank">This is an unvisited link</a>
        <br>
        <button type="submit">This is Submit button</button>
        <br>
        <button type="reset">This is Reset button</button>
        <br>
        <button type="button">This is a button</button>
        <br>
        <input type="button" value="This is also a button">
        <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min') }}"></script>
    </body>
</html>