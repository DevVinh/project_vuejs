<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VueJS Crud Demo</title>
    <link rel="stylesheet"  href="{{asset('css/app.css')}}" >
</head>
<body>
     <!-- Navbar Top -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <a href="/" class="navbar-brand" style="margin-left: 15px">VueJS Crud Demo</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle navbar-brand" data-toggle="dropdown">
                            <span style="padding-left: 10px">{{ Auth::user()->name }}</span>
                        </a>
                        <a href="/logout">
                            <ul class="dropdown-menu bg-info text-center" style="margin-left: -30px; margin-top: 7px">
                                <li>
                                    <span class="navbar-brand">Logout</span>
                                </li>
                            </ul>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar Top -->
        <br>
        <br>
        <br>
    <div id="app">
        <app></app>
        <product></product>
    </div>
    <script>
        window.__user__ = @json($user)
    </script>
    <script type="text/javascript" src="{{asset('js/app.js')}}" ></script>
</body>
</html>
