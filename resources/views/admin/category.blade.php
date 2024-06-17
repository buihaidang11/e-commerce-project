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
                    <h2>Add Category</h2>
                    <form action="{{ url('add_category') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-center align-items-center">
                            <input style="width: 400px; height: 50px" type="text" name="category">
                            <input class="btn btn-primary mx-2" type="submit" value="Add Category">
                        </div>
                    </form>
                    <h4 class="my-4">All Category</h4>
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th class="text-center" scope="col">Category</th>
                                <th class="" scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($category as $key => $cate)
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td class="text-center">{{ $cate->category_name }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('edit_category', $cate->id) }}" class="btn btn-success">Edit</a>
                                        <a onclick="confirmation(event)" class="btn btn-danger"
                                            href="{{ url('delete_category', $cate->id) }}">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
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
