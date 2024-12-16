<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Home</title>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav')

    <!-- Profile Section Starts Here -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Bagian Profil -->
            <div class="sm:flex sm:items-center px-6 py-4">
                <img alt="Profile picture of the user" class="sm:w-32 sm:h-32 w-24 h-24 rounded-full mx-auto sm:mx-0 sm:mr-4" 
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
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bagian Informasi Pribadi -->
            <div class="px-6 py-4">
                <h2 class="text-lg font-semibold">Personal Information</h2>
                <div class="mt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Depan</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="email" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No HP</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Alamat -->
            <div class="px-6 py-4">
                <h2 class="text-lg font-semibold">Address</h2>
                <div class="mt-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kota</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Edit Profil -->
<div id="edit-profile-section" class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg mt-8 px-6 py-8">
    <h2 class="text-xl font-semibold mb-4">Edit Profil</h2>
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('editprofil') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Informasi Pribadi -->
        <h3 class="text-lg font-semibold">Personal Information</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="first_name" class="block text-gray-700">Nama Depan</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="w-full px-4 py-2 border rounded">
                @error('first_name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="last_name" class="block text-gray-700">Nama Belakang</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="w-full px-4 py-2 border rounded">
                @error('last_name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 border rounded">
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="phone" class="block text-gray-700">No HP</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="w-full px-4 py-2 border rounded">
                @error('phone')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Alamat -->
        <h3 class="text-lg font-semibold">Address</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="street" class="block text-gray-700">Alamat</label>
                <input type="text" id="street" name="street" value="{{ old('street', $user->street) }}" class="w-full px-4 py-2 border rounded">
                @error('street')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="city" class="block text-gray-700">Kota</label>
                <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}" class="w-full px-4 py-2 border rounded">
                @error('city')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="state" class="block text-gray-700">Provinsi</label>
                <input type="text" id="state" name="state" value="{{ old('state', $user->state) }}" class="w-full px-4 py-2 border rounded">
                @error('state')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="zip_code" class="block text-gray-700">Kode Pos</label>
                <input type="text" id="zip_code" name="zip_code" value="{{ old('zip_code', $user->zip_code) }}" class="w-full px-4 py-2 border rounded">
                @error('zip_code')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Foto Profil -->
        <div class="mb-4">
            <label for="photo" class="block text-gray-700">Foto Profil</label>
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil" class="w-32 h-32 rounded-full mb-4">
            @endif
            <input type="file" id="photo" name="photo" class="w-full px-4 py-2 border rounded">
            @error('photo')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</div>

    </div>
    <!-- Profile Section Ends Here -->

    @include('pages.layout.footer')
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    AOS.init();
</script>

@include('pages.layout.script');

</html>
