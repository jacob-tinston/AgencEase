@extends('tenant.layouts.app', ['title' => 'Invite User'])

@section('workspace')
    <section class="breadcrumb">
        <h1>User Invitation</h1>
        <ul>
            <a href="#">Settings</a>
            <li class="divider la la-arrow-right"></li>
            <a href="{{ route('users.index') }}">Users</a>
            <li class="divider la la-arrow-right"></li>
            <li>Invite User</li>
        </ul>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form action="{{ route('users.invite.store') }}" method="POST" class="card card_row p-6 flex flex-col max-w-4xl">
            @csrf

            <h2 class="mb-6">Invite a New User</h2>
            
            <div class="xl:p-4">
                <div class="w-full">
                    <div class="mb-5">
                        <label class="label block mb-2" for="email">To</label>
                        <input id="email" name="email" type="email" class="form-control @error('email')is-invalid @enderror">
                        @error('email')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-5">
                        <label class="label block mb-2" for="role">Role</label>
                        <div class="custom-select">
                            <select id="role" name="role" class="form-control @error('role')is-invalid @enderror">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                        @error('role')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mt-5">
                        <label class="label block mb-2" for="message">Custom Message</label>
<textarea id="message" name="message" class="form-control @error('message')is-invalid @enderror" rows="5" style="height: 200px;">Hi there!

We'd like to invite you to collaborate with us. Please click on the link below to create your account now. 

Looking forward to working together!

Kind Regards,
{{ tenant('organization') }}
</textarea>
                        @error('message')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex items-center justify-end pr-2 mb-5 gap-4">
                <a class="text-normal" href="{{ route('users.index') }}">Cancel</a>
                <button class="btn btn_primary uppercase">Send Invitation</button>
            </div>
        </form>
    </div>
@endsection
