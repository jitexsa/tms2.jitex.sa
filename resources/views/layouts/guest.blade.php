<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
        {{ setCss(['vendors/bootstrap', 'style', 'color-1', 'responsive', 'custom']) }}
        @livewireStyles
        @livewireScripts
    </head>
    <body>

    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card login-dark">
            <div>
              <div>
              <a class="logo" href="{{getenv('app_url')}}" wire:navigate>
                 <x-application-logo />
              </a>
              </div>
              <div class="login-main">
              {{ $slot }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
       <!-- latest jquery-->
       {{ setJs(['jquery.min', 'bootstrap/bootstrap.bundle.min']) }}
        <script>
            /*----------------------------------------
                password show hide
                ----------------------------------------*/
            $(".show-hide").show();
            $(".show-hide span").addClass("show");

            $(".show-hide span").click(function () {
                if ($(this).hasClass("show")) {
                $('input[name="password"]').attr("type", "text");
                $(this).removeClass("show");
                } else {
                $('input[name="password"]').attr("type", "password");
                $(this).addClass("show");
                }
            });
            $('form button[type="submit"]').on("click", function () {
                $(".show-hide span").addClass("show");
                $(".show-hide").parent().find('input[name="password"]').attr("type", "password");
            });
        </script>
    </body>
</html>
