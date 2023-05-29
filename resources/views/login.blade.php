<form class="form-cover" method="POST" action="{{ route('login-post') }}">
    @csrf
    <div class="form-group">
        <label class="font-weight-bold p-400 p-m-400">E-mail</label>
        <div>
            <input type="text" name="email" value="{{ old('email') }}"
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
    <a href="" class="sign-up text-decoration-none">Sign Up</a>
    <button type="submit" class="w-100 button-login">LOGIN</button>
</form>