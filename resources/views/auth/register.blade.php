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
}
</style>

@endsection
@section("content")
<main class="form-signin w-100 m-auto">
            <form method="POST" action="{{ route("register.post") }}">
                @csrf
                <img
                    class="mb-4"
                    src="{{ asset("assets\img\logo-todoapp.jpeg") }}"
                    alt=""
                    width="72"
                    height="57"
                />

                <h1 class="h3 mb-3 fw-normal">Create Your Account</h1>

                <div class="form-floating">
                    <input name="fullname"
                        type="text"
                        class="form-control"
                        id="floatingInput"
                        placeholder="Enter Name"
                    />
                    <label for="floatingInput">Full Name</label>
                    @error("fullname")
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-floating">
                    <input name="email"
                        type="email"
                        class="form-control"
                        id="floatingInput"
                        placeholder="name@example.com"
                    />
                    <label for="floatingInput">Email address</label>
                    @error("email")
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                
                <div class="form-floating" style="margin-bottom: 10px">
                    <input name="password"
                        type="password"
                        class="form-control"
                        id="floatingPassword"
                        placeholder="Password"
                    />
                    <label for="floatingPassword">Password</label>
                    @error("password")
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
               @if(session()->has("success"))
               <div class="alert alert-success">
                
                {{ session()->get("success") }}

               </div>
               @endif
               @if(session("error"))
               <div class="alert alert-danger">
                
                {{ session("error") }}

               </div>
               @endif
                <button class="btn btn-primary w-100 py-2" type="submit">
                    Register
                </button>
                <p class="mt-5 mb-3 text-body-secondary">&copy; 2025</p>
            </form>
        </main>
@endsection