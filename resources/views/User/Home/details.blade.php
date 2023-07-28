@extends('User.master')

@section('title', 'Pizza Details')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        @if (session('reviewSuccess'))
            <div class="alert alert-success alert-dismissible fade show col-4 offset-4 text-center" role="alert">
                {{ session('reviewSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <img class="w-100 h-100" src="{{ asset('Storage/' . $pizza->image) }}" alt="Pizza Image">
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3> {{ $pizza->name }} </h3>
                    <input type="hidden" id="userID" value="{{ Auth::user()->id }}">
                    <input type="hidden" id="pizzaID" value="{{ $pizza->id }}">
                    <div class="d-flex mb-3">
                        <div class="text-warning mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1 ms-3"> <i class="fa-solid fa-eye"></i> {{ $pizza->view_count + 1 }} </small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4"> {{ $pizza->price }} Ks</h3>
                    <p class="mb-4"> {{ $pizza->description }} </p>
                    <div class="d-flex align-items-center mb-4 pt-2 mt-5">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-warning-subtle border-0 text-center" id="qty"
                                value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-warning px-3" id="addBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f "></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter "></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in "></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest "></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark fs-4" data-toggle="tab" href="#tab-pane-3"><b>Reviews
                                ({{ $reviews->total() }})</b></a>
                    </div>
                    @php
                        $hasRated = False;
                    @endphp
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="mb-4">{{ $reviews->total() }} reviews for {{ $pizza->name }} </h4>
                                    @if (count($reviews) != 0)
                                        @foreach ($reviews as $review)
                                            <div class="media mb-4 row">
                                                <div class="image col-2">
                                                    @if ($review->image == null)
                                                        @if ($review->gender == 'male')
                                                            <img src="{{ asset('Images/male_profile.png') }}"
                                                                class="img-thumbnail" alt="male profile">
                                                        @else
                                                            <img src="{{ asset('Images/female_profile.png') }}"
                                                                class="img-thumbnail" alt="female profile">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/' . $review->image) }}" alt=""
                                                            class="img-thumbnail">
                                                    @endif
                                                </div>
                                                <div class="col">
                                                    <h6 class=>{{ $review->name }}<small>-
                                                            <i>{{ $review->created_at->format('d/m/Y') }} </i></small></h6>
                                                    <div class="text-warning mb-2">
                                                        @for ($i = 1; $i <= $review->rating_count; ++$i)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    </div>
                                                    <p>{{ $review->review }}</p>
                                                </div>
                                            </div>
                                            @php
                                                if (Auth::user()->id == $review->user_id) {
                                                    $hasRated = True;
                                                }
                                            @endphp
                                        @endforeach
                                    @else
                                        <h3 class="text-secondary text-center my-5">There are no reviews yet.</h3>
                                    @endif
                                    <div class="my-3">
                                        {{ $reviews->links() }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if ($hasRated == False)
                                        <div>
                                            <h4 class="mb-4">Leave a review</h4>
                                            <form action="{{ route('rating#rate') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="userID" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="productID" value="{{ $pizza->id }}">
                                                <div class="form-group">
                                                    <label for="">Your Rating</label>
                                                    <select name="rating" id=""
                                                        class="form-control @error('rating') is-invalid @enderror">
                                                        <option value="">Choose your rating.</option>
                                                        <option value="1">1 Star - Very Bad</option>
                                                        <option value="2">2 Stars - Bad</option>
                                                        <option value="3">3 Stars - Good</option>
                                                        <option value="4">4 Stars - Very Good</option>
                                                        <option value="5">5 Stars - Excellent</option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        @error('rating')
                                                            <small class="text-danger"> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message">Your Review</label>
                                                    <textarea id="message" cols="30" rows="5" name="review"
                                                        class="form-control @error('review') is-invalid @enderror" placeholder="Leave your message.">{{ old('review') }}</textarea>
                                                    <div class="invalid-feedback">
                                                        @error('review')
                                                            <small class="text-danger"> {{ $message }} </small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <input type="submit" value="Rate the pizza"
                                                        class="btn btn-warning px-3">
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <h3 class="text-secondary text-center mt-5">Thanks for your review.</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-warning pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzas as $pizza)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100 img-thumbnail" src="{{ asset('Storage/' . $pizza->image) }}"
                                    style="height:300px" alt="Pizza Image">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('cart#add', $pizza->id) }}"><i
                                            class="fa-solid fa-cart-shopping"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('pizza#details', $pizza->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href=""> {{ $pizza->name }} </a>
                                <input type="hidden" name="" id="productID" value=" {{ $pizza->id }} ">
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> {{ $pizza->price }} Ks</h5>
                                    <h6 class="text-muted ml-2"></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('ajaxScript')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "get",
                url: "/pizza/view",
                data: {
                    'productID': $("#pizzaID").val()
                },
                dataType: 'json'
            })

            $("#addBtn").click(function() {
                $userID = $("#userID").val();
                $productID = $("#pizzaID").val();
                $quantity = $("#qty").val();
                $data = {
                    'userID': $userID,
                    'productID': $productID,
                    'quantity': $quantity
                };
                $.ajax({
                    type: 'get',
                    url: '/cart/details',
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = '/user/home';
                        }
                    }
                })
            })
        })
    </script>
@endsection
