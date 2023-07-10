@extends('Admin.master')

@section('title', 'Pizza List')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Pizza List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#createPage') }}">
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
                        <form action="{{route('product#list')}}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="key" id="" placeholder="Search" class="form-control p-3" value="{{request('key')}}">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-magnifying-glass p-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-2 p-3">
                        <h4 class="text-secondary"> Total - {{ $pizzas->total() }} </h4>
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
                @if (count($pizzas) != 0)
                    <div class="table-responsive table-responsive-data2 my-4 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Views</th>
                                    <th>Updated At</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pizzas as $pizza)
                                    <tr class="tr-shadow">
                                        <td class="col-3"> <img src="{{asset('Storage/'. $pizza->image)}}" class="img-thumbnail shadow-sm" alt=""></td>
                                        <td class="col-3"> {{ $pizza->name }} </td>
                                        <td class="col-2"> {{ $pizza->category_name }} </td>
                                        <td class="col-2"> {{ $pizza->price }} Ks </td>
                                        <td class="col-1"> <i class="fa-solid fa-eye"></i> {{ $pizza->view_count }} </td>
                                        <td class=""> {{ $pizza->updated_at->format('d/m/Y   g:i A') }} </td>
                                        <td>
                                            <div class="table-data-feature">
                                                 <a href="{{route('product#details', $pizza->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View More">
                                                        <i class="fa-solid fa-maximize"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('product#updatePage', $pizza->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Update">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('product#delete', $pizza->id)}}" class="">
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
                    <h4 class="text-secondary mt-5 text-center">There is no pizza.</h4>
                @endif
                <!-- END DATA TABLE -->

                {{$pizzas->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
