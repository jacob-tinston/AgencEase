@extends('central.layouts.main', ['title' => 'Register'])

@section('body')
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Create Your Account</h2>
                <h4 class="uppercase">Let's Roll</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" action="{{ route('auth.register-user') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="label block mb-2" for="name">Name</label>
                    <input id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name">
                    @error('name')
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control @error('email')is-invalid @enderror" value="{{ old('email') }}" placeholder="johndoe@example.com" required autocomplete="email">
                    @error('email')
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="organization">Company Name</label>
                    <input id="organization" name="organization" class="form-control @error('organization')is-invalid @enderror" value="{{ old('organization') }}" placeholder="John Doe Ltd" required autocomplete="organization">
                    @error('organization')
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="domain">Domain</label>

                    <div class="input-group @error('domain')is-invalid @enderror">
                        <input id="domain" name="domain" maxlength="63" class="form-control input-group-item" value="{{ old('domain') }}" placeholder="john-doe" required autocomplete="domain"
                            oninput="this.value = this.value.toLowerCase().trim().replace(/\s+/g, '-');">
                        <div class="input-addon input-addon-append input-group-item">.{{ config('tenancy.main_domain') }}</div>
                    </div>
                    @error('domain')
                        <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Password</label>
                    <label class="form-control-addon-within @error('password')is-invalid @enderror">
                        <input id="password" name="password" type="password" class="form-control border-none" required autocomplete="new-password">
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
                <div class="mb-5">
                    <label class="label block mb-2" for="password-confirm">Confirm Password</label>
                    <label class="form-control-addon-within @error('password')is-invalid @enderror">
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control border-none" required autocomplete="new-password">
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                </div>
                <div class="flex items-center">
                    @if (Route::has('auth.login'))
                        <a href="{{ route('auth.login') }}" class="text-sm uppercase">Already have an account?</a>
                    @endif

                    <button type="submit" class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
