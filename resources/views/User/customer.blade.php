<h1>This is user page.</h1>
<br>
<h4>Name: {{Auth::user()->name}} </h4>
<hr>
<h4>Email: {{Auth::user()->email}} </h4>
<hr>
<h4>Role: {{Auth::user()->role}} </h4>
<br>
<form action="{{route('logout')}}" method="post">
    @csrf
    <input type="submit" value="Log Out">
</form>
