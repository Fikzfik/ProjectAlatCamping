<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Profil Pengguna</title>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav')

    <!-- Profil Pengguna -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Bagian Profil -->
            <div class="sm:flex sm:items-center px-6 py-4">
                <!-- Foto Profil -->
                <img alt="Foto Profil Pengguna" class="sm:w-32 sm:h-32 w-24 h-24 rounded-full mx-auto sm:mx-0 sm:mr-4" 
                     height="150" 
                     src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://storage.googleapis.com/a1aa/image/cm1eGegfxqCpfSg5YXG5m2QGHm1vMjkJNHUqaC5egj40eer8JA.jpg' }}" 
                     width="150" />
                <div class="text-center sm:text-left sm:flex-grow">
                    <div class="mb-4">
                        <h1 class="text-xl leading-tight">{{ $user->name }}</h1>
                        <p class="text-sm leading-tight text-gray-600">{{ $user->email }}</p>
                    </div>
                    <div>
                        <a class="text-xs font-semibold rounded-full px-4 py-1 leading-normal bg-blue-500 text-white hover:bg-blue-600" href="#edit-profile-section">
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>


            <!-- Bagian Edit Profil -->
            <div id="edit-profile-section" class="px-6 py-4">
                <h2 class="text-xl font-semibold mb-4">Edit Profil</h2>
                @if(session('success'))
                    <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border rounded">
                        @error('name')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded">
                        @error('email')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-700">Foto Profil</label>
            
                        <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border rounded">
                        @error('photo')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
                </form>
            </div>
        </div>

    </div>

    @include('pages.layout.footer')
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    AOS.init();
</script>

@include('pages.layout.script');

</html>
