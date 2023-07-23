@extends('User.master')

@section('title', 'History')

@section('content')
    <!-- History Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-lg-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total</th>
                            <th>Status</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- History End -->
@endsection
