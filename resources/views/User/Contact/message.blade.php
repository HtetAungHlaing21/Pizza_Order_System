@extends('User.master')

@section('title', 'Message')

@section('content')
    <div class="container">
        <h2 class="text-warning text-center my-3">Have some questions?</h2>
        <p class="text-secondary text-center my-3">Send a message to Admin!</p>
        <div class="row">
            <form action="{{ route('contact#sendMessage') }}" method='POST' class="col-6 offset-3 my-3 shadow-sm px-5 py-3">
                @csrf
                <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id=""
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                        placeholder="Enter your name.">
                    <div>
                        @error('name')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="number" name="phone" id=""
                        class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                        placeholder="Enter your phone number.">
                    <div>
                        @error('phone')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id=""
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                        placeholder="Enter your email.">
                    <div>
                        @error('email')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="form-label">Message</label>
                    <textarea name="message" id="" cols="30" rows="10"
                        class="form-control @error('message') is-invalid @enderror" placeholder="Enter your message.">{{ old('message') }}</textarea>
                    <div>
                        @error('message')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-warning col my-3">
                    <i class="fa-solid fa-location-arrow me-2"></i> Send
                </button>
            </form>
            <div class="row">
                <a href="{{route('contact#history', Auth::user()->id )}}" class="btn btn-success col-2 offset-5 my-3">
                    View Previous Messages
                </a>
            </div>
        </div>
    </div>
@endsection
