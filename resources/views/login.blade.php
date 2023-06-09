@extends('partview.main')

@section('content')
    <div id="message"></div>
    <form method="post" id="login_form">
        @csrf
        <label for="email" class="form-label">email</label>
        <input type="text" class="form-control" name="email" id="email">
        <div class="invalid-feedback"></div>
<br>
        <label for="password" class="form-label">password</label>
        <input type="password" class="form-control" name="password" id="password">
        <div class="invalid-feedback"></div>
<br>
        <a href="/register">Register</a>
<br>
        <input type="submit" class="btn btn-primary" id="login_btn" value="Login"></input>
    </form>

    <br><br>

    @include('table')
@endsection

@push('script')
<script src="{{ asset('js') }}/login.js"></script>
<script>
        $(document).ready( function() {
                $("#login_form").submit(function(e){
                        e.preventDefault();
                        $("#login_btn").val("Please Wait...");
                        $.ajax({
                                url: '/',
                                method: 'POST',
                                data: $(this).serialize(),
                                dataType: 'json',
                                success: function(response) {
                                        // console.log(response);
                                        if(response.status == 400) {
                                                showError('email', response.messages.email);
                                                showError('password', response.messages.password);
                                                $("#login_btn").val('Login ulang!');
                                        } else if (response.status == 200) {
                                                resetValidasiClass('#login_form');
                                                $("#login_btn").val('Login Berhasil!');
                                                $('#message').html(showMessageSuccess(response.messages));
                                                setTimeout(() => {
                                                        alert('login berhasil!');
                                                }, 5000);
                                        } else if(response.status == 401) {
                                                $('#message').html(showMessageError(response.messages));
                                                $("#login_btn").val('Login ulang!');
                                        } else {
                                                alert('Request Error!');
                                        }
                                }
                        });
                });
        });
</script>
@endpush