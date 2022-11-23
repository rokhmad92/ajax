@extends('partview.main')

@section('content')    
    <form method="post">
        @csrf
        <label for="email">email</label>
        <input type="text" name="email" id="email">
<br>
        <label for="password">password</label>
        <input type="text" name="password" id="password">
<br>
        <a href="/register">Register</a>
<br>
        <button type="submit">Login!</button>
    </form>
@endsection