@extends('Pages.Auth.master-login-register')
@section('title')
    Login
@endsection
@section('content')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Login -->
            <div class="card">
                <div class="card-body">
                    @if (Session::has('success'))
                        <p class="text-success text-center">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('message') || Session::has('status'))
                        <p class="text-danger text-center">{{ Session::get('message') ?? Session::get('status') }}</p>
                    @endif

                    <form id="formAuthentication" class="mb-3" action="{{ route('signin.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name_email" class="form-label">Email or Username</label>
                            <input
                                type="text"
                                class="form-control @error('name_email') is-invalid @enderror"
                                id="name_email"
                                name="name_email"
                                placeholder="Enter your email or username"
                                autofocus
                                value="{{ old('name_email') }}"
                            />
                            @error('name_email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    placeholder="············"
                                    aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" value="true" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ route('register') }}">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
</div>

@endsection
