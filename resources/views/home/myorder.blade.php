<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <div class="container">
        <div class="d-flex justify-content-center pt-2">
            <table class="table border">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $item)
                        <tr>
                            <td class="align-middle ">{{ $item->product->title }}</td>
                            <td class="align-middle">{{ $item->product->price }}</td>
                            @if ($item->status == 'in progress')
                                <td class="align-middle text-primary">{{ $item->status }}</td>
                            @elseif($item->status == 'on the way')
                                <td class="align-middle text-warning">{{ $item->status }}</td>
                            @else
                                <td class="align-middle text-success">{{ $item->status }}</td>
                            @endif
                            <td><img style="width: 60px; height:65px;" src="/product_images/{{ $item->product->image }}"
                                    alt=""></td>
                            {{-- <td class="d-flex justify-content-center"><a class="btn btn-danger"
                                    href="{{ url('delete_cart', $item->id) }}">Remove</a></td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
