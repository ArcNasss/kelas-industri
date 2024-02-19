<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('app-assets/logo_file/Logo-Kelas-Industri.png') }}">
    <title>Kelas Industri</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('landing_kelas_industri/style/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_kelas_industri/style/css/plugins.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('landing_kelas_industri/style/revolution/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_kelas_industri/style/revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('landing_kelas_industri/style/revolution/css/navigation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_kelas_industri/style/type/type.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_kelas_industri/style/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('landing_kelas_industri/style/css/color/blue.css') }}">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
    @php
        use Carbon\Carbon;
    @endphp
    <style>
        @import url('https://fonts.cdnfonts.com/css/fontawesome');

        .tz-gallery {
            padding: 40px;
        }

        /* Override bootstrap column paddings */
        .tz-gallery .row>div {
            padding: 2px;
        }

        .tz-gallery .lightbox img {
            width: 100%;
            border-radius: 0;
            position: relative;
        }

        .tz-gallery .lightbox:before {
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -13px;
            margin-left: -13px;
            opacity: 0;
            color: #fff;
            font-size: 26px;
            /* font-family: 'inherit'; */
            font-family: 'FontAwesome', sans-serif;
            content: "\f002";
            pointer-events: none;
            z-index: 9000;
            transition: 0.4s;
        }


        .tz-gallery .lightbox:after {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            background-color: rgba(46, 132, 206, 0.7);
            content: 'test';
            transition: 0.4s;
        }

        .display-3 {
            margin-top: 60px;
        }

        .tz-gallery .lightbox:hover:after,
        .tz-gallery .lightbox:hover:before {
            opacity: 1;
        }

        .baguetteBox-button {
            background-color: transparent !important;
        }

        .post-title {
            font-size: 50px;
        }

        .awalan-berita {
            font-size: 20px;
            font-weight: 700;
        }

        @media(max-width: 768px) {
            body {
                padding: 0;
            }
        }

        @media (max-width:639px) {
            #logo {
                width: 60px;
            }

            #logo-2 {
                width: 90px;
            }
        }

        @media (min-width:640px) {
            #logo {
                width: 80px;
            }
        }

        body>div.content-wrapper.white-wrapper>div.wrapper.light-wrapper>div>div>div.col-lg-8>nav>div.d-none.flex-sm-fill.d-sm-flex.align-items-sm-center.justify-content-sm-between>div:nth-child(2)>ul {
            display: flex;
        }

        .overlay.overlay1 {
            width: auto;
            height: 254px;
        }

        .post-title {
            word-wrap: break-word;
            line-height: 1.2;
        }

        .overlay.overlay1 {
            height: 250px;
            margin-bottom: 20px;
        }

        .owl-item {
            height: 400px;
        }

        .img-figure {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="content-wrapper white-wrapper">
        <nav class="navbar absolute transparent navbar-expand-lg nav-uppercase" id="navbar-example2">
            <div class="container flex-row justify-content-center">
                <div class="navbar-brand"><a href="/"> <img id="logo"
                            src="{{ asset('app-assets/logo_file/Logo-Kelas-Industri.png') }}" alt="" /></a>
                </div>
                <div class="navbar-other ml-auto order-lg-3">
                    <ul class="navbar-nav flex-row align-items-center" data-sm-skip="true">
                        <li class="nav-item">
                            <div class="navbar-hamburger d-lg-none d-xl-none ml-auto"><button
                                    class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button>
                            </div>
                        </li>
                        @auth
                            <li class="nav-item d-none d-lg-block pl-0"><a href="{{ route('home') }}"
                                    class="btn btn-default m-0">Beranda</a></li>
                        @else
                            <li class="nav-item d-none d-lg-block pl-0"><a href="{{ route('login') }}"
                                    class="btn btn-default m-0">Masuk</a></li>
                        @endauth
                    </ul>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /.navbar-other -->
                <div class="navbar-collapse offcanvas-nav">
                    <div class="offcanvas-header d-lg-none d-xl-none">
                        <a href="/"><img id="logo-2"
                                src="{{ asset('app-assets/logo_file/Logo-Kelas-Industri.png') }}" srcset=""
                                alt="" /></a>
                        <button class="plain offcanvas-close offcanvas-nav-close"><i class="jam jam-close"></i></button>
                    </div>
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="{{ route('landingPage') }}">Beranda</a>
                            <!--/.dropdown-menu -->
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" data-bs-spy="scroll" data-bs-target="#navbar-example2"
                                href="{{ route('landingPage', '#scrollspyHeading1') }}">Kerjasama</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('landingPage', '#3') }}">Informasi</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="{{ route('landingPage', '#4') }}">Fasilitas</a>
                            <!--/.dropdown-menu -->
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
                                href="{{ route('landingPage', '#5') }}">LMS</a>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
                                href="{{ route('landingPage', '#6') }}">Daftar</a>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
                                href="{{ route('news') }}">Berita</a>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
                                href="{{ route('gallery') }}">Galeri</a>
                        </li>
                    </ul>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
        <!-- /.navbar -->
        <div class="offcanvas-info inverse-text">
            <button class="plain offcanvas-close offcanvas-info-close"><i class="jam jam-close"></i></button>
            <a href="/"><img src="#"
                    srcset="style/images/logo-light.png 1x, style/images/logo-light@2x.png 2x" alt="" /></a>
            <div class="space30"></div>
            <p>Snowlake is a multi-concept and powerful site template contains rich layouts with possibility of
                unlimited combinations & beautiful elements.</p>
            <div class="space20"></div>
            <div class="widget">
                <h5 class="widget-title">Contact Info</h5>
                <address> Moonshine St. 14/05 <br /> Light City, London <div class="space20"></div>
                    <a href="/cdn-cgi/l/email-protection#a7c1ced5d4d389cbc6d4d3e7c2cac6cecb89c4c8ca"
                        class="nocolor"><span class="__cf_email__"
                            data-cfemail="6d04030b022d08000c0401430e0200">[email&#160;protected]</span></a><br /> +00
                    (123) 456 78 90
                </address>
            </div>
            <!-- /.widget -->
            <div class="widget">
                <h3 class="widget-title">Learn More</h3>
                <ul class="list-unstyled">
                    <li><a href="#" class="nocolor">Our Story</a></li>
                    <li><a href="#" class="nocolor">Terms of Use</a></li>
                    <li><a href="#" class="nocolor">Privacy Policy</a></li>
                    <li><a href="#" class="nocolor">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.widget -->
            <div class="widget">
                <h3 class="widget-title">Follow Us</h3>
                <ul class="social social-mute social-s ml-auto">
                    <li><a href="#"><i class="jam jam-twitter"></i></a></li>
                    <li><a href="#"><i class="jam jam-facebook"></i></a></li>
                    <li><a href="#"><i class="jam jam-instagram"></i></a></li>
                    <li><a href="#"><i class="jam jam-vimeo"></i></a></li>
                    <li><a href="#"><i class="jam jam-youtube"></i></a></li>
                </ul>
            </div>
            <!-- /.widget -->
        </div>
        <!--/.modal -->
        <div class="wrapper light-wrapper">
            <div class="container inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog classic-view">
                            <div class="post">
                                <div class="title">
                                    <h1 class="post-title"><a href="">{{ $slug->title }}</a></h1>
                                    <div class="meta"><span class="date"><i
                                                class="jam jam-clock"></i>{{ Carbon::parse($slug->date)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                                    </div>
                                </div>
                                <figure class="rounded d-flex justify-content-center"><img
                                        style="width: 80%; height: 500px; object-fit: cover;"
                                        src="{{ asset('storage/' . $slug->photo) }}" alt=""></figure>
                                <div class="space40"></div>
                                <div class="post-content">
                                    <p><span class="awalan-berita">class.hummatech.com -
                                        </span>{{ $slug->description }}</p>
                                </div>
                                <!-- /.post-content -->
                            </div>
                            <!-- /.post -->
                        </div>
                        <!-- /.pagination -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="mb-30">Berita Lainnya</h3>
                                <div class="grid-view">
                                    <div class="carousel owl-carousel owl-loaded owl-drag" data-margin="30"
                                        data-dots="true" data-autoplay="false" data-autoplay-timeout="5000"
                                        data-responsive="{&quot;0&quot;:{&quot;items&quot;: &quot;1&quot;}, &quot;768&quot;:{&quot;items&quot;: &quot;2&quot;}, &quot;992&quot;:{&quot;items&quot;: &quot;3&quot;}}">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: auto;">
                                                @forelse ($news_random as $news)
                                                {{-- @dd($news_random) --}}
                                                    <div class="owl-item" style="width: 295px; margin-right: 30px; height: 450px;">
                                                        <div class="box bg-white shadow p-3">
                                                            <figure class="overlay overlay1 rounded"><a
                                                                    href="{{ route('detail-news', $news->slug) }}"><span
                                                                        class="bg"></span> <img class="img-figure"
                                                                        src={{ asset('storage/' . $news->photo) }}
                                                                        alt=""></a>
                                                                <figcaption>
                                                                    <h5 class="from-top mb-0">Read More</h5>
                                                                </figcaption>
                                                            </figure>
                                                            <h2 class="post-title"><a
                                                                    href="{{ route('detail-news', $news->slug) }}">{{ Str::limit($news->title, 25) }}</a>
                                                            </h2>
                                                            <div class="meta mb-0 mt-1"><span class="date"><i
                                                                        class="jam jam-clock"></i>{{ Carbon::parse($news->date)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="owl-nav disabled"><button type="button" role="presentation"
                                                class="owl-prev"><span aria-label="Previous">‹</span></button><button
                                                type="button" role="presentation" class="owl-next"><span
                                                    aria-label="Next">›</span></button></div>
                                        <div class="owl-dots"><button role="button"
                                                class="owl-dot active"><span></span></button><button role="button"
                                                class="owl-dot"><span></span></button><button role="button"
                                                class="owl-dot"><span></span></button></div>
                                    </div>
                                    <!-- /.owl-carousel -->
                                </div>
                                <!-- /.grid-view -->
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.pagination -->
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!-- /.container -->
            <figure style="margin-bottom:-3px;"><img
                    src="{{ asset('landing_kelas_industri/style/images/art/rocket1.png') }}" alt="" />
            </figure>
        </div>
        <!-- /.wrapper -->
        <footer class="white-wrapper">
            <div class="container">
                <div class="row">

                    <!-- /column -->
                    <div class="col-md-6 col-lg-3">
                        <!-- /.widget -->
                        <div class="widget">
                            <h3 class="widget-title">Sosial Media</h3>
                            <ul class="social social-mute social-s ml-auto">
                                <li><a href="#"><i class="jam jam-twitter"></i></a></li>
                                <li><a href="#"><i class="jam jam-facebook"></i></a></li>
                                <li><a href="#"><i class="jam jam-instagram"></i></a></li>
                                <li><a href="#"><i class="jam jam-vimeo"></i></a></li>
                                <li><a href="#"><i class="jam jam-youtube"></i></a></li>
                            </ul>
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!-- /column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="widget">
                            <h3 class="widget-title">Alamat Kantor</h3>
                            <address>Perum permata regency 1 blok 10 no 28 ngijo karangploso</address>
                            +62 821 3256 0566

                        </div>

                    </div>
                    <!-- /column -->
                    <div class="col-md-6 col-lg-3">
                        <div class="widget">
                            <h3 class="widget-title">Tentang Perusahaan</h3>
                            <ul class="list-unstyled">
                                <li><a href="https://hummasoft.com/" class="nocolor">Hummasoft</a></li>
                                <li><a href="https://hummasoft.com/kelas-industri/" class="nocolor">Kelas Industri</a>
                                </li>
                                <li><a href="https://hummasoft.com/course-category/web-development/" class="nocolor">E
                                        Learning</a></li>
                                <li><a href="https://hummasoft.com/pkl/" class="nocolor">Magang / PKL</a></li>
                            </ul>
                        </div>

                    </div>
                    <!-- /column -->

                    <!-- /column -->
                    <div class="col-md-6 col-lg-3">

                        <!-- /.widget -->
                        <div class="widget">
                            <h3 class="widget-title">Butuh Bantuan?</h3>
                            <ul class="list-unstyled">
                                <li><a href="https://wa.me/6282132560566" class="nocolor">Proposal</a></li>
                                <li><a href="https://wa.me/6282132560566" class="nocolor">Kerjasama Industri</a></li>
                                <li><a href="https://wa.me/6282132560566" class="nocolor">Hubungi Kami</a></li>
                            </ul>
                        </div>
                        <!-- /.widget -->
                    </div>
                    <!-- /column -->
                </div>
                <!--/.row -->
                <div class="space50"></div>
                <p class="text-center">© 2023 Kelas Industri. All rights reserved.</p>
            </div>
            <!-- /.container -->
        </footer>
    </div>

    <!-- /.content-wrapper -->
    <div id="options-nav"></div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script data-cfasync="false"
        src="{{ asset('landing_kelas_industri/demos.elemisthemes.com/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
    </script>
    <script src="{{ asset('landing_kelas_industri/style/js/jquery.min.js') }}"></script>
    <script src="{{ asset('landing_kelas_industri/style/js/popper.min.js') }}"></script>
    <script src="{{ asset('landing_kelas_industri/style/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing_kelas_industri/style/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('landing_kelas_industri/style/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.actions.min.js') }}">
    </script>
    <script
        src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.carousel.min.js') }}">
    </script>
    <script src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.kenburn.min.js') }}">
    </script>
    <script
        src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
    </script>
    <script
        src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.migration.min.js') }}">
    </script>
    <script
        src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.navigation.min.js') }}">
    </script>
    <script
        src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.parallax.min.js') }}">
    </script>
    <script
        src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.slideanims.min.js') }}">
    </script>
    <script src="{{ asset('landing_kelas_industri/style/revolution/js/extensions/revolution.extension.video.min.js') }}">
    </script>
    <script src="{{ asset('landing_kelas_industri/style/js/plugins.js') }}"></script>
    <script src="{{ asset('landing_kelas_industri/style/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery', {
            captions: function(element) {
                return element.getElementsByTagName('img')[0].alt;
            }
        });
    </script>
</body>

</html>
