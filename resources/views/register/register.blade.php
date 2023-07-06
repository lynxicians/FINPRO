@extends('layout.layout')

@section('content')
<style>
    .background{
        width: 100vw;
        height: 100vh;
        background-image: url('{{ asset('images/login/loginbackground.jpg') }}');
        background-size: cover;
    }
</style>
<div class="background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <main class="form-register">
                    <form class="form-cover" method="POST" action="{{ route('register-post') }}">
                        @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Registration</h1>
                    <div class="form-group">
                        <label class="font-weight-bold p-400 p-m-400">Name</label>
                        <div>
                            <input type="text" name="name"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your name">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
  
                    <div class="form-group">
                        <label class="font-weight-bold p-400 p-m-400">Student ID</label>
                        <div>
                            <input type="text" name="student_id"
                            class="form-control @error('student_id') is-invalid @enderror"
                            placeholder="Enter your student ID">
                            @error('student_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                
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
                    <button class="w-50 h-25 d-grid gap-2 mx-auto btn btn-lg btn-dark mt-3" type="submit">Register</button>
                    <small class="d-block text-center mt-2">Already registered? <a href="/login">Login</a></small>
                </form>
            </main>
        </div>
    </div>
  </div>
</div>




@endsection
