<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CGEHHMVX04"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-CGEHHMVX04');
    </script>
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
    <link href="{{secure_asset('css/in_styles.css')}}" rel="stylesheet" />
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


    <!-- オンボーディング画面からの直接遷移だったら、完了モーダルを表示する-->
    @if ($prevURL==$onboardingURL)
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class=" text-center">
                        <i class="fa-regular fa-face-kiss-wink-heart fa-bounce fa-2xl" style="color: #f39530;"></i><br>
                        Registration now completed. Welcome to Reftion!
                    </h4>
                </div>
                <div class="modal-body">
                    <label>
                        Thank you so much for registering! You now should be able to generate a reference list on Reftion. Let's give it a try!
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Let's generate the first reference list with us now!</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ゲストログインだったら歓迎メッセージを表示する-->
    @guest
    @if ($prevURL==$welcomeURL)
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class=" text-center">
                        <i class="fa-regular fa-face-kiss-wink-heart fa-bounce fa-2xl" style="color: #f39530;"></i><br>
                        Welcome to Reftion! Please get to know how Reftion can help you!
                    </h4>
                </div>
                <div class="modal-body">
                    <label>
                        Thank you so much for trying Reftion demo!
                        This demo looks and works exactly in the same way as the one after you really sign up, but already set up to connect with <a class="link-primary" target="_blank" href="{{ url('https://haruchann.notion.site/422fed2fabc04532a7930787a3d1809b?v=cae3653b84de479d88a46bbecb5a6086') }}" style="display:inline">{{ __('the sample Notion database') }}</a> so that you can try out our feature right away.
                        All you need to do to generate a reference list is simply to select a tag on this page!
                        <br><br>If you want to know more about how to set up to connect Reftion with your Notion database, go to the "Setting" page from the navigation bar then find "user guide".
                        On the "Setting" page, you can also always find the link for the sample Notion database above for your convenience.
                        <br><br>
                        Well, that's pretty much it! Hope you gonna like Reftion!
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Let's generate the first reference list with us now!</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endguest

    <!-- Footer-->
    @if(app('env') == 'production')
    <script src="{{secure_asset('js/in_scripts.js')}}"></script>
    @else
    <script src="{{asset('js/in_scripts.js')}}"></script>
    @endif
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- 完了モーダルデフォルト表示用-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        $(window).on('load', function() {
            $('#myModal').modal('show');
        });
    </script>

</body>

</html>