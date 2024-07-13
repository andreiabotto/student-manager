<!DOCTYPE html class="h-100">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

@include('layouts/components/nav')

<body class="h-100">

    <div class="row ms-0 me-0 h-100">
        <div class="col-2 ps-0">
            @include('layouts/components/menu')
        </div>
        <div class="col">
            <div id="app" class="container">
                <div class="row">
                    <div class="col">
                        <div class="mt-3">
                            @include('layouts/components/breadcrumb')
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h1 class="me-1 text-end">@yield('title_card')</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @yield('menu_data')
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>


