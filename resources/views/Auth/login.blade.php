@extends('Auth.master')

@section('title', 'Log In')

@section('content')
    <div class="my-3">
        @if (session('changeSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('changeSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="my-3">
        @if (session('message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="login-form">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email"
                    value="{{ old('email') }}">
            </div>
            <div>
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            <div>
                @error('password')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
            </p>
        </div>
    </div>
@endsection
