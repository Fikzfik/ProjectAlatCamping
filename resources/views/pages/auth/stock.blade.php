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

        /* Pastikan tombol Edit dan Delete hanya muncul ketika div diklik */
        .edit-delete-buttons {
            opacity: 0;
            pointer-events: none;
            /* Tidak dapat diklik */
            transition: opacity 0.3s ease, pointer-events 0s ease 0.3s;
        }

        .item-card.clicked .edit-delete-buttons {
            opacity: 1;
            pointer-events: auto;
            /* Bisa diklik */
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
                <div id="item-{{ $item->id_barang }}"
                    class="bg-white shadow-md rounded-lg overflow-hidden relative item-card"
                    onclick="toggleItem({{ $item->id_barang }})">
                    <img alt="{{ $item->nama_barang }}" class="w-full h-48 object-cover"
                        src="{{ asset('storage/' . $item->link_foto) }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2 text-gray-800 nama-barang">{{ $item->nama_barang }}</h2>
                        <p class="text-gray-600 mb-4 kategori">{{ $item->nama_kategori }}</p>
                        <p class="text-gray-600 mb-4 deskripsi">{{ $item->deskripsi }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-800 font-bold harga-sewa">Rp
                                {{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                            <button
                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-300"
                                onclick="openStockSettingModal({{ $item->id_barang }}, {{ $item->jumlah_stok }}); event.stopPropagation();">
                                Setting Stock
                            </button>

                        </div>
                    </div>

                    <!-- Tombol Edit dan Delete yang akan ditampilkan setelah klik item -->
                    <div
                        class="absolute inset-0 flex justify-center items-center bg-black bg-opacity-50 opacity-0 transition-all duration-300 edit-delete-buttons">
                        <button onclick="editItem({{ $item->id_barang }})"
                            class="bg-yellow-500 text-white px-4 py-2 rounded-lg mx-2 hover:bg-yellow-600">Edit
                            Barang</button>
                        <button onclick="deleteItem({{ $item->id_barang }})"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg mx-2 hover:bg-red-600">Delete
                            Barang</button>
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
        <!-- Modal Setting Stock -->
        <div id="stockSettingModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-md shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-center text-gray-800">Setting Stock</h2>
                <form id="stockSettingForm">
                    <input type="hidden" id="itemId" name="id_barang"> <!-- Hidden field for item ID -->

                    <!-- Current Stock -->
                    <div class="mb-4">
                        <label for="currentStock" class="block text-gray-700">Current Stock</label>
                        <input type="number" id="currentStock" name="current_stock"
                            class="w-full px-3 py-2 border rounded-lg bg-gray-100 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            readonly>
                    </div>

                    <!-- Stock Change -->
                    <div class="mb-4">
                        <label for="stockChange" class="block text-gray-700">Stock Change</label>
                        <div class="flex items-center justify-center space-x-4">
                            <!-- Tombol Kurangi (Decrease) -->
                            <button type="button" id="decreaseStock"
                                class="bg-red-500 text-white px-4 py-2 rounded-full shadow-md transform transition duration-300 ease-in-out hover:bg-red-600 hover:scale-105"
                                onclick="changeStock('decrease')">-</button>

                            <!-- Input untuk mengubah stok -->
                            <input type="number" id="stockChange" name="stock_change"
                                class="w-20 px-3 py-2 border rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="0" required>

                            <!-- Tombol Tambah (Increase) -->
                            <button type="button" id="increaseStock"
                                class="bg-green-500 text-white px-4 py-2 rounded-full shadow-md transform transition duration-300 ease-in-out hover:bg-green-600 hover:scale-105"
                                onclick="changeStock('increase')">+</button>
                        </div>
                    </div>

                    <!-- Pilihan untuk menentukan apakah stok akan ditambah atau dikurangi -->
                    <div class="mb-6">
                        <label class="block text-gray-700">Pilih Aksi</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="action" value="increase" checked
                                    class="w-5 h-5 text-blue-500 focus:ring-0">
                                <span class="text-gray-700 font-semibold">Masuk (Tambah Stok)</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="action" value="decrease"
                                    class="w-5 h-5 text-red-500 focus:ring-0">
                                <span class="text-gray-700 font-semibold">Keluar (Kurangi Stok)</span>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Cancel dan Save -->
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-400 text-white px-6 py-2 rounded-lg w-full md:w-auto"
                            onclick="closeStockSettingModal()">Cancel</button>
                        <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg w-full md:w-auto hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="itemModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div id="modalContent" class="bg-white p-6 rounded-lg w-full max-w-md relative">
                <h2 class="text-2xl font-semibold mb-4 text-center text-gray-800">Edit Barang</h2>

                <!-- Tombol Edit dan Delete -->
                <div class="flex justify-between mb-4">
                    <button
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300"
                        onclick="editItem()">Edit Barang</button>
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-300"
                        onclick="deleteItem()">Delete Barang</button>
                </div>

                <!-- Tombol Close Modal -->
                <div class="flex justify-center">
                    <button type="button" class="bg-gray-400 text-white px-6 py-2 rounded-lg w-full md:w-auto"
                        onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>


        <!-- Modal Edit -->
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-md">
                <h2 class="text-2xl font-semibold mb-4">Edit Barang</h2>
                <form id="updateForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="editItemId" name="id_barang">

                    <div class="mb-4">
                        <label for="editNamaBarang" class="block text-gray-700">Nama Barang</label>
                        <input type="text" id="editNamaBarang" name="nama_barang"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="editKategori" class="block text-gray-700">Kategori</label>
                        <input type="text" id="editKategori" name="id_kategori"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="editHargaSewa" class="block text-gray-700">Harga Sewa</label>
                        <input type="number" id="editHargaSewa" name="harga_sewa"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="editStatus" class="block text-gray-700">Status</label>
                        <select id="editStatus" name="status" class="w-full px-3 py-2 border rounded-lg">
                            <option value="tersedia">Tersedia</option>
                            <option value="tidak tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editDeskripsi" class="block text-gray-700">Deskripsi</label>
                        <textarea id="editDeskripsi" name="deskripsi" class="w-full px-3 py-2 border rounded-lg"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="editLinkFoto" class="block text-gray-700">Foto Barang</label>
                        <input type="file" id="editLinkFoto" name="link_foto"
                            class="w-full px-3 py-2 border rounded-lg">
                    </div>
                    <div class="flex justify-between">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2"
                            onclick="closeEditModal()">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>





    </main>
    @include('pages.layout.footer')
</body>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Menangani pengiriman form edit menggunakan AJAX
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            var formData = new FormData();
            formData.append('_method',
                'PUT'); // Menambahkan method PUT di formData jika menggunakan POST

            formData.append('id_barang', $('#editItemId').val());
            formData.append('nama_barang', $('#editNamaBarang').val());
            formData.append('id_kategori', $('#editKategori').val());
            formData.append('harga_sewa', $('#editHargaSewa').val());
            formData.append('status', $('#editStatus').val());
            formData.append('deskripsi', $('#editDeskripsi').val());

            // Menambahkan foto jika ada
            if ($('#editLinkFoto')[0].files.length > 0) {
                formData.append('link_foto', $('#editLinkFoto')[0].files[0]);
            }


            // Log untuk memeriksa data sebelum dikirim
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            $.ajax({
                url: '/barang/update/' + $('#editItemId').val(),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Update berhasil:', response);

                    // Menampilkan SweetAlert setelah berhasil update
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Barang berhasil diperbarui.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Anda bisa menambahkan aksi lain jika diperlukan, misalnya menutup modal atau memuat ulang halaman
                            location
                        .reload(); // Reload halaman untuk melihat perubahan
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });

    });


    // Function to handle item click event
    document.querySelectorAll('.item-card').forEach(item => {
        item.addEventListener('click', function(event) {
            // Jangan tambahkan opacity jika tombol Setting Stock yang diklik
            if (event.target.closest('button')) return;

            // Toggle opacity dan tombol edit/delete
            const buttons = this.querySelector('.edit-delete-buttons');
            if (this.classList.contains('opacity-50')) {
                // Jika sudah ada opacity, kembalikan ke keadaan semula
                this.classList.remove('opacity-50');
                buttons.classList.remove('opacity-100');
                buttons.classList.add('opacity-0');
            } else {
                // Jika belum ada opacity, tambahkan opacity dan tampilkan tombol
                this.classList.add('opacity-50');
                buttons.classList.remove('opacity-0');
                buttons.classList.add('opacity-100');
            }
        });
    });

    // Fungsi untuk mengatur div item yang diklik
    function toggleItem(itemId) {
        const itemDiv = document.getElementById('item-' + itemId);
        itemDiv.classList.toggle('clicked'); // Menambahkan atau menghapus kelas 'clicked' untuk menunjukkan tombol
    }

    // Fungsi untuk mengedit barang dan menampilkan modal
    function editItem(id) {
        // Ambil elemen dengan id barang yang dipilih
        const itemCard = document.getElementById('item-' + id);

        // Ambil data barang (misalnya nama, kategori, harga, dsb.)
        const namaBarang = itemCard.querySelector('.nama-barang').textContent;
        const kategori = itemCard.querySelector('.kategori').textContent;
        const hargaSewa = itemCard.querySelector('.harga-sewa').textContent;
        const deskripsi = itemCard.querySelector('.deskripsi').textContent;
        console.log(hargaSewa);
        // Isi form modal dengan data barang
        document.getElementById('editItemId').value = id;
        document.getElementById('editNamaBarang').value = namaBarang;
        document.getElementById('editKategori').value = kategori;
        document.getElementById('editHargaSewa').value = hargaSewa;
        document.getElementById('editDeskripsi').value = deskripsi;

        // Tampilkan modal edit
        document.getElementById('editModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal edit
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }


    // Fungsi untuk menghapus barang
    function deleteItem(id) {
        if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
            fetch(`/barang/destroy/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Menampilkan pesan sukses
                    document.getElementById('item-' + id).remove(); // Menghapus elemen dari DOM
                })
                .catch(error => {
                    alert('Terjadi kesalahan: ' + error.message);
                });
        }
    }


    // Function untuk menutup efek opacity ketika klik di luar item
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.item-card')) {
            // Menutup efek opacity pada semua item
            document.querySelectorAll('.item-card').forEach(item => {
                item.classList.remove('opacity-50');
                item.querySelector('.edit-delete-buttons').classList.remove('opacity-100');
                item.querySelector('.edit-delete-buttons').classList.add('opacity-0');
            });
        }
    });
</script>
<script>
    function changeStock(action) {
        const stockChangeInput = document.getElementById('stockChange');
        let currentStockChange = parseInt(stockChangeInput.value) || 0;

        if (action === 'increase') {
            // Jika menambah stok, tambahkan satu
            currentStockChange++;
            console.log("Stok ditambah: ", currentStockChange);
        } else if (action === 'decrease') {
            // Jika mengurangi stok, kurangi satu
            currentStockChange--;
            console.log("Stok dikurangi: ", currentStockChange);
        }

        // Pastikan stok tidak kurang dari 0
        if (currentStockChange < 0) {
            currentStockChange = 0;
        }

        // Update nilai input dengan stok yang baru
        stockChangeInput.value = currentStockChange;
    }

    function openStockSettingModal(itemId, currentStock) {
        // Set the item ID and current stock values in the modal
        document.getElementById('itemId').value = itemId;
        document.getElementById('currentStock').value = currentStock;

        // Show the modal
        document.getElementById('stockSettingModal').classList.remove('hidden');
    }

    function closeStockSettingModal() {
        // Close the modal
        document.getElementById('stockSettingModal').classList.add('hidden');
    }
    document.getElementById('stockSettingForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const itemId = document.getElementById('itemId').value;
        const currentStock = parseInt(document.getElementById('currentStock').value);
        const stockChange = parseInt(document.getElementById('stockChange').value);
        const action = document.querySelector('input[name="action"]:checked')
            .value; // Mengambil nilai aksi (increase/decrease)

        let newStock;

        // Cek aksi: 'increase' untuk menambah stok, 'decrease' untuk mengurangi stok
        if (action === 'increase') {
            newStock = currentStock + stockChange; // Menambah stok
        } else if (action === 'decrease') {
            newStock = currentStock - stockChange; // Mengurangi stok
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Aksi tidak valid',
                text: 'Pilih aksi yang sesuai (masuk/keluar).',
            });
            return;
        }

        // Pastikan stok tidak menjadi negatif
        if (newStock < 0) {
            Swal.fire({
                icon: 'error',
                title: 'Stok tidak dapat kurang dari 0',
                text: 'Jumlah stok tidak boleh kurang dari 0.',
            });
            return;
        }

        // Kirim data ke server menggunakan AJAX
        $.ajax({
            url: '/barang/' + itemId + '/update-stock', // URL sesuai dengan route yang sudah diatur
            method: 'PUT',
            data: {
                id_barang: itemId,
                new_stock: newStock,
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Stok berhasil diperbarui!',
                    text: 'Stok baru: ' + newStock,
                });
                closeStockSettingModal();
                loadItems(); // Memuat ulang data barang
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal memperbarui stok',
                    text: 'Terjadi kesalahan saat memperbarui stok.',
                });
            }
        });
    });


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

        const id = document.getElementById('categoryId').value; // Ambil ID Kategori
        const namaKategori = document.getElementById('nama_kategori').value; // Ambil Nama Kategori
        const deskripsi = document.getElementById('deskripsi').value; // Ambil Deskripsi
        console.log(deskripsi, id);

        const formData = new FormData();
        formData.append('_method', 'PUT'); // Tambahkan ini untuk memberi tahu Laravel bahwa request adalah PUT
        formData.append('id_kategori', id);
        formData.append('nama_kategori', namaKategori);
        formData.append('deskripsi', deskripsi);

        $.ajax({
            url: '/kategori/' + id,
            method: 'POST', // Gunakan POST, karena _method yang akan menangani PUT
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
                loadCategories();
                closeViewCategoryModal();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
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
