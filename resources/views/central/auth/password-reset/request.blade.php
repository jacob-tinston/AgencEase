@extends('central.layouts.main', ['title' => 'Forgot Password'])

@section('body')
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Forgot Password?</h2>
                <h4 class="uppercase">We'll Email You Soon</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" action="{{ route('password.email') }}" method="POST">
                @csrf
                
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input id="email" name="email" class="form-control" placeholder="johndoe@example.com">
                </div>
                <div class="flex">
                    <button class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Send Reset
                        Link</button>
                </div>
            </form>
        </div>
    </div>
@endsection
