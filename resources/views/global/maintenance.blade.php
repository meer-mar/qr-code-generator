<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('Maintenance Mode') }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            text-align: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .animation {
            display: inline-block;
            margin-bottom: 24px;
        }

        h1 {
            font-size: 32px;
            font-weight: 400;
            text-transform: uppercase;
            margin: 0;
        }

        p {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        a {
            color: #f6921e;
            font-weight: bold;
            text-decoration: none;
            margin-left: 5px;
        }
        .animation img {
            width: 200px
        }
        h1 {
            font-family: Arial, Helvetica, sans-serif 
        }
        p {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="animation">
               <img src="{{asset($setting?->maintenance_image)}}" alt=""> 
            </div>
            <h1>{{$setting->maintenance_title}}</h1>
            <p>{!! clean($setting->maintenance_description) !!}</p>
            
            
        </div>
    </div>
</body>

</html>
