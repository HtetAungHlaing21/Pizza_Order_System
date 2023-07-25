@extends('Admin.master')

@section('title', 'Order Details')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="row mb-2">
                    <div class="col-2">
                        <a href="{{route('orders#list')}}" class="btn bg-primary text-white my-3">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="col-3">
                        @if (session('updateSuccess'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('updateSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="card col-4 shadow-sm">
                        <h4 class="card-title my-3">Order Details</h4>
                        <div class="card-text my-2">
                            <i class="fa-solid fa-file-invoice me-2"></i> Code : {{ $items[0]->order_code }}
                        </div>
                        <div class="card-text my-2">
                            <i class="fa-solid fa-calendar me-2"></i> Time :
                            {{ $items[0]->created_at->format('d/m/Y   h:i A') }}
                        </div>
                        <div class="card-text my-2">
                            <i class="fa-solid fa-coins me-2"></i> Total : {{ $items[0]->total_amount }} Ks <small
                                class="text-danger"> (includes delivery charges)</small>
                        </div>
                        <div class="card-text my-2 text-center">
                            @if ($items[0]->status == 'pending')
                                <div class="text-warning">
                                    <i class="fa-regular fa-clock"></i> Pending
                                </div>
                            @elseif ($items[0]->status == 'success')
                                <div class="text-success">
                                    <i class="fa-regular fa-square-check"></i> Success
                                </div>
                            @else
                                <div class="text-danger">
                                    <i class="fa-solid fa-xmark"></i> Rejected
                                </div>
                            @endif
                        </div>
                        @if ($items[0]->status == 'pending')
                            <hr>
                            <div class="text-center">
                            <a href="{{route('orders#changeStatus', [$items[0]->order_code ,"success"])}}" class="mx-5 mb-2" data-toggle="tooltip" data-placement="top" title="Accept">
                                <i class="fa-solid fa-circle-check fs-2 text-success"></i>
                            </a>
                            <a href="{{route('orders#changeStatus', [$items[0]->order_code ,"reject"])}}" class="mx-5 mb-2" data-toggle="tooltip" data-placement="top" title="Decline">
                                <i class="fa-solid fa-circle-xmark fs-2 text-danger"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="card col-4 offset-2 shadow-sm justify-content-center">
                        <h4 class="card-title my-3">Customer Details</h4>
                        <div class="card-text my-2">
                            <i class="fa-solid fa-user me-4"></i> {{ $items[0]->user_name }}
                        </div>
                        <div class="card-text my-2">
                            <i class="fa-solid fa-phone me-4"></i> {{ $items[0]->user_phone }}
                        </div>
                        <div class="card-text my-2">
                            <i class="fa-regular fa-envelope me-4"></i> {{ $items[0]->user_email }}
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2 my-4">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="tr-shadow">
                                    <td class="col-1">
                                        <img src="{{ asset('Storage/' . $item->product_image) }}" alt=""
                                            class="img-thumbnail">
                                    </td>
                                    <td class="col-3"> {{ $item->product_name }} </td>
                                    <td class="col-2"> {{ $item->quantity }} </td>
                                    <td class="col-2"> {{ $item->total }} Ks </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- END DATA TABLE -->
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection
