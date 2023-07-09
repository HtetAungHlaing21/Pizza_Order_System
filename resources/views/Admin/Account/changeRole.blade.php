@extends('Admin.master')

@section('title', 'Change Role')

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
                                <h3 class="text-center title-2">Update Role</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-4 offset-1">
                                    @if ($admin->image == null)
                                        @if ($admin->gender == 'male')
                                            <img src="{{ asset('Images/male_profile.png') }}"
                                                class="img-thumbnail shadow-sm" alt="male profile">
                                        @else
                                            <img src="{{ asset('Images/female_profile.png') }}"
                                                class="img-thumbnail shadow-sm" alt="female profile">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . $admin->image) }}" class="img-thumbnail shadow-sm"
                                            alt="">
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <p class="my-2"><i class="fa-solid fa-user me-3"></i> {{ $admin->name }} </p>
                                    <p class="my-2"><i class="fa-solid fa-venus-mars me-3"></i> {{ $admin->gender }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-phone me-3"></i>
                                        {{ $admin->phone_number }} </p>
                                    <p class="my-2"><i class="fa-solid fa-envelope me-3"></i> {{ $admin->email }}
                                    </p>
                                    <p class="my-2"><i class="fa-solid fa-map-location-dot me-3"></i>
                                        {{ $admin->address }} </p>
                                    <p class="my-2"><i class="fa-regular fa-calendar me-3"></i>
                                        {{ $admin->created_at->format('j-F-Y') }} </p>
                                    <form action="{{ route('account#rolechange', $admin->id) }}" class="my-3"
                                        method="post">
                                        @csrf
                                        <label for="">Choose Role</label>
                                        <select name="role" id="" class="form-select mb-3">
                                            <option value="admin" @if ($admin->role == 'admin') selected @endif>Admin
                                            </option>
                                            <option value="user" @if ($admin->role == 'user') selected @endif>User
                                            </option>
                                        </select>
                                        <button class="btn btn-primary" type="submit">
                                            Update <i class="fa-solid fa-right-to-bracket ms-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
