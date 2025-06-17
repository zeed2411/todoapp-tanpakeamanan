{{-- views\auth\login.blade.php --}}
@extends("layouts.auth")
@section("style")
<style>
    html,
body {
  height: 100%;
}

.form-signin {
  max-width: 330px;
  padding: 1rem;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  padding-right: 2.5rem;
  position: relative;
}

.form-signin input[type="text"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.password-wrapper {
  position: relative;
}

.toggle-password {
  position: absolute;
  top: 50%;
  right: 0.75rem;
  transform: translateY(-50%);
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0;
  font-size: 1.1rem;
  color: #666;
  user-select: none;
}

.toggle-password:focus {
  outline: none;
}
</style>

@endsection
@section("content")
<main class="form-signin w-100 m-auto">
    <form method="POST" action="{{ route("login.post") }}">
        @csrf
        <img
            class="mb-4"
            src="{{ asset("assets\img\logo-todoapp.jpeg") }}"
            alt=""
            width="72"
            height="57"
        />
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating">
            {{-- Ubah type menjadi text untuk memungkinkan XSS payload --}}
            <input name="email"
                type="text"
                class="form-control"
                id="floatingInput"
                placeholder="Enter email or XSS payload"
            />
            <label for="floatingInput">Email address</label>
            @error("email")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating password-wrapper" style="margin-bottom: 10px">
            <input name="password"
                type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Password"
            />
            <label for="floatingPassword">Password</label>
            <button type="button" class="toggle-password" aria-label="Toggle password visibility" tabindex="-1">
                👁️
            </button>
            @error("password")
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-check text-start my-3">
            <input
                class="form-check-input"
                type="checkbox"
                value="remember-me"
                id="checkDefault"
            />
            <label class="form-check-label" for="checkDefault">
                Remember me
            </label>
        </div>
        @if(session()->has("success"))
        <div class="alert alert-success">
            {{-- XSS vulnerability - menggunakan {!! !!} tanpa sanitasi --}}
            {!! session()->get("success") !!}
        </div>
        @endif
        @if(session("error"))
        <div class="alert alert-danger">
            {{-- XSS vulnerability - output langsung tanpa escape --}}
            {!! session("error") !!}
        </div>
        @endif
        <button class="btn btn-primary w-100 py-2" type="submit">
            Sign in
        </button>
        <a href="{{ route("register") }}" class="text-center">Create new account</a>

        <p class="mt-5 mb-3 text-body-secondary">&copy; 2025</p>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordBtn = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('floatingPassword');
        togglePasswordBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    });

</script>
@endsection
