
<!doctype html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend_asset') }}/img/favicon.ico">

    <!-- Title -->Stay Connected Blog_Site
    <title>Blog_site....</title>

    <style>
        .social-media ul li { margin-right: 10px;

        }
        .social-media ul li a span{ 
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            background-color: blue;
            color:white;
            border-radius: 60%;
        }
        .social-media ul li a .fa-facebook-square{
            background-color: #1877F2;
        }
        .social-media ul li a .fa-linkedin{
            background-color: #0077B5;
        }
        .social-media ul li a .fa-whatsapp{
            background-color: #25D366;
        }
        .social-media ul li a .fa-twitter{
            background-color: #1DA1F2;
        }

    </style>

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('frontend_asset') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_asset') }}/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('frontend_asset') }}/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_asset') }}/css/fontawesome.css">

    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('frontend_asset') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend_asset') }}/css/custom.css">
</head>

<body>
    <!--loading -->
    <div class="loader">
        <div class="loader-element"></div>
    </div>

    <!-- Header-->
    <header class="header navbar-expand-lg fixed-top ">
        <div class="container-fluid ">
            <div class="header-area ">
                <!--logo-->
                <div class="logo">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('frontend_asset') }}/img/logo/logo-dark.png" alt="" class="logo-dark">
                        <img src="{{ asset('frontend_asset') }}/img/logo/logo-white.png" alt="" class="logo-white">
                    </a>
                </div>
                <div class="header-navbar">
                    <nav class="navbar">
                        <!--navbar-collapse-->
                        <div class="collapse navbar-collapse" id="main_nav">
                            <ul class="navbar-nav ">
                                <li class="nav-item ">
                                    <a class="nav-link active" href="{{ route('index') }}"> Home </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('all.posts') }}"> Blogs </a>
                                </li>                                
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('author.list') }}"> Authors </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about') }}"> About </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('contact') }}"> Contact </a>
                                </li>
                            </ul>
                        </div>
                        <!--/-->
                    </nav>
                </div>

                <!--header-right-->
                <div class="header-right ">
                    <!--theme-switch-->
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <span class="slider round ">
                                <i class="lar la-sun icon-light"></i>
                                <i class="lar la-moon icon-dark"></i>
                            </span>
                        </label>
                    </div>

                    <!--search-icon-->
                    <div class="search-icon">
                        <i class="las la-search"></i>
                    </div>
  <!--button-subscribe-->
                    {{-- <div class="botton-sub">
                        @auth('author')
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" 
                            style="
                            background-color:rgb(91, 180, 39); 
                            color: #0e0c0c;  ">
                              {{ Auth::guard('author')->user()->name }}
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('author.dashboard') }}">Admin Panel</a>
                              <a class="dropdown-item" href="{{ route('author.logout') }}">Logout</a>
                              
                            </div>
                          </div>
                        @else
                         <a href="{{ route('author.login.page') }}" class="btn-subscribe">Sign in</a>
                        @endauth
                       
                    </div> --}}
                    @auth('author')
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="authorDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::guard('author')->user()->photo == null)
                                <img src="{{ asset('frontend_asset') }}/img/author/1.jpg" alt="" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                            @else
                                <img src="{{ asset('uploads/author/'. Auth::guard('author')->user()->photo) }}" alt="" style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                            @endif
                            <span class="ml-2">{{ Auth::guard('author')->user()->name }}</span>
                        </a>                                  
                        <div class="dropdown-menu" aria-labelledby="authorDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    @if (Auth::guard('author')->user()->photo == null)
                                        <img src="{{ asset('frontend_asset') }}/img/author/1.jpg" alt="" style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('uploads/author/'. Auth::guard('author')->user()->photo) }}" alt="" style="width:80px; height:80px; border-radius:50%; object-fit:cover;">
                                    @endif
                                </div>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0">{{ Auth::guard('author')->user()->name }}</p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{ route('author.dashboard') }}" class="nav-link">
                                            <i data-feather="layout"></i>
                                            <span>Admin Panel</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link border-0 bg-transparent" href="{{ route('author.logout') }}">
                                            <i data-feather="log-out"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @else
                    <a href="{{ route('author.login.page') }}" class="btn-subscribe">Sign in</a>
                @endauth

                    
                    
                    
                    
                    
                    <!--navbar-toggler-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    @yield('content')


    <!--footer-->
    <div class="footer">
        <div class="footer-area">
            <div class="footer-area-content">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Menu</h6>
                                <ul>
                                    <li><a href="#">Homepage</a></li>
                                    <li><a href="#">about us</a></li>
                                    <li><a href="#">contact us</a></li>
                                    <li><a href="#">privarcy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--newslatter-->
                        <div class="col-md-6">
                            <div class="newslettre">
                                <div class="newslettre-info">
                                    <h3>Subscribe To OurNewsletter</h3>
                                    <p>Sign up for free and be the first to get notified about new posts.</p>
                                </div>

                                <form action="{{ route('subscriptions.subscribe') }}" method="POST" class="newslettre-form" id="subscriptionForm">
                                    @csrf
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Your Email Adress"
                                                required="required">
                                        </div>
                                        <button class="submit-btn" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                                @if (session('success'))
                                <div class="alert alert-success" id="success-message">{{ session('success') }}</div> 
                                @endif
                            </div>
                        </div>


                
                        <!--/-->
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Follow us</h6>
                                <ul>
                                    <li><a href="https://web.facebook.com/mdtomasuddintom/">facebook</a></li>
                                    <li><a href="https://www.linkedin.com/in/md-tomas-uddin-5887532a9/">linkedin</a></li>
                                    <li><a href="https://www.instagram.com/">instagram</a></li>
                                    <li><a href="www.youtube.com/@mdtomasuddin1">youtube</a></li>
                                    <li><a href="https://x.com/mdtomasuddin1">twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer-copyright-->
            <div class="footer-area-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright">
                                <p>©2024 => mdtomasuddin1@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>

    <!--Back-to-top-->
    <div class="back">
        <a href="#" class="back-top">
            <i class="las la-long-arrow-alt-up"></i>
        </a>
    </div>

    <!--Search-form-->
    <div class="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10 m-auto">
                    <div class="search-width">
                        <button type="button" class="close">
                            <i class="far fa-times"></i>
                        </button>
                        <div class="search-form" >
                            
                            <input type="search" id="search_input" placeholder="What are you looking for?">
                            <button type="submit" class="search-btn"> search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
     </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('frontend_asset') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend_asset') }}/js/popper.min.js"></script>
    <script src="{{ asset('frontend_asset') }}/js/bootstrap.min.js"></script>


    <!-- JS Plugins  -->
    <script src="{{ asset('frontend_asset') }}/js/theia-sticky-sidebar.js"></script>
    <script src="{{ asset('frontend_asset') }}/js/ajax-contact.js"></script>
    <script src="{{ asset('frontend_asset') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend_asset') }}/js/switch.js"></script>
    <script src="{{ asset('frontend_asset') }}/js/jquery.marquee.js"></script>

    <script src="{{ asset('js/share.js') }}"></script>


    <!-- JS main  -->
    <script src="{{ asset('frontend_asset') }}/js/main.js"></script>

        <!-- Search-form-->
    <script>
        $('.search-btn').click(function() {
            let search_keyword=$('#search_input').val();
            let link="{{ route('search') }}"+"?q="+search_keyword;           
            window.location.href = link;
            
        });
    </script>
    @yield('footer_script')


</body>
</html>