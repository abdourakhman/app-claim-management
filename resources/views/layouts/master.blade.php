
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LydecResolver | Home</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="shortcut icon" href="{{asset('img/images/favicon.png')}}"/>
        <script defer="" referrerpolicy="origin" src="/cdn-cgi/zaraz/s.js?z=JTdCJTIyZXhlY3V0ZWQlMjIlM0ElNUIlNUQlMkMlMjJ0JTIyJTNBJTIyQWRtaW5MVEUlMjAzJTIwJTdDJTIwU3RhcnRlciUyMiUyQyUyMnglMjIlM0EwLjQ4MjYyNTQzMDg2NTU4MjIlMkMlMjJ3JTIyJTNBMTI4MCUyQyUyMmglMjIlM0E4MDAlMkMlMjJqJTIyJTNBNjMyJTJDJTIyZSUyMiUzQTExOTElMkMlMjJsJTIyJTNBJTIyaHR0cHMlM0ElMkYlMkZhZG1pbmx0ZS5pbyUyRnRoZW1lcyUyRnYzJTJGc3RhcnRlci5odG1sJTIyJTJDJTIyciUyMiUzQSUyMmh0dHBzJTNBJTJGJTJGYWRtaW5sdGUuaW8lMkZkb2NzJTJGMy4yJTJGbGF5b3V0Lmh0bWwlMjIlMkMlMjJrJTIyJTNBMjQlMkMlMjJuJTIyJTNBJTIyVVRGLTglMjIlMkMlMjJvJTIyJTNBLTEyMCUyQyUyMnElMjIlM0ElNUIlNUQlN0Q="></script>
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            {{-- NAVBAR --}}
     

            {{-- END NAVBAR --}}

            {{-- START Sidebar --}}

          
            {{-- END Sidebar  --}}
           
            {{-- CONTENT  --}}
            @yield('content')
            {{-- END CONTENU --}}

            {{-- SIDEBAR RIGHT LIE AU CLIC SUR L'ICONE USER --}}
            
            {{-- END SIDEBAR RIGHT LIE AU CLIC SUR L'ICONE USER --}}

            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                By Abdourahmane Ndiaye
                </div>
                <strong>Copyright &copy; <?= date('Y')?> <a href="#">LydecGroup</a>.</strong> All rights reserved.
            </footer>
        </div>
        <script src="{{asset('/js/app.js')}}"></script>
    </body>
</html>
