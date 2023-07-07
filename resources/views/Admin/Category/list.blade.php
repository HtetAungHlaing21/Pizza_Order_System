<h1>This is admin page.</h1>
<h4>Role: {{Auth::user()->role}} </h4>
<form action="{{route('logout')}}" method="post">
    @csrf
    <input type="submit" value="Log Out">
</form>
