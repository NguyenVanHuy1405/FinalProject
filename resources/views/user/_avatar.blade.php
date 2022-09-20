<div class="card mb-4">
    <div class="card-header">Avatar profile</div>
    <div class="card-body">
        <div class="text-center">
            <!-- Profile picture image-->
            @if($user->provider_id == null)
            <img class="img-account-profile rounded-circle img-thumbnail mb-2"
                src="{{ auth()->user()->avatar == null? asset('/home/image/avatar.png'): asset('/storage/image/' . Auth::user()->avatar) }}" alt="profile_image"
                style="width: 250px; height: 250px; object-fit: cover;"><br>
            <!-- Profile picture upload button-->
            @include('user.uploading')
            @else($user->provider_id == !null)
            <img class="img-account-profile rounded-circle img-thumbnail mb-2"
                src="{{ auth()->user()->avatar == null? asset('/home/image/avatar.png'): asset(Auth::user()->avatar) }}" alt="profile_image"
                style="width: 250px; height: 250px; object-fit: cover;"><br>
            <!-- Profile picture upload button-->
            @include('user.uploading')

            @endif

        </div>
    </div>
</div>
