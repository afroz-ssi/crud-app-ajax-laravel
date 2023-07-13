@extends('layouts.main')

@section('title', 'Signup')

@section('content')


    <div class="grid grid-cols-1 font-serif">
        <form action="" class="form flex justify-center mt-8" id="SignupForm">
            <div class="main-form-input">
                <h2 class="text-center"> <strong> Sign Up </strong></h2>
                <h5 id="msg" class="text-green-700 text-center mt-5"></h5>
                <div class="form-group">
                    <div class="text-left">Name</div>
                    <input type="text" id="name" name="name"
                        class="appearance-none px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                        placeholder="Enter your name" autocomplete="off" />
                    <p class="text-left text-red-400 error-text name_error" id="name_error"></p>
                </div>
                <div class="form-group">
                    <div class="text-left">Email</div>
                    <input type="email" id="email" name="email"
                        class="px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                        placeholder="Enter your email" autocomplete="off" />
                    <p class="text-left text-red-400 email_error" id="email_error"></p>
                </div>
                <div class="form-group">
                    <div class="text-left">Password</div>
                    <input type="password" name="password" id="password" v-model="signUpForm.password"
                        class="px-4 py-2 border border-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-100"
                        placeholder="Enter your password" />
                    <p class="text-left text-red-400 error-text password_error" id="password_error"></p>
                </div>
                <div class="form-group flex justify-between">
                    <button type="submit" @click.prevent="submitSignupForm"
                        class="rounded hover:rounded-xl bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4">
                        Sign In
                    </button>
                    <a href="{{ route('login') }}"> Already have an account?<strong class="underline"> Login
                            Here</strong></a>
                </div>
            </div>
        </form>
    </div>


    <script>
        $("#SignupForm").on("submit", function(e) {
            e.preventDefault();
            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();
            console.log(password, name, email);
            $("#password_error").html("");


            $.ajax({
                url: 'http://127.0.0.1:8000/api/user/register',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    password: password
                },
                success: function(response) {
                    // console.log(response);
                    $('#SignupForm')[0].reset();
                        sessionStorage.setItem("access_token", response.access_token);
                        $("#msg").html(response.message);
                        setTimeout(() => {
                            window.open("{{ route('login') }}", "_self");                        
                        }, 2000);                    
                },
                error: function(error) {
                    if (error.responseJSON.status == 404) {
                        $.each(error.responseJSON.errors, function(prefix, val) {
                            $('p.' + prefix + '_error').text(val[0]);
                        });
                    }

                }
            });

        });
    </script>
@endsection
