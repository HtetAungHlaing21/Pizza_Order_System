@extends('Admin.master')

@section('title', 'Admin List')

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
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class='col-5'>
                        <form action="{{ route('account#adminList') }}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="key" id="" placeholder="Search"
                                class="form-control p-3" value="{{ request('key') }}">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-magnifying-glass p-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-2 p-3">
                        <h4 class="text-secondary"> Total - {{ $admins->total() }} </h4>
                    </div>
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
                @if (count($admins) != 0)
                    <div class="table-responsive table-responsive-data2 my-4">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr class="tr-shadow">
                                        <td class="col-1"> {{ $admin->id }} </td>
                                        <td class="col-2">
                                            @if ($admin->image != null)
                                                <img src="{{ asset('Storage/' . $admin->image) }}" alt=""
                                                    class="img-thumbnail shadow-sm">
                                            @else
                                                @if ($admin->gender == 'male')
                                                    <img src="{{ asset('Images/male_profile.png') }}" alt=""
                                                        class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('Images/female_profile.png') }}" alt=""
                                                        class="img-thumbnail shadow-sm">
                                                @endif
                                            @endif
                                        </td>
                                        <td class="col-2"> {{ $admin->name }} </td>
                                        <td class="col-3"> {{ $admin->phone_number }} </td>
                                        <td class="col-3"> {{ $admin->email }} </td>
                                        <td class="col">
                                            <div class="table-data-feature">
                                                @if ($admin->id != Auth::user()->id)
                                                    <a href=" {{route('account#changerole', $admin->id)}} " class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Update Role">
                                                            <i class="fa-solid fa-wand-sparkles"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('account#adminDelete', $admin->id) }}" class="me-3">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <h4 class="text-secondary mt-5 text-center">There is no admin for this search.</h4>
                @endif
                <!-- END DATA TABLE -->
                {{ $admins->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
