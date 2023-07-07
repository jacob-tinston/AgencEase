@extends('central.layouts.main', ['title' => 'Forgot Password'])

@section('body')
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Reset Password</h2>
                <h4 class="uppercase">Enter your new password</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" action="{{ route('password.update', ['token' => $token, 'email' => app()->request->email]) }}" method="POST">
                @csrf
                
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
                <div class="flex">
                    <button class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
@endsection
