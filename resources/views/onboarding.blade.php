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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Font Awesome icons (free version)-->
    <script src="https://kit.fontawesome.com/eddde291c0.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @if(app('env') == 'production')
    <link href="{{secure_asset('css/prepare_styles.css')}}" rel="stylesheet" />
    @else
    <link href="{{asset('css/prepare_styles.css')}}" rel="stylesheet" />
    @endif
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <span class="d-block d-lg-none">{{ config('app.name', 'Laravel') }}</span>
            <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{asset('assets/img/icon.png')}}" alt="..." /></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#start">Get started Reftion</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#column">1. Set up Notion DB
                        Columns</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#integrationkey">2. Share integration key of your Notion DB with Reftion</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#sharedb">3. Set to share your Notion DB</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#dbid">4. Share your Notion DB ID with Reftion</a></li>
                @if ($prevURL!==$settingURL)
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#register">5. Complete registration!</a></li>
                @endif
                <div class="down">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <a href="{{ url('/setting') }}" style="color: rgba(255, 255, 255, 0.55)">{{ __('Back') }}</a>
                </div>
            </ul>
        </div>
    </nav>
    <!-- Page Content-->
    <div class=" container-fluid p-0">
        <!-- About-->
        <section class="resume-section" id="start">
            <div class="resume-section-content">
                <h1 class="mb-0">
                    <?php if ($prevURL == $settingURL) {
                        echo 'Reftion User Guide';
                    } else {
                        echo 'Thank you for registering with Reftion!';
                    } ?>
                </h1>
                <div class="subheading mb-5">

                </div>
                <p class="lead">
                    There are 4 steps to be completed to connect Reftion and your Notion DB.</P>
                <ol class="lead">
                    <li>Set up Notion DB Columns</li>
                    <li>Share API key of your Notion DB with Reftion</li>
                    <li>Set to Share your Notion DB</li>
                    <li>Share your Notion DB ID with Reftion</li>
                </ol>
                <p class="lead">
                    Don't worry, you will be guided through each steps from now! It will only take less than 5 min.
                </p>
                <div class="down">
                    <a class="nav-link js-scroll-trigger" href="#column"><i class="fa-solid fa-arrow-down-long fa-bounce fa-2xl" style="color:rgba(29, 128, 159, 0.6);"></a></i>
                </div>
            </div>
        </section>
        <hr class="m-0" />
        <section class="resume-section" id="column">
            <div class="resume-section-content">
                <h2 class="mb-5">1. Set up Notion DB Columns</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <p>To use Reftion, your have to have a Notion database with columns named "doi" and "tag".<br><br>
                        The "doi" column should be "URL" type and should have doi url of the references.<br>
                        The "tag" column should be "Multi-select" type and can be used to categorize references. It should also has at least one option.
                        <br><br>
                        <i class="fa-solid fa-circle-exclamation fa-shake"></i>
                        The name and type of the columns should be exactly matched with the above.<br>
                        <i class="fa-solid fa-circle-exclamation fa-shake"></i>
                        As long as the database has these two columns, it can have other columns as well.<br><br>
                        You can either adjust existing database, create new database by yourself or create new database
                        by duplicating a database template for Reftion from <a class="link-primary" target="_blank" href="{{ url('https://haruchann.notion.site/422fed2fabc04532a7930787a3d1809b?v=cae3653b84de479d88a46bbecb5a6086') }}" style="display:inline">{{ __('here.') }}</a>
                    </p>
                    <p class="zoom__img"><img src="{{asset('assets/img/pre1_1.png')}}"></p>
                    <!--<img class="d-block mx-auto img-fluid w-50" src="{{asset('assets/img/pre1_1.png')}}" alt="..." />-->
                </div>
            </div>

        </section>
        <hr class="m-0" />
        <!--2. Share API key of your Notion DB with Reftion-->
        <section class="resume-section" id="integrationkey">
            <div class="resume-section-content">
                <h2 class="mb-5">2. Share integration key of your Notion DB with Reftion</h2>
                <div class="mb-5">
                    <p>To connect your Notion DB with Reftion, the integration key of your Notion workspace should be shared
                        with Reftion. The integration key will be stored in Reftion's database being encrypted.</p>
                    <ol>
                        <li>Go to <a class="link-primary" target="_blank" href="{{ url('https://www.notion.so/my-integrations') }}" style="display:inline">{{__('Notion My Integration page') }}</a> to generate an integration key.</li>
                        <li>Click "New integration".<p class="zoom__img mx-auto img-fluid w-50"><img src="{{asset('assets/img/pre2_2.png')}}" alt="..." /></p>
                        </li>
                        <li>Name your integration whatever you like. Select workspace which has the database which you would like to connect with Reftion.<p class="zoom__img mx-auto img-fluid w-50"><img src="{{asset('assets/img/pre2_3.png')}}" alt="..." /></p>
                        </li>
                        <li>Copy "Internal Integration Secret".<p class="zoom__img mx-auto img-fluid w-50"><img src="{{asset('assets/img/pre2_4.png')}}" alt="..." /></p>
                        </li>
                        @if ($prevURL!==$settingURL)
                        <li>Paste it in the text box below.</li>
                        @else
                        <li>Paste it in the "Notion Integration Key" text box on the setting page.</li>
                        @endif
                    </ol>
                    @if ($prevURL!==$settingURL)
                    <form method="POST" action=" {{ url('/onboarding') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Notion Integration Key') }}</label>
                            <div class="col-md-6">
                                <input id="input_token" type="text" class="form-control inline" name="input_token" value="">
                            </div>
                        </div>
                        @endif
                </div>
        </section>
        <hr class="m-0" />
        <!-- 3. Set to Share your Notion DB-->
        <section class="resume-section" id="sharedb">
            <div class="resume-section-content">
                <h2 class="mb-5">3. Set to share your Notion DB</h2>
                <div class="mb-5">
                    <p>To connect your Notion database with Reftion, the connection between your integration and the
                        database needs to be approved.</p>
                    <ol>
                        <li>Open the database which you want to connect with Reftion and click "...".</li>
                        <li>Click "New integration".</li>
                        <li>Click "Add connections"</li>
                        <li>Select the integration which you created in the previous step.</li>
                        <p class="zoom__img mx-auto img-fluid w-50"><img src="{{asset('assets/img/pre3.png')}}" alt="..." /></p>
                    </ol>
                </div>
        </section>
        <hr class="m-0" />
        <!-- 4. Share your Notion DB ID with Reftion-->
        <section class="resume-section" id="dbid">
            <div class="resume-section-content">
                <h2 class="mb-5">4. Share your Notion DB ID with Reftion</h2>
                <div class="mb-5">
                    <p>To connect your Notion database with Reftion, the database ID should be shared with Reftion. The ID will be stored in Reftion's database being encrypted.</p>
                    <ol>
                        <li>Open the database which you want to connect with Reftion and click "Share".</li>
                        <li>Click "Copy link".</li>
                        <li>Copy the database ID. The database ID is a 32 characters alphanumeric string in the Notion DB's link, which you have just copied, and is between the slash following the workspace name and the question mark.
                            <br>eg. https://www.notion.so/[your_workspace_name]/<span class="text-secondary">422fed2fabc04532a7930787a3d1809b</span>?v=cae3653b84de479d88a46bbecb5a6086&pvs=4
                            <br>
                        </li>
                        <p class="zoom__img mx-auto img-fluid w-50"><img src="{{asset('assets/img/pre4.png')}}" alt="..." /></p>
                        @if ($prevURL!==$settingURL)
                        <li>Paste it in the text box below.</li>
                    </ol>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Notion Database ID') }}</label>
                        <div class="col-md-6">
                            <input id="input_dbid" type="text" class="form-control" name="input_dbid" value="">
                        </div>
                    </div>
                    @else
                    <li>Paste it in the "Notion Database ID" text box on the setting page.</li>
                    </ol>
                    @endif
                </div>

        </section>
        @if ($prevURL!==$settingURL)
        <!-- 5. Complete registration-->
        <section class="resume-section" id="register">
            <div class="resume-section-content">
                <h2 class="mb-5">5. Complete registration!</h2>
                <div class="mb-5">
                    <p class="lead">Now you are ready to use Reftion!<br>Click the button below and complete your setting.</p>
                    <div class="mb-0">
                        <div class="">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Complete registration and get started!') }}
                            </button>
                        </div>
                    </div>
                    </form>
                    <!--<a class="btn btn-primary btn-xl" href="{{ url('/setting') }}">{{ __('Connect Your Notion DB with Reftion and Get Started!') }}</a>-->
                </div>
        </section>
        @else
        <section></section>
        @endif
    </div>

    <!-- Core theme JS-->
    @if(app('env') == 'production')
    <script src="{{ secure_asset('js/prepare_scripts.js') }}"></script>
    @else
    <script src="{{ asset('js/prepare_scripts.js') }}"></script>
    @endif
    <!-- Bootstrap core JS-->
    <script src="http://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JQuery-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- 画像アップのJS-->
    <script>
        $(function() {

            let clientRect //画像の位置
            let w; //画像の幅
            let h; //画像の高さ
            let xx; //画像上のマウスカーソルの位置　横
            let yy; //画像上のマウスカーソルの位置　縦
            let x; //最終的に算出した値　横
            let y; //最終的に算出した値　縦

            //画像の上にマウスが来たら処理開始
            $(".zoom__img").mousemove(function(e) {

                // 画像の位置を取得
                clientRect = this.getBoundingClientRect();
                w = this.getBoundingClientRect().width;
                h = this.getBoundingClientRect().height;

                //画像の左上から、どこにカーソルがあるかを取得
                xx = e.pageX - (clientRect.left + window.pageXOffset);
                yy = e.pageY - (clientRect.top + window.pageYOffset);

                //object-positionの値を取得する
                x = ((w / 2) - xx) / 2;
                y = ((h / 2) - yy) / 2;

                //object-position に算出した値を設定
                $(this).find("img").css('object-position', x + "px " + y + "px");
            });

            //画像からマウスが離れたらリセット
            $(".zoom__img").mouseout(function(e) {
                $(this).find("img").css("object-position", 0, 0);
            });

        });
    </script>

</body>

</html>