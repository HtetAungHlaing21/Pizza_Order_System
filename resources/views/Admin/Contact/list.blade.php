@extends('Admin.master')

@section('title', 'Message List')

@section('content')
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Message List</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class='col-5'>
                        <form action="{{route('contact#list')}}" method="get" class="d-flex">
                            @csrf
                            <input type="text" name="key" id="" placeholder="Enter customer name" class="form-control p-3" value="{{request('key')}}">
                            <button type='submit' class='btn btn-primary'>
                                <i class="fa-solid fa-magnifying-glass p-3"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-2 p-3">
                        <h4 class="text-secondary"> Total - {{ $messages->total() }} </h4>
                    </div>
                </div>
                @if (count($messages) != 0)
                    <div class="table-responsive table-responsive-data2 my-4 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Sent Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr class="tr-shadow">
                                        <td class=""> {{ $message->name }} </td>
                                        <td class=""> {{ $message->phone_number }} </td>
                                        <td class=""> {{ $message->email }} </td>
                                        <td class=""> {{ $message->message }} </td>
                                        <td class=""> {{ $message->created_at->format('d/m/Y   g:i A') }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text-secondary mt-5 text-center">There is no message.</h4>
                @endif
                <!-- END DATA TABLE -->

                {{$messages->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
