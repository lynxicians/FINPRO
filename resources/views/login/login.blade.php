@extends('layout.layout')

@section('content')
<style>
    .background{
        height: 100vh;
        background-image: url('{{ asset('images/login/loginbackground.jpg') }}');
        background-size: cover;
    }
</style>
<div class="background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <main class="form-login">
                    <form method="POST" action="{{ route('login-post') }}">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
                        <div class="form-group p-1">
                            <div class="form-group">
                                <label class="font-weight-bold p-400 p-m-400">E-mail</label>
                                <div>
                                    <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter your e-mail">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-1">       
                            <div class="form-group">
                                <label class="font-weight-bold p-400 p-m-400">Password</label>
                                <div>
                                    <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" id="login-password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="w-50 h-25 d-grid gap-2 mx-auto btn btn-lg btn-dark mt-3" type="submit">Login</button>
                        <small class="d-block text-center mt-2">Not registered? <a href="/register">Register</a></small>
                    </form>
                </main>
            </div>
        </div>
    </div>
</div>
@endsection