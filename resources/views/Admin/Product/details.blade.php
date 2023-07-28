@extends('Admin.master')

@section('title', 'Pizza Details')

@section('content')
    <div class="">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-2">
                        <button class="btn bg-primary text-white my-3" onclick=history.back()>
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                    </div>
                    <div class="col-3">
                        @if (session('updateSuccess'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <div>
                                        <img src="{{ asset('storage/' . $pizza->image) }}" class="img-thumbnail shadow-sm"
                                            alt="">
                                    </div>
                                    <div class="row">
                                        <a href="{{ route('product#updatePage', $pizza->id) }}"
                                            class="btn btn-primary my-5 w-50 m-auto"> Edit
                                            <i class="fa-solid fa-pen-to-square ms-3"></i> </a>
                                    </div>
                                </div>
                                <div class="col-6 offset-1">
                                    <p class="my-2"><i class="fa-solid fa-file-signature me-3"></i> {{ $pizza->name }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-list-check me-3"></i>
                                        {{ $pizza->category_name }} </p>
                                    <p class="my-2"><i class="fa-solid fa-coins me-3"></i>
                                        {{ $pizza->price }} Ks</p>
                                    <p class="my-2"><i class="fa-solid fa-eye me-3"></i> {{ $pizza->view_count }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-clock me-3"></i>
                                        @if ($pizza->waiting_time == null)
                                            Not Provided
                                        @else
                                            {{ $pizza->waiting_time }} mins
                                        @endif
                                    </p>
                                    <p class="my-2"><i class="fa-regular fa-calendar me-3"></i>
                                        {{ $pizza->updated_at->format('j-F-Y') }} </p>
                                    <br>
                                    <strong>Description</strong>
                                    <p class="my-2">{{ $pizza->description }} </p>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-8 offset-2">
                                        <h4 class="mb-5">{{ $reviews->total() }} reviews for {{ $pizza->name }} </h4>
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
                                                            <img src="{{ asset('storage/' . $review->image) }}"
                                                                alt="" class="img-thumbnail">
                                                        @endif
                                                    </div>
                                                    <div class="col">
                                                        <h6 class=>{{ $review->name }}<small>-
                                                                <i>{{ $review->created_at->format('d/m/Y') }} </i></small>
                                                        </h6>
                                                        <div class="text-warning mb-2">
                                                            @for ($i = 1; $i <= $review->rating_count; ++$i)
                                                                <i class="fas fa-star"></i>
                                                            @endfor
                                                        </div>
                                                        <p>{{ $review->review }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 class="text-secondary text-center my-5">There are no reviews yet.</h3>
                                        @endif
                                        <div class="my-3">
                                            {{ $reviews->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
