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
                    <h4 class="my-4">Edit Product</h4>
                    <div class="d-flex justify-content-center">
                        <form action="{{ url('edit_product', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="pt-2">
                                <label class="text-bold text-white" style="width: 150px;">Product Title</label>
                                <input style="width: 300px; height: 40px" type="text" name="title"
                                    value="{{ $product->title }}" required>
                            </div>
                            <div class="pt-2 d-flex align-items-center">
                                <label class="text-bold text-white align-center me-1"
                                    style="width: 150px;">Description</label>
                                <textarea style="width: 400px; height: 80px; margin-left: 4px" type="text" name="description" required> {{ $product->description }}"</textarea>
                            </div>
                            <div class="pt-2">
                                <label class="text-bold text-white" style="width: 150px;">Price</label>
                                <input style="width: 200px; height: 40px;" type="text" name="price"
                                    value="{{ $product->price }}" required>
                            </div>
                            <div class="pt-2">
                                <label class="text-bold text-white" style="width: 150px;">Quantity</label>
                                <input style="width: 150px; height: 40px" type="number" name="quantity"
                                    value="{{ $product->quantity }}" required>
                            </div>
                            <div class="pt-2">
                                <label class="text-bold text-white" style="width: 150px;">Product Category</label>
                                <select style="width: 100px; height: 40px;" name="category" id="">
                                    <option value="{{ $product->category }}">{{ $product->category }}</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-2">
                                <label class="text-bold text-white" style="width: 150px;">New Product Image</label>
                                <input style="width: 400px; height: 40px" type="file" name="image" required>
                            </div>
                            <input class="btn btn-primary my-2" type="submit" value="Edit Product">
                        </form>
                    </div>
                    <a class="btn btn-success" href="{{ url('/view_category') }}">Return</a>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
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
