<section class="shop_section layout_padding">
    <div class="container p-0">
        <div class="heading_container heading_center">
            <h2>
                Latest Products
            </h2>
        </div>
        <div class="row">
            @foreach ($product as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <div class="img-box">
                            <img src="/product_images/{{ $item->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h6>
                                {{ $item->title }}
                            </h6>
                            <h6>
                                <span>
                                    {{ $item->price }}$
                                </span>
                            </h6>
                        </div>
                        <div class="new">
                            <span>
                                New
                            </span>
                        </div>
                        <div class="py-2 d-flex justify-content-between">
                            <a class="btn btn-info px-4 mr-2 text-white"
                                href="{{ url('product_details', $item->id) }}">Details</a>
                            <a class="add-to-cart-btn btn btn-success px-2 text-white"
                                data-product-id="{{ $item->id }}" href="#">Buy</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <div class="btn-box">
            <a href="">
                View All Products
            </a>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-to-cart-btn').click(function(e) {
            e.preventDefault();

            var product_id = $(this).data('product-id');

            $.ajax({
                type: 'GET',
                url: '/add_cart/' + product_id,
                success: function(data) {
                    alert('Sản phẩm đã được thêm vào giỏ hàng!');
                },
                error: function(xhr) {
                    alert('Lỗi khi thêm sản phẩm vào giỏ hàng.');
                }
            });
        });
    });
</script>
