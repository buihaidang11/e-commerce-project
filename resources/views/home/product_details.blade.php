<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <section class="shop_section layout_padding">
        <div class="container p-0">
            <div class="heading_container heading_center">
                <h2>
                    Details
                </h2>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="/product_images/{{ $product->image }}" alt="">
                </div>
                <div class="detail-box">
                    <h6>
                        {{ $product->title }}
                    </h6>
                    <h6>
                        Price:
                        <span>
                            {{ $product->price }}$
                        </span>
                    </h6>
                </div>
                <div class="detail-box py-2">
                    <h6>
                        Category:
                        <span>
                            {{ $product->category }}
                        </span>
                    </h6>
                    <h6>
                        Quantity:
                        <span>
                            {{ $product->quantity }}
                        </span>
                    </h6>
                </div>
                <div class="detail-box py-4">
                    <p>{{ $product->description }}</p>
                </div>
                <div class="new">
                    <span>
                        New
                    </span>
                </div>
            </div>
            <div class="py-2 ">
                <a class="btn btn-success px-4 text-white" href="{{ url('/') }}">Back</a>
            </div>

    </section>

    <!-- info section -->
    @include('home.footer')
    <!-- end info section -->


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
