<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <?php
    $value = 0;
    ?>
    <div class="container">
        <div class="d-flex justify-content-center pt-2">
            <table class="table border">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                        <tr>
                            <td class="align-middle ">{{ $item->product->title }}</td>
                            <td class="align-middle">{{ $item->product->price }}</td>
                            <td><img style="width: 60px; height:65px;" src="/product_images/{{ $item->product->image }}"
                                    alt=""></td>
                            <td class="d-flex justify-content-center"><a class="btn btn-danger"
                                    href="{{ url('delete_cart', $item->id) }}">Remove</a></td>
                        </tr>
                        <?php
                        $value += $item->product->price;
                        ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <form action="{{ url('confirm_order') }}" method="post">
            @csrf
            <div class="">
                <label class="" style="width: 180px">Receiver Name</label>
                <input type="text" style="height:40px; width:320px;" name="name" value="{{ Auth::user()->name }}">
            </div>
            <div class="d-flex align-items-center py-4">
                <label class="" style="width: 180px">Receiver Address</label>
                <textarea class="" style="width:420px;" name="address">{{ Auth::user()->address }}</textarea>
            </div>
            <div class="">
                <label class="" style="width: 180px;">Receiver Phone</label>
                <input style="height:40px; width:220px;" type="text" name="phone"
                    value="{{ Auth::user()->phone }}">
            </div>
            <div class="d-block py-2 align-items-center">
                <div class="mr-2 ">Total Price: {{ $value }}</div>
                <div>
                    <input class="btn btn-primary" type="submit" value="Place Order">
                    <a class="btn btn-success" href="{{ url('stripe', $value) }}">Pay Using Card</a>
                </div>

            </div>
        </form>
        <div class="py-2 ">
            <a class="btn btn-secondary px-4 text-white" href="{{ url('/') }}">Back</a>
        </div>
    </div>

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
