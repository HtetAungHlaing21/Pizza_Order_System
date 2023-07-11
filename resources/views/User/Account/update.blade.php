@extends('User.master')

@section('title', 'Account Update')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1">
                    <button class="btn bg-warning text-white my-3" onclick=history.back()>
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Details</h3>
                        </div>
                        <hr>
                        <form action="{{ route('useraccount#update', Auth::user()->id) }}" method="post"
                            novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <div>
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('Images/male_profile.png') }}" alt="male profile" class="img-thumbnail shadow-sm">
                                            @else
                                                <img src="{{ asset('Images/female_profile.png') }}" alt="female profile" class="img-thumbnail shadow-sm">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="" class="img-thumbnail shadow-sm">
                                        @endif
                                    </div>
                                    <input type="file" name="image" id=""
                                        class="form-control my-4 @error('image') is-invalid @enderror">
                                    <div class="invalid-feedback">
                                        @error('image')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                    <div class="my-5">
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                            <span id="payment-button-amount">Update</span>
                                            <i class="fa-solid fa-marker ms-3"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6 offset-1">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Name</label>
                                        <input name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', Auth::user()->name) }}">
                                        <div class="invalid-feedback">
                                            @error('name')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Gender</label>
                                        <select name="gender" id=""
                                            class="form-select @error('gender') is-invalid @enderror">
                                            <option value="">Choose your gender</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('gender')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <input name="role" type="text" class="form-control"
                                            value="{{ old('role', Auth::user('role')) }}" disabled readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone Number</label>
                                        <input name="phoneNumber" type="text"
                                            class="form-control @error('phoneNumber') is-invalid @enderror"
                                            value="{{ old('phoneNumber', Auth::user()->phone_number) }}">
                                        <div class="invalid-feedback">
                                            @error('phoneNumber')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Email Address</label>
                                        <input name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', Auth::user()->email) }}">
                                        <div class="invalid-feedback">
                                            @error('email')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="30" rows="10" placeholder="Enter your full address"
                                            class="form-control @error('address') is-invalid @enderror"> {{ old('address', Auth::user()->address) }} </textarea>
                                        <div class="invalid-feedback">
                                            @error('address')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
