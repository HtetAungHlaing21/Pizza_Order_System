@extends('Admin.master')

@section('title', 'Account Details')

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
                                <h3 class="text-center title-2">Account Details</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('Images/male_profile.png') }}" alt="male profile">
                                        @else
                                            <img src="{{ asset('Images/female_profile.png') }}" alt="female profile">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'. Auth::user()->image) }}" alt="">
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <p class="my-2"><i class="fa-solid fa-user me-3"></i> {{ Auth::user()->name }} </p>
                                    <p class="my-2"><i class="fa-solid fa-venus-mars me-3"></i> {{ Auth::user()->gender }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-desktop me-3"></i> {{ Auth::user()->role }} </p>
                                    <p class="my-2"><i class="fa-solid fa-phone me-3"></i>
                                        {{ Auth::user()->phone_number }} </p>
                                    <p class="my-2"><i class="fa-solid fa-envelope me-3"></i> {{ Auth::user()->email }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-map-location-dot me-3"></i>
                                        {{ Auth::user()->address }} </p>
                                    <p class="my-2"><i class="fa-regular fa-calendar me-3"></i>
                                        {{ Auth::user()->created_at->format('j-F-Y') }} </p>
                                </div>
                            </div>
                            <div class="row">
                                <a href="{{ route('account#updatePage') }}" class="btn btn-primary w-25 my-3 m-auto"> Edit
                                    <i class="fa-solid fa-pen-to-square ms-3"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
