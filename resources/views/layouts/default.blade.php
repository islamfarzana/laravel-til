<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trust Innovation Ltd.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/css/style.css" />
    <link rel="stylesheet" href="/assets/css/carousel.css">
    <link rel="stylesheet" href="/assets/css/slider.css">
    <link rel="stylesheet" href="/assets/css/responsive.css" />
</head>

<body>
    <header>
        <nav>
            <div class="nav-container" id="nav-container">
                <div class="nav-top">
                    <div class="logo">
                        <img src="/assets/img/logo.png" alt="" width="50%" />
                    </div>
                </div>
                <div class="items-container">
                    <div id="desktop-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/about">About Us</a></li>
                            <li><a href="/project">Projects</a></li>
                            <li><a href="/service">Services</a></li>
                            <li><a href="/news">News & Events</a></li>
                            <li><a href="/announcement">Announcement</a></li>
                            <li><a href="#">Join Us</a>
                                <ul class="sub-menu">
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/register">Register</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div id="mobile-menu">
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                            <i class="fa fa-bars"></i>
                        </a>
                        <div id="myLinks" style="display: none;">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><a href="/about">About Us</a></li>
                                <li><a href="/project">Projects</a></li>
                                <li><a href="/service">Services</a></li>
                                <li><a href="/news">News & Events</a></li>
                                <li><a href="/announcement">Announcement</a></li>
                                <li><a href="#">Join Us</a>
                                    <ul class="sub-menu">
                                        <li><a href="/login">Login</a></li>
                                        <li><a href="/register">Register</a></li>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="/assets/js/carousel.js"></script>
    <script src="/assets/js/slider.js"></script>
    @yield('script')
    <script>
        window.addEventListener("load", function() {
            var containerWidth = document.getElementById('nav-container').offsetWidth;
            console.log(containerWidth <= 600);

            function showMenu() {
                var mobMenu = document.getElementById("mobile-menu");
                var deskMenu = document.getElementById("desktop-menu");
                console.log(mobMenu)
                console.log(deskMenu)
                if (containerWidth <= 600) {
                    mobMenu.style.display = "block";
                    deskMenu.style.display = "none";
                } else {
                    mobMenu.style.display = "none";
                    deskMenu.style.display = "block";
                }
            }
            showMenu()
        });

        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
</body>

</html>
