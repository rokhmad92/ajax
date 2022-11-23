@extends('partview.main')

@section('content')    
    <form method="post" id="register_from">
        @csrf
        <label for="email">email</label>
        <input type="email" name="email" id="email">
        <div class="fail-message"></div>
<br>
        <label for="username">username</label>
        <input type="text" name="username" id="username">
        <div class="fail-message"></div>
<br>
        <label for="password">password</label>
        <input type="password" name="password" id="password">
        <div class="fail-message"></div>
<br>
        <label for="cpassword">confirm password</label>
        <input type="password" name="cpassword" id="cpassword">
        <div class="fail-message"></div>
<br>
        <a href="/">Login</a>
<br>
        <input type="submit" value="Register" class="btn btn-primary" id="register_btn">
    </form>
@endsection

@section('script')
<script src="{{ asset('js') }}/register.js"></script>
<script>
        $(document).ready(function() {
                $("#register_from").submit(function(e){
                        e.preventDefault();
                        $("#register_btn").val("Please Wait...");
                        $.ajax({
                                url: '/register',
                                method: 'POST',
                                data: $(this).serialize(),
                                dataType: 'json',
                                success: function(response) {
                                        console.log(response);
                                }
                        })
                });
        });
</script>
@endsection