<form class="form-cover" method="POST" action="{{ route('register-post') }}">
    @csrf
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
    <a href="" class="text-decoration-none">Sign In</a>
    <button type="submit" class="w-100 button-login">Register</button>
</form>