@extends('Admin.master')

@section('title', 'Pizza Update')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-1">
                    <button class="btn bg-primary text-white my-3" onclick=history.back()>
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#update')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1">
                                    <div>
                                        <img src="{{ asset('storage/' . $pizza->image) }}" alt=""
                                            class="img-thumbnail shadow-sm">
                                    </div>
                                    <input type="file" name="image" id=""
                                        class="form-control my-4 @error('image') is-invalid @enderror">
                                    <div class="invalid-feedback">
                                        @error('image')
                                            <small class="text-danger"> {{ $message }} </small>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="id" value={{$pizza->id}}>
                                    <div class="my-5">
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
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
                                            value="{{ old('name', $pizza->name) }}">
                                        <div class="invalid-feedback">
                                            @error('name')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Category</label>
                                        <select name="category" id=""
                                            class="form-select @error('category') is-invalid @enderror">
                                            <option value="">Choose Pizza Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if ($category->id == $pizza->category_id) selected @endif  > {{$category->name}} </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            @error('category')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="description" id="" cols="30" rows="7"  class="form-control @error('description') is-invalid @enderror">{{ old('description', $pizza->description) }}</textarea>
                                        <div class="invalid-feedback">
                                            @error('description')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                        <input name="price" type="number"
                                            class="form-control @error('price') is-invalid @enderror"
                                            value="{{ old('price', $pizza->price) }}">
                                        <div class="invalid-feedback">
                                            @error('price')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Waiting Time</label>
                                        <input name="waitingTime" type="number"
                                            class="form-control @error('waitingTime') is-invalid @enderror"
                                            value="{{ old('waitingTime', $pizza->waiting_time) }}">
                                        <div class="invalid-feedback">
                                            @error('waitingTime')
                                                <small class="text-danger"> {{ $message }} </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Last Updated Date</label>
                                        <input class="form-control" disabled
                                            value="{{ $pizza->updated_at->format('j-F-Y')}}">
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
