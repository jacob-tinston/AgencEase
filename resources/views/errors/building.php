@extends('central.layouts.main', ['title' => 'Building Admin'])

@section('body')
    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10 text-center uppercase">
                <h1 class="text-9xl font-bold">Hang on!</h1>
                <h2 class="text-primary mt-5">We're currently setting up your app.</h2>
                <h5 class="mt-2">This shouldn't take long.</h5>
                <a href="javascript:window.location.reload()" class="btn btn_primary mt-5">Retry</a>
            </div>
        </div>
    </div>
@endsection
