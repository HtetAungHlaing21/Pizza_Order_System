@extends('Admin.master')

@section('title', 'Create Pizza')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="BBQ Chicken..." value="{{ old('name') }}">
                                <div class="invalid-feedback">
                                    @error('name')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category" id=""
                                    class="form-select @error('category') is-invalid @enderror">
                                    <option value="" selected>Choose category.</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    @error('category')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment"
                                    class="control-label mb-1">Image</label>
                                <input type="file" name="image" id="" class="form-control  @error('image') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    @error('image')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea name="description" id="" cols="30" rows="7" placeholder="Enter description"
                                    class="form-control @error('category') is-invalid @enderror">{{old('description')}}</textarea>
                                <div class="invalid-feedback">
                                    @error('description')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="number"
                                    class="form-control @error('price') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Enter price..." value="{{ old('price') }}">
                                <div class="invalid-feedback">
                                    @error('price')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="waitingTime" type="number"
                                    class="form-control" aria-required="true"
                                    aria-invalid="false" placeholder="Enter waiting time..."
                                    value="{{ old('waitingTime') }}">
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
