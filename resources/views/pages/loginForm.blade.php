@extends('layouts.main')

@section('title', 'Login Account')
@section('content')
    <div class="grid grid-cols-1 font-serif mt-12">
        <form class="form flex justify-center mt-12" id="LoginForm">
            <div class="main-form-input">
                <h2 class="text-center"> <strong>Login With Your Account </strong></h2>
                <h5 id="msg" class="text-green-700 text-center mt-5"></h5>

                <div class="form-group">
                    <div class="text-left">Email</div>
                    <input type="email" id="email" name="email"
                        class="px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                        placeholder="Enter your email" autocomplete="off" />
                    <p class="text-left text-red-400 email_error" id="email_error"></p>
                </div>
                <div class="form-group">
                    <div class="text-left">Password</div>
                    <input type="password" id="password" name="password"
                        class="px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                        placeholder="Enter your password" />
                    <p class="text-left text-red-400 password_error" id="password_error"></p>
                </div>
                <div class="form-group flex justify-between">
                    <button type="submit"
                        class="rounded hover:rounded-xl bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">
                        Sign In
                    </button>
                    <a href="{{ route('register') }}">
                        Don't have an account?
                        <strong class="underline"> Sign up</strong>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        $("#LoginForm").on("submit", function(e) {
            e.preventDefault();
            let email = $("#email").val();
            let password = $("#password").val();
            $.ajax({
                url: 'http://127.0.0.1:8000/api/user/login',
                method: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    sessionStorage.setItem("access_token", response.access_token);
                    sessionStorage.setItem("LogedUserId", response.data.id);
                    sessionStorage.setItem("LogedUserName", response.data.name);
                    $("#msg").html(response.message);
                    $("#msg").css("color", "green");

                    setTimeout(() => {
                        window.open("{{ route('post_list') }}", "_self");                        
                    }, 1000);

                },
                error: function(err) {
                    if (err.responseJSON.status == 404) {
                        $("#msg").html("");
                        if (err.responseJSON.error) {
                            $("#msg").html(err.responseJSON.error + "!.");
                            $("#msg").css("color", "red");
                        }
                        $.each(err.responseJSON.errors, function(prefix, val) {
                            $('p.' + prefix + '_error').text(val[0]);
                        });
                    }
                }
            });

        });
    </script>
@endsection
