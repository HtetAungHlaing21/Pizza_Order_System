@extends('Admin.master')

@section('title', 'Update Category')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Category</h3>
                        </div>
                        <hr>
                        <form action="{{ route('category#update') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div>
                                <input type="hidden" name="id" value="{{ $category->id }}">
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="categoryName" type="text"
                                    class="form-control @error('categoryName') is-invalid @enderror" aria-required="true"
                                    aria-invalid="false" placeholder="Seafood..."
                                    value="{{ old('categoryName', $category->name) }}">
                                <div class="invalid-feedback">
                                    @error('categoryName')
                                        <small class="text-danger"> {{ $message }} </small>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block">
                                    <span id="payment-button-amount">Update</span>
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
