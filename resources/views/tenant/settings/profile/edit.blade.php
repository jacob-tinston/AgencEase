@extends('tenant.layouts.app', ['title' => 'My Profile'])

@section('workspace')
    @can('manage organization')
        <customizer :initial-customizer="{{ tenant('customizer') ?? '[]' }}" :update-route="'{{ route('organization.update-customizer') }}'"></customizer>
    @endcan

    <section class="breadcrumb">
        <h1>Manage Profile</h1>
        <ul>
            <a href="#">Settings</a>
            <li class="divider la la-arrow-right"></li>
            <li>Profile</li>
        </ul>
    </section>

    <div class="flex flex-col gap-y-8 items-center justify-center mt-5">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="card card_row p-6 flex flex-col max-w-5xl">
            @csrf

            <h2 class="mb-6">My Profile</h2>
            
            <div class="flex flex-col lg:flex-row gap-8 xl:p-4">
                <div class="lg:w-fit lg:mr-6">
                    <h4 class="mb-4 whitespace-nowrap">Your Avatar</h4>

                    <div class="flex flex-col items-center justify-center">
                        <span class="avatar w-20 h-20 text-4xl">
                            @if($avatar = auth()->user()->avatar)
                                <img src="{{ asset(auth()->user()->avatar) }}" alt="">
                            @else
                                <span>{{ initials(auth()->user()->name) }}</span>
                            @endif

                            <img data-avatar-img class="hidden">
                        </span>

                        <div class="mt-4">
                            <label for="profile-avatar" class="btn btn_outlined btn_secondary uppercase">
                                <span>Add Image</span>

                                <input type="file" name="avatar" id="profile-avatar" accept="image/*" hidden>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="mb-5">
                        <label class="label block mb-2" for="name">Name</label>
                        <input id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ auth()->user()->name }}" autofocus autocomplete="name">
                        @error('name')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-5">
                        <label class="label block mb-2" for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control @error('email')is-invalid @enderror" value="{{ auth()->user()->email }}" autocomplete="email">
                        @error('email')
                            <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <hr class="my-6">

            <div class="flex justify-end pr-2 mb-5">
                <button class="btn btn_primary uppercase">Save Changes</button>
            </div>
        </form>

        @can('manage organization')
            <form action="{{ route('organization.update') }}" method="POST" enctype="multipart/form-data" class="card card_row p-6 flex flex-col max-w-5xl">
                @csrf

                <h2 class="mb-6">Organization Profile</h2>
                
                <div class="flex flex-col lg:flex-row gap-8 xl:p-4">
                    <div class="lg:w-fit lg:mr-6">
                        <h4 class="mb-4 whitespace-nowrap">Organization Avatar</h4>

                        <div class="flex flex-col items-center justify-center">
                            <span class="avatar w-20 h-20 text-4xl">
                                @if($avatar = tenant('avatar'))
                                    <img src="{{ asset($avatar) }}" alt="">
                                @else
                                    <span>{{ initials(tenant('organization')) }}</span>
                                @endif

                                <img data-avatar-img class="hidden">
                            </span>
    
                            <div class="mt-4">
                                <label for="organization-avatar" class="btn btn_outlined btn_secondary uppercase">
                                    <span>Add Image</span>
    
                                    <input type="file" name="avatar" id="organization-avatar" accept="image/*" hidden>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="mb-5">
                            <label class="label block mb-2" for="organization">Company Name</label>
                            <input id="organization" name="organization" class="form-control @error('organization')is-invalid @enderror" value="{{ tenant('organization') }}" autocomplete="organization">
                            @error('organization')
                                <small class="block mt-2 invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-6">

                <div class="flex justify-between items-center pr-2 mb-5">
                    <a href="#customizer" onclick="document.getElementById('toggle-customizer').click();" class="h-fit">Whitelabel Organization</a>
                    <button class="btn btn_primary uppercase">Save Changes</button>
                </div>
            </form>
        @endcan
    </div>
@endsection
