@extends('central.layouts.main', ['title' => 'Login'])

@section('body')
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">It’s Great To See You!</h2>
                <h4 class="uppercase">Login Here</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" action="{{ route('auth.login-user') }}" method="POST">
                @csrf

                @if(session('error'))
                    <div class="alert alert_danger w-fit pr-12 mb-4">
                        <strong class="uppercase"><bdi>Error!</bdi></strong>
                        {!! session('error') !!}
                        <div class="dismiss la la-times" data-dismiss="alert"></div>
                    </div>
                @endif
                
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}" placeholder="johndoe@example.com" required autofocus autocomplete="email">
                    @error('email')
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Password</label>
                    <label class="form-control-addon-within @error('password')is-invalid @enderror">
                        <input id="password" name="password" type="password" class="form-control border-none" required autocomplete="current-password">
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                    @error('password')
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="flex items-center">
                    @if (Route::has('auth.forgot-password'))
                        <a href="{{ route('auth.forgot-password') }}" class="text-sm uppercase">Forgot Password?</a>
                    @endif

                    <button type="submit" class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
