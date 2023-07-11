@extends('User.master')

@section('title', 'Change Password')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-1 offset-4">
                    <button class="btn bg-warning text-white my-3" onclick=history.back()>
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </div>
                <div class="col-3">
                    @if (session('notMatch'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('notMatch') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 offset-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('useraccount#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label mb-1">Old Password</label>
                                    <input name="oldPassword" type="password"
                                        class="form-control @error('oldPassword') is-invalid @enderror"
                                        value="{{ old('oldPassword') }}" placeholder="Enter old password.">
                                    <div class="invalid-feedback">
                                        @error('oldPassword')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid @enderror"
                                        placeholder="Enter new password.">
                                    <div class="invalid-feedback">
                                        @error('newPassword')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        placeholder="Confirm new password.">
                                    <div class="invalid-feedback">
                                        @error('confirmPassword')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="btn btn-warning col-4 offset-4" type="submit">
                                        Change <i class="fa-solid fa-right-to-bracket ms-3"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
