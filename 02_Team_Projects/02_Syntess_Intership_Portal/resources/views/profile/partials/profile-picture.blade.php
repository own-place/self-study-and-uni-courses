<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $user->photo == null ? __('Add Profile Picture') : __('Change Profile Picture') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('* Click SELECT to choose a picture from your device, then click CROP AND UPLOAD to update your profile picture. Note: Only .jpeg, .jpg, and .png images are accepted.') }}
        </p>
    </header>

    <form id="profile-picture-form" action="{{ route('manage.photo', $user) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input class="rounded-md mb-3" type="file" id="profile-picture-input" name="profile-picture" accept="image/*">
        <img id="image" style="display: none; max-width: 100%; margin-top: 10px;" class="mt-3 mb-3">
        <div>
            <x-primary-button id="cropButton" class="mt-7">Crop and Upload</x-primary-button>
        </div>
        @if (session('status') === 'photo_changed')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-emerald-500 dark:text-gray-400 mt-7"
            >{{ __('Profile picture updated') }}</p>
        @elseif(session('status') === 'profile-picture-not-uploaded')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-red-700 dark:text-gray-400 mt-7"
            >{{ __('No profile uploaded') }}</p>
        @endif
        <p id="error-message" class="text-sm text-red-700 dark:text-gray-400 mt-7" style="display: none;"></p>
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet"/>

<script>
    let cropper;
    document.getElementById('profile-picture-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            const image = document.getElementById('image');
            image.src = url;
            image.style.display = 'block';

            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                scalable: true,
                zoomable: true,
                movable: true,
            });
        }
    });

    document.getElementById('cropButton').addEventListener('click', function(event) {
        event.preventDefault();
        const canvas = cropper.getCroppedCanvas();
        canvas.toBlob((blob) => {
            const formData = new FormData();
            formData.append('profile-picture', blob, 'profile-picture.jpg');

            fetch('{{ route("manage.photo", $user) }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        document.getElementById('error-message').textContent = 'Image upload failed';
                        document.getElementById('error-message').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error(error);
                    document.getElementById('error-message').textContent = 'An error occurred during image upload';
                    document.getElementById('error-message').style.display = 'block';
                });
        });
    });
</script>
