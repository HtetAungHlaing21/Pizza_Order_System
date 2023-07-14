@extends('User.master')

@section('title', 'Cart')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cartTable">
                        @foreach ($carts as $cart)
                            <tr id="details">
                                <td class="align-middle img-thumbnail col-2"><img
                                        src="{{ asset('Storage/' . $cart->product_image) }}" alt="Pizza Image"
                                        style="width: 50px;"></td>
                                <input type="hidden" name="" id="cartID" value=" {{ $cart->id }} ">
                                <td class="align-middle col-3"> {{ $cart->product_name }} </td>
                                <td class="align-middle" id="price"> {{ $cart->product_price }} Ks </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-outline-warning border-0 text-center quantity"
                                            id="qty" value={{ $cart->quantity }}>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total col-2" id="total">
                                    {{ $cart->product_price * $cart->quantity }}
                                    Ks</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btn-cross"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-warning pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="alltotal"> {{ $total }} Ks </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium"> 3000 Ks </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal"> {{ $total + 3000 }} Ks </h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-2 py-3">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-2 py-3" id="deleteCart">Delete
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('ajaxScript')
    <script>
        function calculateTotal() {
            $total = 0
            $('#cartTable tr').each(function(index, row) {
                $total += Number($(row).find("#total").html().replace('Ks', ''))
            })
            $("#alltotal").html($total + " Ks");
            $("#finalTotal").html(($total + 3000) + ' Ks')
        }
        $(document).ready(function() {
            $(".btn-plus").click(function() {
                $parent = $(this).parents("#details");
                $quantity = $parent.find('#qty').val();
                $cartId = $parent.find("#cartID").val();
                $price = Number($parent.find('#price').html().replace('Ks', ''));
                $total = $quantity * $price;
                $parent.find('#total').html($total + " Ks");
                calculateTotal();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/cart/update',
                    data: {
                        'quantity': $quantity,
                        'cartID': $cartId
                    },
                    dataType: 'json'
                })
            })
            $(".btn-minus").click(function() {
                $parent = $(this).parents("#details");
                $quantity = $parent.find('#qty').val();
                $cartId = $parent.find("#cartID").val();
                $price = Number($parent.find('#price').html().replace('Ks', ''));
                $total = $quantity * $price;
                $parent.find('#total').html($total + " Ks");
                calculateTotal();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/cart/update',
                    data: {
                        'quantity': $quantity,
                        'cartID': $cartId
                    },
                    dataType: 'json'
                })
            })
            $(".btn-cross").click(function() {
                $cartId = $(this).parents('#details').find("#cartID").val();
                $(this).parents('#details').remove();
                calculateTotal();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/cart/delete',
                    data: {
                        'cartID': $cartId
                    },
                    dataType: 'json'
                })

            })

            $(".quantity").change(function() {
                $parent = $(this).parents("#details");
                $quantity = $parent.find('#qty').val();
                $cartId = $parent.find("#cartID").val();
                $price = Number($parent.find('#price').html().replace('Ks', ''));
                $total = $quantity * $price;
                $parent.find('#total').html($total + " Ks");
                calculateTotal();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/cart/update',
                    data: {
                        'quantity': $quantity,
                        'cartID': $cartId
                    },
                    dataType: 'json'
                })
            })

            $("#deleteCart").click(function() {
                $("#cartTable").remove();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/cart/delete/all',
                    success: function(response) {
                       window.location.href = 'http://127.0.0.1:8000/user/home';
                    }
                })
            })
        })
    </script>
@endsection
