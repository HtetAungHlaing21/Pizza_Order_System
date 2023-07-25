@extends('Admin.master')

@section('title', 'Order List')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-5'>
                        <form action="{{ route('orders#list') }}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="key" id="" placeholder="Enter Order Code"
                                class="form-control p-3" value="{{ request('key') }}">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-magnifying-glass p-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-2 p-3">
                        <h4 class="text-secondary"> Total - {{ $orders->total() }} </h4>
                    </div>
                    <div class="col-3 offset-2">
                        <form action="{{ route('orders#filter') }}" method="GET" class="d-flex">
                            <select name="orderStatus" id="" class="form-select">
                                <option value="">All</option>
                                <option value="pending" @if (request('orderStatus') == 'pending') selected @endif>Pending</option>
                                <option value="success" @if (request('orderStatus') == 'success') selected @endif>Success</option>
                                <option value="reject" @if (request('orderStatus') == 'reject') selected @endif>Rejected</option>
                            </select>
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-filter"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @if (count($orders) != 0)
                    <div class="table-responsive table-responsive-data2 my-4">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Order Time</th>
                                    <th>Order Code</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="orders">
                                @foreach ($orders as $order)
                                    <tr class="tr-shadow">
                                        <td class="col-3"> {{ $order->user_name }} </td>
                                        <td class="col-3"> {{ $order->created_at->format('d/m/Y   h:i A') }} </td>
                                        <td class="col-2"> {{ $order->order_code }} </td>
                                        <td class="col-2"> {{ $order->total }} Ks </td>
                                        <td class="col-2" id="status">
                                            @if ($order->status == 'pending')
                                                <div class="text-warning">
                                                    <i class="fa-regular fa-clock"></i> Pending
                                                </div>
                                            @elseif ($order->status == 'success')
                                                <div class="text-success">
                                                    <i class="fa-regular fa-square-check"></i> Success
                                                </div>
                                            @else
                                                <div class="text-danger">
                                                    <i class="fa-solid fa-xmark"></i> Rejected
                                                </div>
                                            @endif
                                        </td>
                                        <td class=>
                                            <div class="table-data-feature">
                                                <a href=" {{ route('orders#details', $order->order_code) }}" class="me-3">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View">
                                                        <i class="fa-solid fa-eye"></i>
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
                    <h4 class="text-secondary mt-5 text-center">There are no orders.</h4>
                @endif
                <!-- END DATA TABLE -->
                {{ $orders->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
