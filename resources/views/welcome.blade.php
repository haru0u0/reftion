<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://kit.fontawesome.com/eddde291c0.js" crossorigin="anonymous"></script>
        <!-- Simple line icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/welcome_styles.css')}}" rel="stylesheet" />
    </head>
    <body>
        <header class="masthead d-flex align-items-center">
            <div class="container px-4 px-lg-5 text-center">
                <h1 class="mb-1">Reftion</h1>
                <h3 class="mb-5">Generate a reference list from your Notion DB!</h3>
                <!--<a class="btn btn-primary btn-xl" href="#about">Find Out More</a>-->
                <a class="btn btn-light btn-xl" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn btn-primary btn-xl" href="{{ route('register') }}">{{ __('Register') }}</a>
                <div class="down">
                  <p>What is Reftion?</p>  
                  <i class="fa-solid fa-arrow-down-long fa-bounce fa-2xl" style="color: #eedcc9;"></i>
                </div>
            </div>
        </header>
        <section class="content-section bg-light" id="about">
            <div class="container px-4 px-lg-5 text-center">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-10">
                        <h2>Do you want to manage your references on Notion, but tired to create a reference list all by yourself?</h2>
                        <p class="lead mb-5">
                            Reftion is a quick and easy way to generate a reference list based on information on your Notion DB!
                        </p>
                        <!--<a class="btn btn-dark btn-xl" href="#services">What We Offer</a>-->
                    </div>
                </div>
            </div>
        </section>
        <section class="content-section bg-primary text-white text-center" id="services">
            <div class="container px-4 px-lg-5">
                <div class="content-section-heading">
                    <h3 class="text-secondary mb-0">Services</h3>
                    <h2 class="mb-5">How to use</h2>
                </div>
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                        <span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-1"></i></span>
                        <h4><strong>Notion DB Setting</strong></h4>
                        <p class="text-faded mb-0">Your Notion DB should have "doi" "tag" columns to use this service. </p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
                        <span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-2"></i></span>
                        <h4><strong>Connect</strong></h4>
                        <p class="text-faded mb-0">Register your DB infomation and API key to your Reftion profile.</p>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
                        <span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-3"></i></span>
                        <h4><strong>Select Tag</strong></h4>
                        <p class="text-faded mb-0">
                            Select one of the tags in your DB on Reftion. Your reference list will have a citation of the articles which has the tag you selected.  
                        </p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <span class="service-icon rounded-circle mx-auto mb-3"><i class="fa-solid fa-4"></i></span>
                        <h4><strong>Generate!</strong></h4>
                        <p class="text-faded mb-0">Just wait for a second... Your reference list is going to be ready! </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="content-section">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">Ready to get started? Register now!</h2>
                <a class="btn btn-light btn-xl" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn btn-primary btn-xl" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer text-center">
           <p class="text-muted small mb-0">Copyright &copy; Reftion 2023</p>
        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/welcome_scripts.js')}}"></script>
    </body>
</html>
