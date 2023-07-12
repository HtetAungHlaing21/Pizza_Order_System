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

                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Popularity</a>
                                        <a class="dropdown-item" href="#">Best Rating</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($products) != 0)
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100 img-thumbnail shadow-sm"
                                                src="{{ asset('Storage/' . $product->image) }}" alt=""
                                                style="height:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{route('pizza#details', $product->id)}}"><i
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
