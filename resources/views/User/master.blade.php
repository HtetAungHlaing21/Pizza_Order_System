<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> @yield('title') </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('User/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('User/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('User/css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Font Awesome Link -->
    <link rel=" stylesheet " href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css "
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin=" anonymous
        " referrerpolicy="no-referrer " />
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-warning bg-dark px-2">The Pizza</span>
                    <span class="h1 text-uppercase text-dark bg-warning px-2 ml-n1">Company</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30 position-sticky top-0 z-3">
        <div class="row px-xl-5">
            <div class="col">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0 ">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link">Home</a>
                            <a href="{{route('cart#summary')}}" class="nav-item nav-link">My Cart</a>
                            <a href="{{route('order#history')}}" class="nav-item nav-link">My Orders</a>
                            <a href="{{route('contact#message')}}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        </div>
                        <div class="dropdown navbar-nav ml-auto py-0 d-none d-lg-block">
                            <button class="btn btn-outline-warning dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user me-2"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li class="px-3 py-2"><a class="dropdown-item"
                                        href="{{ route('useraccount#details') }}"> <i
                                            class="fa-regular fa-lightbulb me-2"></i> Account</a></li>
                                <li class="px-3 py-2"><a class="dropdown-item"
                                        href="{{ route('useraccount#changePasswordPage') }}"><i
                                            class="fa-solid fa-key me-2"></i> Change Password</a></li>
                                <li class="px-3 py-2">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="btn btn-warning col"> <i
                                                class="fa-solid fa-right-from-bracket me-2"></i> Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-6 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">About Us</h5>
                <p class="mb-4">
                    Welcome to Delicious Delights Pizza, where taste and quality meet in every slice! We take pride in crafting mouthwatering pizzas using the finest ingredients and time-honored recipes. Our dedicated team of pizza artisans ensures each creation is a culinary masterpiece, served hot and fresh to satisfy your cravings. Your pizza paradise awaits!
                </p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-secondary mr-3"></i>No-12, Rose Road, Kamaryut, Yangon, Myanmar</p>
                <p class="mb-2"><i class="fa fa-envelope text-secondary mr-3"></i>contact@thepizzacompany.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-secondary mr-3"></i>09-769333584</p>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="{{route('user#home')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="{{route('user#home')}}"><i class="fa fa-angle-right mr-2"></i>Our
                                Shop</a>
                            <a class="text-secondary mb-2" href="{{route('cart#summary')}}"><i
                                    class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="{{route('order#history')}}"><i
                                    class="fa fa-angle-right mr-2"></i>Orders</a>
                            <a class="text-secondary" href="{{route('contact#message')}}"><i class="fa fa-angle-right mr-2"></i>Contact
                                Us</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-secondary text-uppercase mb-3">Follow Us</h5>
                        <div class="d-flex">
                            <a class="btn btn-secondary btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-secondary btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-secondary btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-secondary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 offset-md-3 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('User/img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('User/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('User/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="{{ asset('User/mail/jqBootstrapValidation.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('User/mail/contact.js') }}"></script> --}}

    <!-- Template Javascript -->
    <script src="{{ asset('User/js/main.js') }}"></script>
    {{-- Bootstrap CDN Js + Popper --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>
@yield('ajaxScript')

</html>
