@extends('tenant.layouts.app', ['title' => 'Settings'])

@section('workspace')
    <section class="breadcrumb">
        <h1>Manage Settings</h1>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form href="{{ route('settings.update') }}" method="POST" class="card card_row p-6 flex flex-col max-w-5xl">
            @csrf

            <h2 class="mb-6">Settings</h2>
            
            <div class="xl:p-4">
                <div>
                    <h3 class="mb-2 whitespace-nowrap">Actions</h3>

                    <test-notifications></test-notifications>
                </div>

                <div>
                    <h3 class="mb-2 whitespace-nowrap">Preferences</h3>

                    <div class="w-fit xl:p-4">
                        <h4 class="mb-4 whitespace-nowrap">Notifications</h4>
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
