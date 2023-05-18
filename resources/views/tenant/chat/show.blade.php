@extends('tenant.layouts.app', ['title' => 'Chat', 'footer' => false, 'workspaceClasses' => 'pb-20'])

@section('workspace')
    <section class="flex items-center lg:justify-end mb-5">
        <div class="avatar w-16 h-16 ltr:mr-5 rtl:ml-5">
            <span>{{ initials($user->name) }}</span>
            <div class="status bg-success"></div>
        </div>
        <div>
            <h5>{{ $user->name }}</h5>
            <p>Last seen today 2:20PM</p>
        </div>
    </section>

    <hr class="dark:border-gray-800 mb-8">

    <chat :store-route="'{{ route('chat.store', ['id' => $user->id]) }}'"></chat>
@endsection

@include('tenant.chat._sidebar')
