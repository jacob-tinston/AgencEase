@extends('tenant.layouts.app', ['title' => 'Chat'])

@section('workspace')
    <section class="breadcrumb">
        <h1>Chat</h1>
        <ul>
            <p>Apps</p>
            <li class="divider la la-arrow-right"></li>
            <li>Chat Room</li>
        </ul>
    </section>
@endsection

@include('tenant.chat._sidebar')
