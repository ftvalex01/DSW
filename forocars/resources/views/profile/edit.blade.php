<head>
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<form action="/profile/store" method="POST" id="updateImage" enctype="multipart/form-data" class="form-container">
    @csrf

    <div class="profile-image-container">
        <img src="{{ $user->profile_image_url ?? '/placeholder-image.jpg' }}" alt="Perfil del usuario">
    </div>

    <div class="file-upload-container">
        <label for="imageUpload" class="profile-image-upload">
            <i class="fas fa-camera"></i> Cambiar Imagen
        </label>
        <input type="file" name="imageUpload" id="imageUpload" class="profile-image-input form-control" accept="image/*">
    </div>

    @error('imageUpload')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


