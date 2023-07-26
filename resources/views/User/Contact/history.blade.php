@extends('User.master')

@section('title', 'Message History')

@section('content')
    <div class="container">
        <h3 class="text-secondary text-center">Message History</h3>
        <div class="table-responsive table-responsive-data2 my-4 col-10 offset-1">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Message</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                        <tr class="tr-shadow">
                            <td class=""> {{ $message->created_at->format('d/m/Y   g:i A') }} </td>
                            <td class=""> {{ $message->message }} </td>
                            <td class="text-success"> <i class="fa-solid fa-paper-plane me-3"></i> Sent </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
