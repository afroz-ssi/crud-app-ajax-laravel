<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- bootsta cdn     --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="{{asset('common.js')}}"></script>
    <style>
        input {
            padding: 10px;
            width: 100%;
        }

        .main-form-input {
            width: 500px;
            padding: 20px;
            box-shadow: 0px 1px 5px 5px #cccccc;
            border-radius: 20px;
        }

        .form-group {
            margin: 10px;
        }
    </style>
</head>
