@extends('User.master')

@section('title', 'Customer Dashboard')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Categories Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-warning pr-3">Filter by
                        Category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <a href="{{ route('user#home') }}" class="text-decoration-none text-dark h6">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <label class="" for="">All Categories</label>
                            <span class="badge border font-weight-normal text-dark"> {{ count($categories) }} </span>
                        </div>
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('user#filter', $category->id) }}" class="text-decoration-none text-dark h6">
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <label class="" for=""> {{ $category->name }} </label>
                            </div>
                        </a>
                    @endforeach
                </div>
                <!-- Categories End -->
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('cart#summary') }}" class="text-decoration-none me-2">
                                    <button class="btn btn-sm btn-light position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                            {{ count($carts) }}
                                        </span>
                                    </button>
                                </a>
                                <a href="{{route('order#history')}}" class="text-decoration-none me-2">
                                    <i class="fa-solid fa-clock-rotate-left btn btn-sm btn-light"></i>
                                </a>
                                <a href="{{route('contact#message')}}" class="text-decoration-none me-2">
                                    <i class="fa-solid fa-message btn btn-sm btn-light"></i>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sort" id="sorting" class="form-control">
                                        <option value="" selected>Sorting</option>
                                        <option value="desc">Latest to Oldest</option>
                                        <option value="asc">Oldest to Latest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 offset-3 text-center">
                        @if (session('createSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('createSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    @if (count($products) != 0)
                        <div class="row" id="pizzaList">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100 img-thumbnail shadow-sm"
                                                src="{{ asset('Storage/' . $product->image) }}" alt=""
                                                style="height:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route("cart#add", $product->id)}}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('pizza#details', $product->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">
                                                {{ $product->name }} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $product->price }} Ks</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-6 offset-3 p-3 shadow-sm text-center">
                                <b>There is no pizza under this category.</b>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('ajaxScript')
    <script>
        $(document).ready(function() {
            $("#sorting").change(function() {
                $eventOption = $('#sorting').val();
                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/home/sort',
                        data: {
                            'sort': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100 img-thumbnail shadow-sm"
                                                src="{{ asset('Storage/${response[$i].image}') }}" alt=""
                                                style="height:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route("cart#add", $product->id)}}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                @if (isset($product))
                                                    <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#details', $product->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">
                                                ${response[$i].name} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5> ${response[$i].price} Ks</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                            }
                            $('#pizzaList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/home/sort',
                        data: {
                            'sort': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100 img-thumbnail shadow-sm"
                                                src="{{ asset('Storage/${response[$i].image}') }}" alt=""
                                                style="height:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="{{route("cart#add", $product->id)}}"><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                @if (isset($product))
                                                    <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#details', $product->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">
                                                ${response[$i].name} </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5> ${response[$i].price} Ks</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                                <small class="fa fa-star text-warning mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                            }
                            $('#pizzaList').html($list);
                        }
                    })
                }
            })
        })
    </script>
@endsection
