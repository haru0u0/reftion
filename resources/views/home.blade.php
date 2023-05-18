<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @if(app('env') == 'production')
    <link href="{{secure_asset('css/in_styles.css')}}" rel="stylesheet" />
    @else
    <link href="{{asset('css/in_styles.css')}}" rel="stylesheet" />
    @end
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ url('/prepare') }}">{{ __('Register') }}</a></li>
                    <li class="nav-item"><a class="nav-link" target="_blank" href="{{ url('https://haruchann.notion.site/422fed2fabc04532a7930787a3d1809b?v=cae3653b84de479d88a46bbecb5a6086') }}">{{ __('See the Notion DB which this account connected to') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{ __('Going back to Welcome Page') }}</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ url('/setting') }}">{{ __('Setting') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/prepare') }}">{{ __('Get started') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>Which do you want to generate a reference list for?</h1>
            <br>
            <form action="{{ url('/generate') }}" method="post">
                @csrf
                <!--<label for="tag">tag:</label>-->
                <div class="form-group">
                    <select multiple class="form-control" name="tag">
                        <?php
                        $first_iteration = true;
                        foreach ($tag_name_array as $value) {
                            echo '<option value="', $value, '"';
                            if ($first_iteration) {
                                echo ' selected';
                                $first_iteration = false;
                            }
                            echo '>', $value, '</option>';
                        }
                        ?>
                    </select>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary">Get a reference list!</button>
            </form>
        </div>
    </div>

    <!-- Footer-->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    @if(app('env') == 'production')
    <script src="{{secure_asset('js/in_scripts.js')}}"></script>
    @else
    <script src="{{asset('js/in_scripts.js')}}"></script>
    @end
</body>

</html>