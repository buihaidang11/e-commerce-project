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
                    <h4 class="my-4">All Product</h4>
                    <div class="d-flex justify-content-center py-4">
                        <form action="{{ url('product_search') }}" method="get">
                            @csrf
                            <input class="border" style="width: 400px; height:40px; border-radius: 32px;" type="search"
                                name="search">
                            <input class="btn btn-primary text-white" style="height:40px; border-radius: 32px;"
                                type="submit" value="Search">
                        </form>
                    </div>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th class="text-center" scope="col">Title</th>
                                <th class="text-center" scope="col">Description</th>
                                <th class="text-center" scope="col">Price</th>
                                <th class="text-center" scope="col">Category</th>
                                <th class="text-center" scope="col">Quantity</th>
                                <th class="text-center" scope="col">Image</th>
                                <th class="" scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($product as $key => $item)
                            <tbody>
                                <tr>
                                    <th scope="row" class="align-middle">{{ $key + 1 }}</th>
                                    <td class="text-center align-middle">{{ $item->title }}</td>
                                    <td class="text-center align-middle">
                                        {{ mb_strlen($item->description) > 50 ? mb_substr($item->description, 0, 40) . '...' : $item->description }}
                                    </td>
                                    <td class="text-center align-middle">{{ $item->price }}</td>
                                    <td class="text-center align-middle">{{ $item->category }}</td>
                                    <td class="text-center align-middle">{{ $item->quantity }}</td>
                                    <td class="text-center align-middle">
                                        <img style="width:120px; height:120px" src="product_images/{{ $item->image }}"
                                            class="img-thumbnail" alt="">
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="{{ url('edit_product', $item->id) }}" class="btn btn-success">Edit</a>
                                        <a onclick="confirmation(event)" class="btn btn-danger"
                                            href="{{ url('delete_product', $item->id) }}">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">{{ $product->links() }}</div>
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
