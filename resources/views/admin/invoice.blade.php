<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <center>
        <h3>Customer name: {{ $order->name }}</h3>
        <h3>Customer address: {{ $order->rec_address }}</h3>
        <h3>Customer phone: {{ $order->phone }}</h3>
        <h3>Product: {{ $order->product->title }}</h3>
        <h3>Price: {{ $order->product->price }}</h3>
        <img src="product_images/{{ $order->product->image }}" alt="">
    </center>
</body>

</html>
