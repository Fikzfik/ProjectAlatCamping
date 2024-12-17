<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')

    <title>Feedback</title>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav')

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Beri Feedback</h1>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
            @dd();
        <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Dropdown Barang -->
            <div>
                <label for="id_barang" class="block text-sm font-medium text-gray-700">Pilih Barang</label>
                <select name="id_barang" id="id_barang" class="w-full border rounded p-2">
                    <option value="">Pilih Barang</option>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id_barang }}">
                            {{ $barang->barang->nama_barang }}
                        </option>
                    @endforeach
                </select>
                @error('id_barang')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Rating -->
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" min="1" max="5"
                    class="w-full border rounded p-2" placeholder="Masukkan Rating" />
                @error('rating')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Komentar -->
            <div>
                <label for="komentar" class="block text-sm font-medium text-gray-700">Komentar</label>
                <textarea name="komentar" id="komentar" rows="4"
                    class="w-full border rounded p-2" placeholder="Tulis komentar Anda"></textarea>
                @error('komentar')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Kirim Feedback
                </button>
            </div>
        </form>
    </div>

    @include('pages.layout.footer')
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@include('pages.layout.script')

>>>>>>> baa2f508018711bd2cff07fefdf88b2aec9e44f6
</html>
