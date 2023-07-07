@extends('Admin.master')

@section('title', 'Category List')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class='col-5'>
                        <form action="{{route('category#list')}}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="key" id="" placeholder="Search" class="form-control p-3" value="{{request('key')}}">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-magnifying-glass p-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-2 p-3">
                        <h4 class="text-secondary"> Total - {{$categories->total()}} </h4>
                    </div>
                    @if (session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show col-5" role="alert">
                            {{ session('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                     @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show col-5" role="alert">
                            {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                     @if (session('updateSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show col-5" role="alert">
                            {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2 my-4">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="tr-shadow">
                                        <td class="col-2"> {{ $category->id }} </td>
                                        <td class="col-4"> {{ $category->name }} </td>
                                        <td> {{ $category->created_at->format('d/m/Y   n:i A') }} </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href=" {{route('category#updatePage', $category->id)}} " class="me-3">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Update">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete', $category->id) }}" class="me-3">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <h4 class="text-secondary mt-5">There is no category.</h4>
                @endif
                <!-- END DATA TABLE -->
                {{$categories->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
