 <!DOCTYPE html>
  <html>
    <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="{{ asset('/css/vendor.css') }}"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style type="text/css">
        body{
          background-color: #0d47a1;
          width: 100vw;
          height: 100vh;
        }
        .vertical{
          height: 100%;
        }
      </style>
    </head>
    <body>
      <div class="vertical valign-wrapper">
        @yield('content')
      </div>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="{{ asset('/js/vendor.js') }}"></script> 
    </body>
  </html>
        