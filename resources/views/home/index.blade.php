<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
    @include('home.slider')
    <!-- end slider section -->

    <!-- end hero area -->

    <!-- shop section -->
    @include('home.product')
    <!-- end shop section -->

    <!-- contact section -->
    @include('home.contact')
    <!-- end contact section -->



    <!-- info section -->
    @include('home.footer')
    <!-- end info section -->


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
