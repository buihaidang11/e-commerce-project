<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>

    @include('admin.header')

    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="pb-4">All Orders</h2>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Address</th>
                                <th class="text-center" scope="col">Phone</th>
                                <th class="text-center" scope="col">Product Title</th>
                                <th class="text-center" scope="col">Price</th>
                                <th class="text-center" scope="col">Image</th>
                                <th class="text-center" scope="col">Payment Status</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Change Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach ($order as $key => $item)
                            <tbody>
                                <tr>
                                    <th scope="row" class="align-middle">{{ $key + 1 }}</th>
                                    <td class="text-center align-middle">{{ $item->name }}</td>
                                    <td class="text-center align-middle">{{ $item->rec_address }}</td>
                                    <td class="text-center align-middle">{{ $item->phone }}</td>
                                    <td class="text-center align-middle">{{ $item->product->title }}</td>
                                    <td class="text-center align-middle">{{ $item->product->price }}</td>
                                    <td class="text-center align-middle">
                                        <img style="width:100px; height:90px"
                                            src="product_images/{{ $item->product->image }}" class=""
                                            alt="">
                                    </td>
                                    <td class="text-center align-middle">{{ $item->payment_status }}</td>
                                    </td>
                                    @if ($item->status == 'in progress')
                                        <td class="text-center align-middle text-primary">
                                            {{ $item->status }}
                                        @elseif($item->status == 'on the way')
                                        <td class="text-center align-middle text-warning">
                                            {{ $item->status }}
                                        @else
                                        <td class="text-center align-middle text-success">
                                            {{ $item->status }}
                                    @endif
                                    <td class="text-center align-middle">
                                        <a href="{{ url('ontheway', $item->id) }}" class="btn btn-warning">On the
                                            way</a>
                                        <a href="{{ url('delivered', $item->id) }}"
                                            class="btn btn-success my-2">Delivered</a>
                                    </td>
                                    <td class="align-middle">
                                        <a class="btn btn-secondary" href="{{ url('print_pdf', $item->id) }}">Print
                                            PDF</a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                {{-- <div class="d-flex justify-content-center mt-4">{{ $product->links() }}</div> --}}
            </div>
        </div>
    </div>
    <!-- JavaScript files-->

    <script type="text/javascript">
        function confirmation(event) {
            event.preventDefault();

            var urlToRedirect = event.currentTarget.getAttribute('href');

            swal({

                    title: "Are you sure to delete this ?",
                    text: "This delete will be parmanent",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = urlToRedirect;
                    }
                })
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>

</html>
