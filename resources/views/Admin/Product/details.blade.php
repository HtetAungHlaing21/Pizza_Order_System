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
                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="img-thumbnail shadow-sm" alt="">
                                </div>
                                <div class="col-6 offset-1">
                                    <p class="my-2"><i class="fa-solid fa-file-signature me-3"></i> {{ $pizza->name }} </p>
                                    <p class="my-2"><i class="fa-solid fa-list-check me-3"></i> {{ $pizza->category_name }} </p>
                                    <p class="my-2"><i class="fa-solid fa-coins me-3"></i>
                                        {{ $pizza->price }} Ks</p>
                                    <p class="my-2"><i class="fa-solid fa-eye me-3"></i> {{ $pizza->view_count }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-clock me-3"></i>
                                        @if ($pizza->waiting_time == null)
                                            Not Provided
                                        @else
                                            {{ $pizza->waiting_time }} mins
                                        @endif </p>
                                    <p class="my-2"><i class="fa-regular fa-calendar me-3"></i>
                                        {{ $pizza->updated_at->format('j-F-Y') }} </p>
                                    <br>
                                    <strong>Description</strong>
                                    <p class="my-2">{{ $pizza->description }} </p>
                                </div>
                            </div>
                            <div class="row">
                                <a href="{{route('product#updatePage', $pizza->id)}}" class="btn btn-primary w-25 my-3 m-auto"> Edit
                                    <i class="fa-solid fa-pen-to-square ms-3"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
