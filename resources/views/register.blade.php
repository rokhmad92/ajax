@extends('partview.main')

@section('content')
<div id="alert-success"></div>
    <form method="post" id="register_from">
        @csrf
        <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="invalid-feedback"></div>
        </div>
        
        <label for="username">username</label>
        <input type="text" name="username" class="form-control" id="username">
        <div class="invalid-feedback"></div>
<br>
        <label for="password">password</label>
        <input type="password" name="password" class="form-control" id="password">
        <div class="invalid-feedback"></div>
<br>
        <label for="cpassword">confirm password</label>
        <input type="password" name="cpassword" class="form-control" id="cpassword">
        <div class="invalid-feedback"></div>
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
                                        if (response.status == 400) {
                                                showError('email', response.messages.email);
                                                showError('username', response.messages.username);
                                                showError('password', response.messages.password);
                                                showError('cpassword', response.messages.cpassword);
                                                $("#register_btn").val("Register Ulang");
                                        } else if (response.status == 200) {
                                                $("#alert-success").html(showMessage(response.messages));
                                                resetValidasiClass("#register_from")
                                                $("#register_btn").val("Berhasil Register");
                                                setTimeout(() => {
                                                        window.location.href = "/";
                                                }, 5000);
                                        } else {
                                                alert("Error Request");
                                        }
                                }
                        })
                });
        });
</script>
@endsection