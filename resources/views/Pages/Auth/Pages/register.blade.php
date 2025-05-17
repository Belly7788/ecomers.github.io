@extends('Pages.Auth.master-login-register')
@section('title')
    Register
@endsection
@section('content')

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    @if (Session::has('success'))
                        <p class="text-success text-center">{{ Session::get('success') }}</p>
                    @endif
                    @if (Session::has('message'))
                        <p class="text-danger text-center">{{ Session::get('message') }}</p>
                    @endif

                    <form id="formAuthentication" class="mb-3" action="{{ route('signup.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="username"
                                name="name"
                                placeholder="Enter your username"
                                autofocus
                                value="{{ old('name') }}"
                            />
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                            />
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
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
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password_cm">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password_cm"
                                    class="form-control @error('password_cm') is-invalid @enderror"
                                    name="password_cm"
                                    placeholder="············"
                                    aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password_cm')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

@endsection
