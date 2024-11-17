<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <img src="{{ $profilePhoto = auth()->user()->profile_photo ? asset('storage/' . auth()->user()->profile_photo) : asset('storage/profile_photos/default.jpg') }}" 
     alt="Profile Photo" 
     class="profile-photo">

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
    
            <!-- Profile Photo Upload -->
            <div class="form-group">
                <label for="profile_photo">Upload Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo" accept="image/*">
            </div>
    
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
        </div>
    </div>
</x-app-layout>
