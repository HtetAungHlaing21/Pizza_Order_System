@extends('Auth.master')

@section('title', 'Register')

@section('content')
    <div class="login-form">
        <form action="{{route('register')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username" value="{{old('name')}}">
            </div>
            <div>
                @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
             <div class="form-group">
                <label>Gender</label>
                <select name="gender" id="" class="form-select">
                    <option value="">Choose your gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div>
                @error('gender')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
             <div class="form-group">
                <label>Phone Number</label>
                <input class="au-input au-input--full" type="text" name="phoneNumber" placeholder="Phone Number" value="{{old('phoneNumber')}}">
            </div>
            <div>
                @error('phoneNumber')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email" value="{{old('email')}}">
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
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            <div>
                @error('password_confirmation')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{route('auth#loginPage')}}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
