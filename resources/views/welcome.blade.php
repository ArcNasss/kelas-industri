<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 May 2023 15:13:07 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="style/images/favicon.png">
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
</head>

<body>
    <div class="content-wrapper">
        <nav class="navbar absolute transparent navbar-expand-lg nav-uppercase" id="navbar-example2">
            <div class="container flex-row justify-content-center">
                <div class="navbar-brand"><a href="index.html"><img src="#"
                            srcset="style/images/logo.png 1x, style/images/logo@2x.png 2x" alt="" /></a></div>
                <div class="navbar-other ml-auto order-lg-3">
                    <ul class="navbar-nav flex-row align-items-center" data-sm-skip="true">
                        <li class="nav-item">
                            <div class="navbar-hamburger d-lg-none d-xl-none ml-auto"><button
                                    class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button>
                            </div>
                        </li>
                        @auth
                            <li class="nav-item d-none d-lg-block pl-0"><a href="{{ route('home') }}"
                                    class="btn btn-default m-0">Home</a></li>
                        @else
                            <li class="nav-item d-none d-lg-block pl-0"><a href="{{ route('login') }}"
                                    class="btn btn-default m-0">login</a></li>
                        @endauth
                    </ul>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /.navbar-other -->
                <div class="navbar-collapse offcanvas-nav">
                    <div class="offcanvas-header d-lg-none d-xl-none">
                        <a href="index.html"><img src="#"
                                srcset="style/images/logo-light.png 1x, style/images/logo-light@2x.png 2x"
                                alt="" /></a>
                        <button class="plain offcanvas-close offcanvas-nav-close"><i class="jam jam-close"></i></button>
                    </div>
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item"><a class="nav-link" href="">Home</a>
                            <!--/.dropdown-menu -->
                        </li>
                        <li class="dropdown">
                            <a class="nav-link" data-bs-spy="scroll" data-bs-target="#navbar-example2" href="#scrollspyHeading1">Features</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#3">Pages</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#4">Elements</a>
                            <!--/.dropdown-menu -->
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#5">Portfolio</a>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#6">Blog</a>
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
            <a href="index.html"><img src="#"
                    srcset="style/images/logo-light.png 1x, style/images/logo-light@2x.png 2x" alt="" /></a>
            <div class="space30"></div>
            <p>Snowlake is a multi-concept and powerful site template contains rich layouts with possibility of
                unlimited
                combinations & beautiful elements.</p>
            <div class="space20"></div>
            <div class="widget">
                <h5 class="widget-title">Contact Info</h5>
                <address> Moonshine St. 14/05 <br /> Light City, London <div class="space20"></div>
                    <a href="https://demos.elemisthemes.com/cdn-cgi/l/email-protection#22444b5051560c4e43515662474f434b4e0c414d4f"
                        class="nocolor"><span class="__cf_email__"
                            data-cfemail="d7beb9b1b897b2bab6bebbf9b4b8ba">[email&#160;protected]</span></a><br /> +00
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
        <!-- /.offcanvas-info -->
        <div class="wrapper bg-opacity-default">
            <div class="rev_slider_wrapper fullwidth-container dark-spinner">
                <div id="slider7" class="rev_slider fullwidthbanner" data-version="5.4.7">
                    <ul>
                        <li data-transition="fade" data-thumb=""><img
                                src="{{ asset('landing_kelas_industri/style/images/dummy.png') }}"
                                style="background:transparent" alt="" />
                            <div class="tp-caption" data-x="['center','center','center','center']"
                                data-y="['bottom','bottom','bottom','bottom']" data-hoffset="['0','0','0','0']"
                                data-voffset="['-2','-2','-2','-2']"
                                data-frames='[{"delay":0,"speed":1200,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-visibility="['on','on','on','on']" data-width="none" data-height="none"
                                data-type="image" data-responsive="on" data-responsive_offset="on"
                                data-basealign="slide" style="z-index: 5;"><img data-lazyload=""
                                    src="{{ asset('landing_kelas_industri/style/images/art/rocket1.png') }}"
                                    data-ww="['100%','100%','100%','100%']" data-hh="auto" alt="" />
                            </div>
                            <!-- /.tp-caption -->
                            <div class="tp-caption" data-x="['center','center','center','center']"
                                data-y="['middle','middle','middle','middle']"
                                data-hoffset="['260','260','260','260']" data-voffset="['60','60','60','60']"
                                data-frames='[{"delay":600,"speed":1200,"frame":"0","from":"y:bottom;rX:90deg;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                data-visibility="['on','on','on','off']" data-width="none" data-height="none"
                                data-type="image" data-responsive="on" data-responsive_offset="on"
                                data-basealign="slide" style="z-index: 5;"><img data-lazyload=""
                                    src="{{ asset('landing_kelas_industri/style/images/art/rocket2.png') }} "
                                    data-ww="['220','220','220','220']" data-hh="auto" alt="" />
                            </div>
                            <!-- /.tp-caption -->
                            <div class="tp-caption" data-x="['center','center','center','center']"
                                data-y="['middle','middle','middle','middle']"
                                data-hoffset="['260','260','260','260']" data-voffset="['-170','-170','-170','-170']"
                                data-frames='[{"delay":0,"speed":1200,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-visibility="['on','on','on','off']" data-width="none" data-height="none"
                                data-type="image" data-responsive="on" data-responsive_offset="on"
                                data-basealign="slide" style="z-index: 6;"><img data-lazyload=""
                                    src="{{ asset('landing_kelas_industri/style/images/art/rocket3.png') }}"
                                    data-ww="['380','380','380','380']" data-hh="auto" alt="" />
                            </div>
                            <!-- /.tp-caption -->
                            <div class="tp-caption" data-x="['center','center','center','center']"
                                data-y="['middle','middle','middle','middle']"
                                data-hoffset="['300','300','300','300']" data-voffset="['70','70','70','70']"
                                data-frames='[{"delay":0,"speed":1200,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-visibility="['on','on','on','off']" data-width="none" data-height="none"
                                data-type="image" data-responsive="on" data-responsive_offset="on"
                                data-basealign="slide" style="z-index: 5;"><img data-lazyload=""
                                    src="{{ asset('landing_kelas_industri/style/images/art/rocket4.png') }}"
                                    data-ww="['480','480','480','480']" data-hh="auto" alt="" />
                            </div>
                            <!-- /.tp-caption -->
                            <div class="tp-caption font-weight-500 color-dark"
                                data-x="['left','left','left','center']" data-y="middle"
                                data-hoffset="['50','30','30','0']" data-voffset="['-125','-125','-125','-105']"
                                data-fontsize="['40','40','34','36']" data-lineheight="['50','50','44','46']"
                                data-width="['500','500','420','340']"
                                data-textAlign="['left','left','left','center']"
                                data-whitespace="['normal','normal','normal','normal']"
                                data-frames='[{"delay":1000,"speed":1200,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-responsive="on" data-responsive_offset="on" style="z-index: 9;">Selamat Datang
                                DiWebsite Kelas Industri
                            </div>
                            <!-- /.tp-caption -->
                            <div class="tp-caption font-weight-300 color-dark"
                                data-x="['left','left','left','center']" data-y="middle"
                                data-hoffset="['50','30','30','0']" data-voffset="['-20','-20','-20','30']"
                                data-fontsize="['26','26','22','24']" data-lineheight="['36','36','32','34']"
                                data-width="['500','500','420','340']"
                                data-textAlign="['left','left','left','center']"
                                data-whitespace="['normal','normal','normal','normal']"
                                data-frames='[{"delay":1500,"speed":1200,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'
                                data-responsive="on" data-responsive_offset="on" style="z-index: 9;">Kami membantu
                                sekolah guru mentor serta murit untuk meningkatkan keefektif dalam mengajar serta
                                belajar

                            </div>
                            <!-- /.tp-caption -->
                            @auth
                                <a class="tp-caption btn btn-l btn-default" data-x="['left','left','left','center']"
                                    data-y="middle" data-hoffset="['50','30','30','0']"
                                    data-voffset="['75','75','75','135']" data-width="['auto','auto','auto','auto']"
                                    data-textAlign="['left','left','left','center']"
                                    data-frames='[{"delay":2000,"speed":1200,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-responsive="on" data-responsive_offset="on" style="z-index: 9;"
                                    href="{{ route('home') }}">Home
                                </a>
                            @else
                                <a class="tp-caption btn btn-l btn-default" data-x="['left','left','left','center']"
                                    data-y="middle" data-hoffset="['50','30','30','0']"
                                    data-voffset="['75','75','75','135']" data-width="['auto','auto','auto','auto']"
                                    data-textAlign="['left','left','left','center']"
                                    data-frames='[{"delay":2000,"speed":1200,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                                    data-responsive="on" data-responsive_offset="on" style="z-index: 9;"
                                    href="{{ route('login') }}">Login
                                </a>
                            @endauth

                            <!-- /.tp-caption -->
                        </li>
                    </ul>
                    <div class="tp-bannertimer tp-bottom"></div>
                </div>
                <!-- /.rev_slider -->
            </div>
            <!-- /.rev_slider_wrapper -->
        </div>
        <!-- /.wrapper -->
        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
            <div class="wrapper white-wrapper" id="scrollspyHeading1">
                <div class="container inner pt-100">
                    <h2 class="title-color color-gray text-center">Mengapa Kelas Industri?</h2>
                    <h3 class="display-3 text-center">Layanan lengkap yang kami tawarkan adalah sebagai berikut<br
                            class="d-none d-lg-block" />Dirancang untuk memenuhi kebutuhan mengajar .</h3>
                    <div class="space40"></div>
                    <div class="row text-center gutter-60 ">
                        <div class="col-md-6 col-lg-3">
                            <div class="icon icon-blob icon-blob-rose color-rose mb-20"> <i
                                    class="icofont-university"></i>
                            </div>
                            <h5>Sekolah</h5>
                            <p>Total {{ $school }} Sekolah Yang Tergabung Dalam Kelas Industri
                            </p>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 col-lg-3">
                            <div class="icon icon-blob icon-blob-blue color-blue mb-20"> <i
                                    class="icofont-book-alt
                                "></i>
                            </div>
                            <h5>Materi</h5>
                            <p>Terdapat {{ $material }} Materi Yang Tersedia Pada Kelas Industri
                            </p>
                        </div>
                        <!--/column -->
                        <div class="space30 d-none d-md-block d-lg-none"></div>
                        <div class="col-md-6 col-lg-3">
                            <div class="icon icon-blob icon-blob-green color-green mb-20"> <i
                                    class="icofont-black-board"></i> </div>
                            <h5>Kelas</h5>
                            <p>Ada {{ $classroom }} Kelas Yang Berkonribusi Pada Kelas Industri.
                            </p>
                        </div>
                        <!--/column -->
                        <div class="col-md-6 col-lg-3">
                            <div class="icon icon-blob icon-blob-purple color-purple mb-20"> <i
                                    class="icofont-teacher"></i> </div>
                            <h5>Mentor</h5>
                            <p>Total {{ $mentor }} Mentor Yang Telah Bergabung Dalam Kelas Industri
                            </p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                    <div class="space140" id="3"></div>
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <figure><img src="#"
                                    srcset="{{ asset('landing_kelas_industri/style/images/concept/concept8.png') }}"
                                    alt="" /></figure>
                        </div>
                        <!--/column -->
                        <div class="space20 d-md-none"></div>
                        <div class="space50 d-none d-md-block d-lg-none"></div>
                        <div class="col-lg-6 pl-60 pl-md-15">
                            <h2 class="title-color color-gray">Mengapa Memilih Kami?</h2>
                            <h3 class="display-3">Why is Search Engine Optimization important for your business?</h3>
                            <div class="space20"></div>
                            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus
                                sit amet
                                fermentum. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus
                                commodo,
                                tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                            <ul class="icon-list bullet-default">
                                <li><i class="icofont-verification-check"></i>Aenean eu leo quam ornare.</li>
                                <li><i class="icofont-verification-check"></i>Nullam quis risus eget mollis.</li>
                                <li><i class="icofont-verification-check"></i>Donec elit non mi porta gravida.</li>
                                <li><i class="icofont-verification-check"></i>Fusce dapibus cursus commodo.</li>
                            </ul>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                    <div class="space140" id="4"></div>
                    <div class="row align-items-center">
                        <div class="col-lg-6 order-lg-2">
                            <figure><img src="#"
                                    srcset="{{ asset('landing_kelas_industri/style/images/concept/concept1.png') }}"
                                    alt="" /></figure>
                        </div>
                        <!--/column -->
                        <div class="space20 d-md-none"></div>
                        <div class="space50 d-none d-md-block d-lg-none"></div>
                        <div class="col-lg-6 pr-60 pr-md-15">
                            <h2 class="title-color color-gray">Our Process</h2>
                            <h3 class="display-3">We bring solutions to make life easier for our customers</h3>
                            <div class="space30"></div>
                            <div class="d-flex flex-row justify-content-center">
                                <div>
                                    <span class="icon icon-blob icon-blob-blue color-blue mr-25"><i
                                            class="jam jam-lightbulb"></i><span class="step bg-blue">1</span></span>
                                </div>
                                <div>
                                    <h5>Collect Ideas</h5>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta
                                        gravida at eget
                                        metus. Cras justo.</p>
                                </div>
                            </div>
                            <div class="space30"></div>
                            <div class="d-flex flex-row justify-content-center">
                                <div>
                                    <span class="icon icon-blob icon-blob-teal color-teal mr-25"><i
                                            class="jam jam-search-folder"></i><span class="step bg-teal">2</span></span>
                                </div>
                                <div>
                                    <h5>Data Analysis</h5>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta
                                        gravida at eget
                                        metus. Cras justo.</p>
                                </div>
                            </div>
                            <div class="space30"></div>
                            <div class="d-flex flex-row justify-content-center">
                                <div>
                                    <span class="icon icon-blob icon-blob-yellow color-yellow mr-25"><i
                                            class="jam jam-heart"></i><span class="step bg-yellow">3</span></span>
                                </div>
                                <div>
                                    <h5>Magic Touch</h5>
                                    <p class="mb-0">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta
                                        gravida at eget
                                        metus. Cras justo.</p>
                                </div>
                            </div>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                    <div class="space140" id="5"></div>
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <figure><img src="#"
                                    srcset="{{ asset('landing_kelas_industri/style/images/concept/concept3.png') }}"
                                    alt="" /></figure>
                        </div>
                        <!--/column -->
                        <div class="space20 d-md-none"></div>
                        <div class="space50 d-none d-md-block d-lg-none"></div>
                        <div class="col-lg-6 pl-60 pl-md-15 order-lg-2">
                            <h2 class="title-color color-gray">Our Personalized Solutions</h2>
                            <h3 class="display-3">Just sit and relax while we take care of your business needs</h3>
                            <div class="space20"></div>
                            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus
                                sit amet
                                fermentum. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus
                                commodo,
                                tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                            <ul class="icon-list bullet-default">
                                <li><i class="icofont-verification-check"></i>Aenean eu leo quam ornare.</li>
                                <li><i class="icofont-verification-check"></i>Nullam quis risus eget mollis.</li>
                                <li><i class="icofont-verification-check"></i>Donec elit non mi porta gravida.</li>
                                <li><i class="icofont-verification-check"></i>Fusce dapibus cursus commodo.</li>
                            </ul>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.wrapper -->
            <div class="wrapper light-wrapper" id="6">
                <div class="container inner">
                    <h2 class="title-color color-gray text-center">Kerjasama Kelas Industri</h2>
                    <h3 class="display-3 text-center">MOU Dengan Sekolah</h3>
                    <div class="space20"></div>
                    <div class="grid-view">
                        <div class="wrapper light-wrapper">
                            <div class="carousel owl-carousel clients" data-margin="30" data-loop="true"
                                data-dots="false" data-autoplay="true" data-autoplay-timeout="3000"
                                data-responsive='{"0":{"items": "2"}, "768":{"items": "4"}, "992":{"items": "5"}, "1140":{"items": "6"}}'>
                                @forelse ($MOUS as $MOU)
                                    <div class="item pl-15 pr-15"><img src="{{ asset('storage/' . $MOU->photo) }}"
                                            alt="" /></div>
                                @empty
                                @endforelse
                            </div>
                            <!-- /.owl-carousel -->
                        </div>
                        <!-- /.grid-view -->
                        <div class="space160"></div>
                        <div class="row">
                            <div class="col-lg-5 pr-50 pr-md-15">
                                <h2 class="title-color color-gray">Our Pricing</h2>
                                <h3 class="display-3">We offer great prices, premium products and quality service for your
                                    business.</h3>
                                <div class="space20"></div>
                                <p>Nulla vitae elit libero, a pharetra augue. Donec ullamcorper nulla non metus auctor
                                    fringilla. Maecenas
                                    sed diam eget risus varius blandit sit amet non magna. Nulla vitae elit libero, a
                                    pharetra
                                    augue. Cras
                                    justo odio, dapibus ac facilisis in, egestas eget quam. Sed posuere consectetur est.</p>
                            </div>
                            <!--/column -->
                            <div class="space70 d-none d-md-block d-lg-none"></div>
                            <div class="space20 d-md-none"></div>
                            <div class="col-lg-7">
                                <div class="pricing-wrapper">
                                    <div class="row no-gutters">
                                        <div class="col-md-6 popular">
                                            <div class="pricing panel box bg-white shadow">
                                                <div class="panel-heading">
                                                    <div class="prices color-dark">
                                                        <div class="price price-show"><span
                                                                class="price-currency">$</span><span
                                                                class="price-value">9</span> <span
                                                                class="price-duration">month</span></div>
                                                        <div class="price price-hide price-hidden"><span
                                                                class="price-currency">$</span><span
                                                                class="price-value">99</span> <span
                                                                class="price-duration">year</span></div>
                                                    </div>
                                                    <h4 class="panel-title mb-0">Basic Plan</h4>
                                                </div>
                                                <!--/.panel-heading -->
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tr>
                                                            <td><strong>1</strong> Project </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>100K</strong> API Access </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>100MB</strong> Storage </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Custom <strong>Cloud</strong> Services </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Weekly <strong>Reports</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td> 7/24 <strong>Support</strong></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!--/.panel-body -->
                                                <div class="panel-footer"> <a href="#" class="btn"
                                                        role="button">Choose Plan</a></div>
                                            </div>
                                            <!--/.pricing -->
                                        </div>
                                        <!--/column -->
                                        <div class="col-md-6">
                                            <div class="pricing panel box bg-white shadow">
                                                <div class="panel-heading">
                                                    <div class="prices color-dark">
                                                        <div class="price price-show"><span
                                                                class="price-currency">$</span><span
                                                                class="price-value">19</span> <span
                                                                class="price-duration">month</span></div>
                                                        <div class="price price-hide price-hidden"><span
                                                                class="price-currency">$</span><span
                                                                class="price-value">199</span> <span
                                                                class="price-duration">year</span></div>
                                                    </div>
                                                    <h4 class="panel-title mb-0">Premium Plan</h4>
                                                </div>
                                                <!--/.panel-heading -->
                                                <div class="panel-body">
                                                    <table class="table">
                                                        <tr>
                                                            <td><strong>5</strong> Projects </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>100K</strong> API Access </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>200MB</strong> Storage </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Custom <strong>Cloud</strong> Services </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Weekly <strong>Reports</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td> 7/24 <strong>Support</strong></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!--/.panel-body -->
                                                <div class="panel-footer"> <a href="#" class="btn"
                                                        role="button">Choose Plan</a></div>
                                            </div>
                                            <!--/.pricing -->
                                        </div>
                                        <!--/column -->
                                    </div>
                                    <!--/.row -->
                                </div>
                                <!--/.pricing-wrapper -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                        <div class="space140"></div>
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <figure><img src="#"
                                        srcset="{{ asset('landing_kelas_industri/style/images/concept/concept12.png') }}"
                                        alt="" />
                                </figure>
                            </div>
                            <!--/column -->
                            <div class="space50 d-none d-md-block d-lg-none"></div>
                            <div class="space10 d-md-none"></div>
                            <div class="col-lg-6 pl-60 pl-md-15">
                                <h2 class="title-color color-gray">Let's Talk</h2>
                                <h3 class="display-3">Let's make something great together. If you got any questions, don't
                                    hesitate to get
                                    in touch with us.</h3>
                                <div class="space20"></div>
                                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nullam quis risus eget urna
                                    mollis ornare
                                    vel eu leo. Maecenas faucibus mollis interdum. Aenean lacinia bibendum nulla sed
                                    consectetur.</p>
                                <div class="space10"></div>
                                <a href="#" class="btn btn-default">Contact Us</a>
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.container -->
                </div>
                <!-- /.wrapper -->
                <div class="wrapper bg-opacity-default">
                    <div class="container inner">
                        <div class="row text-center">
                            <div class="col-lg-8 offset-lg-2">
                                <h2 class="title-color color-gray">Analyze Now</h2>
                                <h3 class="display-3">Wonder how much faster your website can go?<br
                                        class="d-none d-xl-block" /> Easily
                                    check your SEO Score now.</h3>
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                        <div class="space30"></div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <form class="fields-white">
                                    <div class="input-group">
                                        <input type="email" value="" name="EMAIL"
                                            class="email form-control mb-0 mr-2 mb-sm-0" placeholder="Email Address"
                                            required>
                                        <button type="submit"
                                            class="btn btn-rounded btn-default mr-0 mb-0 pull-right">Analyze</button>
                                    </div>
                                </form>
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
                    <div class="container inner">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">Popular Posts</h3>
                                    <ul class="image-list">
                                        <li>
                                            <figure class="rounded"><a href="blog-post.html"><img
                                                        src="{{ asset('landing_kelas_industri/style/images/art/a1.jpg') }}"
                                                        alt="" /></a>
                                            </figure>
                                            <div class="post-content">
                                                <h6 class="post-title"> <a href="blog-post.html">Magna Mollis
                                                        Ultricies</a>
                                                </h6>
                                                <div class="meta"><span class="date"><i class="jam jam-clock"></i>12
                                                        Nov
                                                        2017</span><span class="comments"><i
                                                            class="jam jam-message-alt"></i><a href="#">4</a></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <figure class="rounded"> <a href="blog-post.html"><img
                                                        src="{{ asset('landing_kelas_industri/style/images/art/a2.jpg') }}"
                                                        alt="" /></a>
                                            </figure>
                                            <div class="post-content">
                                                <h6 class="post-title"> <a href="blog-post.html">Ornare Nullam Risus</a>
                                                </h6>
                                                <div class="meta"><span class="date"><i class="jam jam-clock"></i>12
                                                        Nov
                                                        2017</span><span class="comments"><i
                                                            class="jam jam-message-alt"></i><a href="#">4</a></span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <figure class="rounded"><a href="blog-post.html"><img
                                                        src="{{ asset('landing_kelas_industri/style/images/art/a3.jpg') }}"
                                                        alt="" /></a>
                                            </figure>
                                            <div class="post-content">
                                                <h6 class="post-title"> <a href="blog-post.html">Euismod Nullam</a> </h6>
                                                <div class="meta"><span class="date"><i class="jam jam-clock"></i>12
                                                        Nov
                                                        2017</span><span class="comments"><i
                                                            class="jam jam-message-alt"></i><a href="#">4</a></span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- /.image-list -->
                                </div>
                                <!-- /.widget -->
                            </div>
                            <!-- /column -->
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">Tags</h3>
                                    <ul class="list-unstyled tag-list">
                                        <li><a href="#" class="btn btn-s">Still Life</a></li>
                                        <li><a href="#" class="btn btn-s">Urban</a></li>
                                        <li><a href="#" class="btn btn-s">Nature</a></li>
                                        <li><a href="#" class="btn btn-s">Landscape</a></li>
                                    </ul>
                                </div>
                                <div class="widget">
                                    <h3 class="widget-title">Categories</h3>
                                    <ul class="unordered-list column-2">
                                        <li><a href="#" class="nocolor">Lifestyle (21)</a></li>
                                        <li><a href="#" class="nocolor">Photo (19)</a></li>
                                        <li><a href="#" class="nocolor">Journal (16)</a></li>
                                        <li><a href="#" class="nocolor">Works (7)</a></li>
                                        <li><a href="#" class="nocolor">Still Life (9)</a></li>
                                        <li><a href="#" class="nocolor">Travel (17)</a></li>
                                    </ul>
                                </div>
                                <!-- /.widget -->
                            </div>
                            <!-- /column -->
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h3 class="widget-title">Get in Touch</h3>
                                    <address> Moonshine St. 14/05 Light City, London, United Kingdom</address>
                                    <a
                                        href="https://demos.elemisthemes.com/cdn-cgi/l/email-protection#33555a4140471d5f52404773565e525a5f1d505c5e"><span
                                            class="__cf_email__"
                                            data-cfemail="71181f171e31141c10181d5f121e1c">[email&#160;protected]</span></a><br />
                                    +00 (123) 456 78
                                    90
                                </div>
                                <!-- /.widget -->
                                <div class="widget">
                                    <h3 class="widget-title">Elsewhere</h3>
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
                                    <h3 class="widget-title">Learn More</h3>
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="nocolor">About Us</a></li>
                                        <li><a href="#" class="nocolor">Our Story</a></li>
                                        <li><a href="#" class="nocolor">Projects</a></li>
                                    </ul>
                                </div>
                                <!-- /.widget -->
                                <div class="widget">
                                    <h3 class="widget-title">Need Help?</h3>
                                    <ul class="list-unstyled">
                                        <li><a href="#" class="nocolor">Support</a></li>
                                        <li><a href="#" class="nocolor">Get Started</a></li>
                                        <li><a href="#" class="nocolor">Contact Us</a></li>
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
        </div>

        <!-- /.content-wrapper -->
        <div id="options-nav"></div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- Mirrored from/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 05 May 2023 15:13:12 GMT -->

</html>
