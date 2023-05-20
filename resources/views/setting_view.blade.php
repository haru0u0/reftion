<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Simple line icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @if(app('env') == 'production')
    <link href="{{secure_asset('css/in_styles.css')}}" rel="stylesheet">
    @else
    <link href="{{asset('css/in_styles.css')}}" rel="stylesheet" />
    @endif

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/setting') }}">{{ __('Setting') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>Setting</h1>
            <p>You are logging in as <?php echo $email ?>. <br>
                If you have any problems regarding to your settings, please check <a class="link inline" href="{{ url('/onboarding') }}">{{ __('our users guide') }}</a> once again. </p>
            <br>
            <form method="POST" action="{{ url('/setting') }}">
                @csrf
                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Notion Integration Key') }}</label>
                    <div class="col-md-6">
                        @guest
                        <input disabled id="input_token" type="text" class="form-control" name="input_token" value="{{$old_token}}">
                        @else
                        <input id="input_token" type="text" class="form-control" name="input_token" value="{{$old_token}}">
                        @endguest
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Notion Database ID') }}</label>
                    <div class="col-md-6">
                        @guest
                        <input disabled id="input_dbid" type="text" class="form-control" name="input_dbid" value="{{$old_dbid}}">
                        @else
                        <input id="input_dbid" type="text" class="form-control" name="input_dbid" value="{{$old_dbid}}">
                        @endguest
                    </div>
                </div>

                <div class="text-center">
                    <div class="text-center">
                        @guest
                        <button disabled type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                        @else
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                        @endguest
                    </div>
                </div>
            </form>
            @guest
            <br><br>
            <p style="color:red;">*Message for guest users*<br>You cannnot modify settings because you are logging in as a guest.
                <br>If you want to check the Notion database which this guest account connects to, see <a class="link-primary" target="_blank" href="{{ url('https://haruchann.notion.site/422fed2fabc04532a7930787a3d1809b?v=cae3653b84de479d88a46bbecb5a6086') }}" style="display:inline">{{ __('the database.') }}</a>
                <br><br>Big thank you for checking Reftion out! Hope you like it and sticking with us further by <a class="link-primary" target="_blank" inline href="{{ url('/login/google') }}">signing up</a>!
                <br>To sign up, you need to log in with Google account. Reftion only collect your email address for user authorization use.
            </p>

            @endguest


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
    @endif

</body>

</html>