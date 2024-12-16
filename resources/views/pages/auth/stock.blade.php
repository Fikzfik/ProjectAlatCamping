<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Kartu Stok Barang</title>
    <style>
        #categoryModals {
            transition: width 0.3s ease-in-out;
            width: 30%;
            /* Awalnya kecil */
            display: flex;
            flex-direction: row;
        }

        #categoryModals.open {
            width: 60%;
            /* Melebar saat edit aktif */
        }

        #categoryList {
            flex: 1;
            overflow-y: auto;
        }

        #editCategoryForm {
            flex: 0;
            /* Awalnya form edit tersembunyi */
            display: none;
        }

        #editCategoryForm.open {
            display: block;
            flex: 2;
            /* Melebar saat form edit muncul */
        }

        #categoryModals .absolute {
            font-size: 1.5rem;
            font-weight: bold;
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
        }
    </style>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav')
    <main class="container mx-auto px-4 py-8">

        <!-- Button untuk membuka modal -->
        <button class="bg-blue-500 text-white px-4 py-2 rounded mb-6" onclick="openModal()">Add New Item</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded mb-6" onclick="openCategoryModal()">Add New
            Category</button>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded mb-6" onclick="openViewCategoryModal()">View
            Categorie</button>
        <!-- Grid Item -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($barang as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img alt="{{ $item->nama_barang }}" class="w-full h-48 object-cover"
                        src="{{ asset('storage/' . $item->link_foto) }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $item->nama_barang }}</h2>
                        <p class="text-gray-600 mb-4">Stok: {{ $item->jumlah_stok ?? 0 }}</p>
                        <p class="text-gray-600 mb-4">{{ $item->deskripsi }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-bold">Rp
                                {{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                            <button
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-300">
                                Setting Stock</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Modal Tambah Kategori -->
        <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-2xl font-semibold mb-4">Add New Category</h2>
                <form id="categoryForm">
                    <div class="mb-4">
                        <label for="categoryName" class="block text-gray-700">Category Name</label>
                        <input type="text" id="categoryName" name="nama_kategori"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="categoryDescription" class="block text-gray-700">Description</label>
                        <textarea id="categoryDescription" name="deskripsi"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                            onclick="closeCategoryModal()">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>



        <!-- Modal Tambah Barang -->
        <div id="stockModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-2xl font-semibold mb-4">Add New Item</h2>
                <form id="stockForm">
                    <div class="mb-4">
                        <label for="itemName" class="block text-gray-700">Item Name</label>
                        <input type="text" id="itemName" name="nama_barang"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="itemDescription" class="block text-gray-700">Description</label>
                        <textarea id="itemDescription" name="deskripsi"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="itemPrice" class="block text-gray-700">Price</label>
                        <input type="number" id="itemPrice" name="harga_sewa"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="itemImage" class="block text-gray-700">Image URL</label>
                        <input id="itemImage" type="file" name="link_foto"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="itemCategory" class="block text-gray-700">Category</label>
                        <select id="itemCategory" name="id_kategori"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id_kategori }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="status" value="tersedia" class="mr-2"> Tersedia
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="status" value="tidak tersedia" class="mr-2"> Tidak
                                Tersedia
                            </label>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                            onclick="closeModal()">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal View Categories -->
        <div id="viewCategoryModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div id="categoryModals"
                class="bg-white p-6 rounded-lg w-[30%] max-h-[90vh] overflow-y-auto transition-all duration-300 ease-in-out flex">
                <button class="absolute top-2 right-2 text-gray-500 hover:text-red-500"
                    onclick="closeViewCategoryModal()">
                    &times;
                </button>
                <!-- Daftar Kategori -->
                <div id="categoryList" class="space-y-4">
                    <h3 class="text-xl font-semibold mb-4">Daftar Kategori</h3>
                    <!-- Kategori akan di-load melalui AJAX -->
                </div>

                <!-- Form Edit Kategori -->
                <div id="editCategoryForm" class="hidden pl-6">
                    <h3 class="text-xl font-semibold mb-4">Edit Category</h3>
                    <form id="editCategoryFormContent">
                        <input type="hidden" id="categoryId" name="id_kategori">
                        <div class="mb-4">
                            <label for="nama_kategori" class="block text-gray-700">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori"
                                class="mt-2 p-2 border border-gray-300 rounded w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-gray-700">Deskripsi</label>
                            <input type="text" id="deskripsi" name="deskripsi"
                                class="mt-2 p-2 border border-gray-300 rounded w-full" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update
                            Category</button>
                    </form>
                </div>
            </div>
        </div>



    </main>
    @include('pages.layout.footer')
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Open modal
    function openModal() {
        document.getElementById('stockModal').classList.remove('hidden');
    }

    // Close modal
    function closeModal() {
        document.getElementById('stockModal').classList.add('hidden');
    }

    // Handle form submission with AJAX
    document.getElementById('stockForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: '{{ route('barang.store') }}', // Ganti dengan URL endpoint di controller Anda
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.message,
                });
                location.reload();
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan: " + error,
                });
            }
        });
    });
    AOS.init();
</script>
<script>
    // Fungsi untuk menghapus kategori
    function deleteCategory(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Kategori ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/kategori/' + id, // URL endpoint untuk delete kategori
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                        });
                        loadCategories(); // Refresh kategori setelah penghapusan
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: "Terjadi kesalahan saat menghapus kategori.",
                        });
                    }
                });
            }
        });
    }

    function openViewCategoryModal() {
        document.getElementById('viewCategoryModal').classList.remove('hidden');
        loadCategories(); // Panggil fungsi untuk load kategori
    }
    // Tutup modal saat klik di luar modal
    document.getElementById('viewCategoryModal').addEventListener('click', function(event) {
        const modalContent = document.getElementById('categoryModals');

        // Jika klik di luar konten modal, tutup modal
        if (!modalContent.contains(event.target)) {
            closeViewCategoryModal();
        }
    });

    // Close modal melihat 

    function loadCategories() {
        $.ajax({
            url: '{{ route('kategori.index') }}', // Ganti dengan URL endpoint untuk mengambil daftar kategori
            method: 'GET',
            success: function(response) {
                let categoryListHTML = '';
                response.categories.forEach(function(category) {
                    categoryListHTML += `
                    <div class="flex justify-between items-center border-b py-2">
                        <div class="flex-1">
                            <p class="text-gray-800 font-semibold">${category.nama_kategori}</p>
                            <p class="text-gray-600">${category.deskripsi}</p>
                        </div>
                        <div class="space-x-2">
                           <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="openEditCategoryModal(${category.id_kategori}, '${category.nama_kategori}', '${category.deskripsi}')">Edit</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="deleteCategory(${category.id_kategori})">Delete</button>
                        </div>
                    </div>
                `;
                });

                // Menampilkan daftar kategori dalam modal
                document.getElementById('categoryList').innerHTML = categoryListHTML;
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat memuat kategori.",
                });
            }
        });
    }

    function openEditCategoryModal(id, nama, deskripsi) {
        // Mengisi form dengan data kategori yang akan diedit
        document.getElementById('categoryId').value = id;
        document.getElementById('nama_kategori').value = nama;
        document.getElementById('deskripsi').value = deskripsi;

        // Menampilkan form edit kategori
        const editForm = document.getElementById('editCategoryForm');
        editForm.classList.add('open');

        // Melebar modal
        const modal = document.getElementById('categoryModals');
        modal.classList.add('open');
    }

    function closeViewCategoryModal() {
        // Sembunyikan modal
        document.getElementById('viewCategoryModal').classList.add('hidden');

        // Reset modal ukuran dan form edit
        const modal = document.getElementById('categoryModals');
        modal.classList.remove('open');

        const editForm = document.getElementById('editCategoryForm');
        editForm.classList.remove('open');
    }


    document.getElementById('editCategoryFormContent').addEventListener('submit', function(event) {
        event.preventDefault();
        console.log(this); // Debug: Pastikan ini merujuk ke form
        const formData = new FormData(this);
        console.log(...formData.entries()); // Debug: Tampilkan isi FormData
        const id = document.getElementById('categoryId').value;
        console.log(formData);
        $.ajax({
            url: '/kategori/' + id, 
            method: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.message,
                });
                loadCategories(); // Refresh kategori setelah update
                closeViewCategoryModal(); // Menutup modal
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat memperbarui kategori.",
                });
            }
        });
    });
    // Open modal kategori
    function openCategoryModal() {
        document.getElementById('categoryModal').classList.remove('hidden');
    }

    // Close modal kategori
    function closeCategoryModal() {
        document.getElementById('categoryModal').classList.add('hidden');
    }

    // Handle form submission untuk kategori
    document.getElementById('categoryForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        $.ajax({
            url: '{{ route('kategori.store') }}', // Ganti dengan URL endpoint kategori.store
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.message,
                });
                closeCategoryModal(); // Menutup modal setelah berhasil
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan: " + error,
                });
            }
        });
    });
</script>

@include('pages.layout.script')

</html>
