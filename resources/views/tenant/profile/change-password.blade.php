@extends('tenant.layouts.app', ['title' => 'Change Password - My Profile'])

@section('workspace')
    <section class="breadcrumb">
        <h1>Password Settings</h1>
        <ul>
            <a href="#">Settings</a>
            <li class="divider la la-arrow-right"></li>
            <li>Change Password</li>
        </ul>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form action="{{ route('update-password') }}" method="POST" class="card card_row p-6 flex flex-col max-w-4xl">
            @csrf

            <h2 class="mb-6">Change Your Password</h2>
            
            <div class="xl:p-4">
                <div class="w-full">
                    <div class="mb-5">
                        <label class="label block mb-2" for="current-password">Current Password</label>
                        <label class="form-control-addon-within">
                            <input id="current-password" name="current_password" type="password" class="form-control border-none @error('password')is-invalid @enderror" required autocomplete="password">
                            <span class="flex items-center ltr:pr-4 rtl:pl-4">
                                <button type="button"
                                    class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                    data-toggle="password-visibility"></button>
                            </span>
                        </label>
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label class="label block mb-2" for="password">New Password</label>
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
                        <label class="label block mb-2" for="password-confirm">Confirm New Password</label>
                        <label class="form-control-addon-within">
                            <input id="password-confirm" name="password_confirmation" type="password" class="form-control border-none" required autocomplete="new-password">
                            <span class="flex items-center ltr:pr-4 rtl:pl-4">
                                <button type="button"
                                    class="text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                    data-toggle="password-visibility"></button>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex justify-end pr-2 mb-5">
                <button class="btn btn_primary uppercase">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
