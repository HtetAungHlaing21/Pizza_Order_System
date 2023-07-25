@extends('User.master')

@section('title', 'Order History')

@section('content')
    <!-- History Start -->
    <div class="container-fluid">
        <div class="row my-5">
            <div class='col-lg-4 offset-lg-3'>
                <form action="{{ route('order#history') }}" method="get" class="d-flex">
                    @csrf
                    <input type="text" name="key" id="" placeholder="Enter Order Code" class="form-control p-3"
                        value="{{ request('key') }}">
                    <button type='submit' class='btn btn-warning'>
                        <i class="fa-solid fa-magnifying-glass "></i>
                    </button>
                </form>
            </div>
            <div class="col-2 offset-1">
                <h4 class="text-secondary"> Total - {{ $orders->total() }} </h4>
            </div>
        </div>
        <div class="row px-xl-5">
            @if (count($orders) != 0)
                <div class="col-lg-8 offset-lg-2 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="cartTable">
                            @foreach ($orders as $order)
                                <tr id="details">
                                    <td class="align-middle"> {{ $order->created_at->format('d/m/Y   h:i A') }} </td>
                                    <td class="align-middle" id="price"> {{ $order->order_code }} </td>
                                    <td class="align-middle total" id="total">{{ $order->total }}Ks</td>
                                    <td class="align-middle total " id="">
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
                                    <td>
                                        <div class="table-data-feature">
                                            <a href=" {{ route('order#details', $order->order_code) }}" class="me-3">
                                                <button class="item btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top"
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
                    <div class="mt-5">
                        {{ $orders->appends(request()->query())->links() }}
                    </div>
                </div>
            @else
                <h4 class="text-secondary text-center my-5">You haven't ordered anything yet.</h4>
            @endif
        </div>
    </div>
    <!-- History End -->
@endsection
