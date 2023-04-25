@extends('central.layouts.main', ['title' => 'Register'])

@section('body')
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Create Your Account</h2>
                <h4 class="uppercase">Let's Roll</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" action="{{ route('create-user', $token) }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="label block mb-2" for="name">Name</label>
                    <input id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" required autofocus autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Password</label>
                    <label class="form-control-addon-within">
                        <input id="password" name="password" type="password" class="form-control border-none @error('password')is-invalid @enderror" required autocomplete="new-password">
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password-confirm">Confirm Password</label>
                    <label class="form-control-addon-within">
                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control border-none" required autocomplete="new-password">
                        <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                </div>
                <div class="flex items-center">
                    <button type="submit" class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
