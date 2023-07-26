@extends('Admin.master')

@section('title', 'Customer List')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Customer List</h2>

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
                        <form action="{{ route('account#userList') }}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="key" id="" placeholder="Search"
                                class="form-control p-3" value="{{ request('key') }}">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-magnifying-glass p-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-2 p-3">
                        <h4 class="text-secondary"> Total - {{ $users->total() }} </h4>
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
                @if (count($users) != 0)
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
                                @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <td class="col-1"> {{ $user->id }} </td>
                                        <td class="col-2">
                                            @if ($user->image != null)
                                                <img src="{{ asset('Storage/' . $user->image) }}" alt=""
                                                    class="img-thumbnail shadow-sm">
                                            @else
                                                @if ($user->gender == 'male')
                                                    <img src="{{ asset('Images/male_profile.png') }}" alt=""
                                                        class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('Images/female_profile.png') }}" alt=""
                                                        class="img-thumbnail shadow-sm">
                                                @endif
                                            @endif
                                        </td>
                                        <td class="col-2"> {{ $user->name }} </td>
                                        <td class="col-3"> {{ $user->phone_number }} </td>
                                        <td class="col-3"> {{ $user->email }} </td>
                                        <td class="col">
                                            <div class="table-data-feature">
                                                <a href=" {{ route('account#upgrade', $user->id) }} " class="me-3">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Change Admin">
                                                        <i class="fa-solid fa-wand-sparkles"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('account#userDelete', $user->id) }}" class="me-3">
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
                    <h4 class="text-secondary mt-5 text-center">There is no customer.</h4>
                @endif
                <!-- END DATA TABLE -->
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
