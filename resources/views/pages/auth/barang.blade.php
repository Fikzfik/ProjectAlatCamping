<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')

    <title>Blog</title>
</head>

<body id="body" class="text-white relative">
    @include('pages.layout.nav')

    <section class="sm:px-[4.271vw] px-[8.372vw] relative pb-[1vw] mt-[5.625vw]">
        <h1 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw]">Tambah Barang</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
            onclick="document.getElementById('kategoriModal').classList.remove('hidden')">
            Tambah Kategori
        </button>
        <form id="form-tambah-barang" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-y-[2vw]">
                <!-- Nama Barang -->
                <div class="flex flex-col">
                    <label for="nama_barang" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Nama
                        Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" placeholder="Masukkan nama barang"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                </div>

                <!-- Kategori -->
                <div class="flex flex-col">
                    <label for="id_kategori"
                        class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Kategori</label>
                    <div class="flex items-center">
                        <select name="id_kategori" id="id_kategori"
                            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md w-full">
                            <option value="" selected disabled>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <button type="button"
                            class="ml-2 sm:px-[1vw] px-[4vw] sm:py-[0.625vw] py-[2vw] bg-blue-500 text-white rounded-md"
                            onclick="document.getElementById('kategoriModal').classList.remove('hidden')">+</button>
                    </div>
                </div>

                <!-- Foto Barang -->
                <div class="flex flex-col">
                    <label for="link_foto" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Upload
                        Foto</label>
                    <input type="file" name="link_foto" id="link_foto"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                </div>

                <!-- Harga Sewa -->
                <div class="flex flex-col">
                    <label for="harga_sewa" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Harga
                        Sewa</label>
                    <input type="number" name="harga_sewa" id="harga_sewa" placeholder="Masukkan harga sewa"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                </div>

                <!-- Status -->
                <div class="flex flex-col">
                    <label for="status" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Status</label>
                    <select name="status" id="status"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                        <option value="tersedia">Tersedia</option>
                        <option value="tidak tersedia">Tidak Tersedia</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="flex flex-col">
                    <label for="deskripsi" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi barang"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md"></textarea>
                </div>
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-[2vw]">
                <button type="submit"
                    class="sm:px-[1.5vw] px-[5vw] sm:py-[0.833vw] py-[2vw] bg-blue-500 text-white rounded-md">
                    Simpan Barang
                </button>
            </div>
        </form>


        <!-- Tabel Barang -->
        <h2 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw] mt-[4vw]">Daftar Barang</h2>
        <!-- Tabel dengan DataTables -->
        <div class="overflow-x-auto bg-black shadow-md rounded-lg">
            <table id="barangTable" class="w-full text-left text-sm bg-black text-white">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-sm font-medium uppercase">No</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Nama Barang</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Kategori</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Harga Sewa</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Status</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($barang as $key => $item)
                        <tr class="hover:bg-gray-800">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>
                            <td class="px-6 py-4">{{ $item->nama_barang }}</td>
                            <td class="px-6 py-4">{{ $item->nama_kategori }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full {{ $item->status == 'tersedia' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openUpdateModal({{ $item->id_barang }})"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all">
                                    Edit
                                </button>
                                <button onclick="deleteBarang({{ $item->id_barang }})"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition-all ml-2">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <div id="updateBarangModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div
            class="bg-white p-4 rounded-md w-[90vw] sm:w-[70vw] md:w-[50vw] lg:w-[40vw] flex flex-col sm:flex-row relative">
            <!-- Bagian Kiri (Form Inputan) -->
            <div class="w-full sm:w-[60%] px-4">
                <h2 class="text-lg font-semibold text-black mb-4">Update Barang</h2>

                <form id="form-update-barang">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="update-id-barang" name="id_barang">

                    <div class="grid grid-cols-1 gap-y-4">
                        <!-- Nama Barang -->
                        <div class="flex flex-col">
                            <label for="nama_barang_update" class="text-sm font-semibold text-black mb-1">Nama
                                Barang</label>
                            <input type="text" name="nama_barang" id="update-nama_barang"
                                placeholder="Masukkan nama barang"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full">
                        </div>

                        <!-- Kategori -->
                        <div class="flex flex-col">
                            <label for="id_kategori_update"
                                class="text-sm font-semibold text-black mb-1">Kategori</label>
                            <select name="id_kategori" id="update-id-kategori"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full">
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id_kategori }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Harga Sewa -->
                        <div class="flex flex-col">
                            <label for="harga_sewa_update" class="text-sm font-semibold text-black mb-1">Harga
                                Sewa</label>
                            <input type="number" name="harga_sewa" id="update-harga_sewa"
                                placeholder="Masukkan harga sewa"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full">
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col">
                            <label for="status_update" class="text-sm font-semibold text-black mb-1">Status</label>
                            <select name="status" id="update-status"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full">
                                <option value="tersedia">Tersedia</option>
                                <option value="tidak tersedia">Tidak Tersedia</option>
                            </select>
                        </div>

                        <!-- Deskripsi -->
                        <div class="flex flex-col">
                            <label for="deskripsi_update"
                                class="text-sm font-semibold text-black mb-1">Deskripsi</label>
                            <textarea name="deskripsi" id="update-deskripsi" placeholder="Masukkan deskripsi barang"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full"></textarea>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            Simpan Barang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bagian Kanan (Foto Barang) -->
            <div class="w-full sm:w-[40%] px-4 flex flex-col items-center justify-center mt-4 sm:mt-0">
                <h3 class="text-sm font-semibold text-black mb-3">Foto Barang</h3>
                <img id="update-foto-barang" src="" alt="Foto Barang"
                    class="max-w-full max-h-[150px] object-cover rounded-md">
            </div>

            <!-- Tombol Tutup Modal -->
            <button id="closeModal"
                class="absolute top-3 right-3 text-white bg-gray-600 hover:bg-gray-800 rounded-full p-2">
                X
            </button>
        </div>
    </div>
    <div id="kategoriModal"
        class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-[9999]">
        <div class="bg-dark w-full max-w-lg rounded-md shadow-lg p-6 relative">
            <!-- Tombol Tutup Modal -->
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800"
                onclick="document.getElementById('kategoriModal').classList.add('hidden')">
                &#x2715;
            </button>

            <h2 class="text-xl font-bold mb-4">Tambah Item</h2>

            <!-- Form Inputan -->
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_item" class="block text-gray-700 font-semibold mb-2">Nama Item</label>
                    <input type="text" name="nama_item" id="nama_item" placeholder="Masukkan nama item"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi item"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2"
                        onclick="document.getElementById('kategoriModal').classList.add('hidden')">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>

            <!-- Tabel Daftar Item -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Daftar Item</h3>
                <table id="itemTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Item</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data item akan diisi di sini -->
                        <tr>
                            <td>1</td>
                            <td>Elektronik</td>
                            <td>Item untuk barang elektronik</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Furniture</td>
                            <td>Item untuk barang furniture</td>
                        </tr>
                        <!-- Tambahkan data item lainnya di sini -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    @include('pages.layout.footer')
</body>
<div id="popup" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden"
    onclick="togglePopup(false)">
    <div class="bg-black flex flex-col items-center p-6 rounded-lg shadow-lg sm:w-[20.833vw] w-[69.767vw]"
        onclick="event.stopPropagation()">
        <img src="assets/icons/gear-512.png" alt=""
            class="sm:w-[5.208vw] w-[23.256vw] animate-[spin_5s_linear_infinite]">
        <h2 class="text-white text-[4.651vw] text-center sm:text-[1.042vw] font-bold mb-4">This features is under
            developement now</h2>
        <p class="text-white sm:text-[0.729vw] text-[3.256vw] mb-4">Sorry for the inconvinient</p>
        <button onclick="togglePopup(false)"
            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.208vw] py-[0.93vw] bg-red-500 text-white sm:text-[0.729vw] text-[3.256vw] rounded-md">Close</button>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#barangTable').DataTable({
            language: {
                paginate: {
                    next: 'Berikutnya',
                    previous: 'Sebelumnya'
                },
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari total _MAX_ data)"
            }
        });
    });
</script>
<script>
    $('#form-tambah-barang').submit(function(e) {
        e.preventDefault(); // Mencegah form untuk submit secara default

        let formData = new FormData(this); // Ambil data dari form, termasuk file gambar

        $.ajax({
            url: '{{ route('barang.store') }}', // URL yang sesuai dengan route 'barang.store'
            type: 'POST',
            data: formData,
            processData: false, // Jangan memproses data (karena ada file)
            contentType: false, // Jangan set content-type header
            success: function(response) {
                alert(response.message); // Menampilkan pesan sukses
                $('#form-tambah-barang')[0].reset(); // Reset form setelah sukses
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan: " + error); // Menampilkan error jika ada
            }
        });
    });

    $(document).ready(function() {
        $('#kategoriTable').DataTable();
    });

    function togglePopup(show) {
        const popup = document.getElementById('popup');
        const body = document.body;
        if (show) {
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            body.style.overflow = 'hidden'; // Disable scrolling
        } else {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            body.style.overflow = ''; // Enable scrolling
        }
    }
</script>
<script src="./js/main.js"></script>
<script>
    // Menutup modal ketika tombol X diklik
    $('#closeModal').click(function() {
        $('#updateBarangModal').addClass('hidden');
    });

    // Menutup modal juga jika klik di luar modal
    $(window).click(function(event) {
        if (event.target.id === 'updateBarangModal') {
            $('#updateBarangModal').addClass('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const body = document.getElementById('body');
        const nav = document.getElementById('nav');
        const openButton = document.getElementById('hamburger');
        const closeButton = document.getElementById('cross');

        // Tombol untuk Slide In
        openButton.addEventListener('click', () => {
            sidebar.classList.remove('slide-out-left-active');
            sidebar.classList.add('slide-in-left-active');
            body.classList.add('overflow-y-hidden');
            nav.classList.remove('pointer-events-none');
        });

        // Tombol untuk Slide Out
        closeButton.addEventListener('click', () => {
            sidebar.classList.remove('slide-in-left-active');
            sidebar.classList.add('slide-out-left-active');
            body.classList.remove('overflow-y-hidden');
            nav.classList.add('pointer-events-none');
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const profileButton = document.getElementById('profile-button');
        const submenu = document.getElementById('submenu');

        // Toggle submenu visibility on button click
        profileButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default behavior of button
            submenu.classList.toggle('hidden');
        });

        // Close submenu when clicking outside
        document.addEventListener('click', (event) => {
            if (!profileButton.contains(event.target) && !submenu.contains(event.target)) {
                submenu.classList.add('hidden');
            }
        });
    });
</script>
<script>
    AOS.init();
</script>
<script>
    // Fungsi untuk memuat data barang
    function loadBarang() {
        $.ajax({
            url: '{{ route('barang') }}',
            type: 'GET',
            success: function(data) {
                let rows = '';
                $.each(data, function(index, item) {
                    rows += `<tr>
                        <td>${index + 1}</td>
                        <td>${item.nama_barang}</td>
                        <td>${item.nama_kategori}</td>
                        <td>Rp ${number_format(item.harga_sewa, 0, ',', '.')}</td>
                        <td>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full ${item.status == 'tersedia' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'}">
                                ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                            </span>
                        </td>
                        <td class="text-center">
                            <button onclick="openUpdateModal(${item.id_barang})" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all">Edit</button>
                            <button onclick="deleteBarang(${item.id_barang})" class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition-all ml-2">Hapus</button>
                        </td>
                    </tr>`;
                });
                $('#barangTable tbody').html(rows);
            }
        });
    }

    // Fungsi untuk membuka modal dan mengisi form dengan data barang yang dipilih
    function openUpdateModal(id) {
        $.ajax({
            url: '/barang/' + id, // Pastikan URL ini benar
            type: 'get',
            success: function(response) {
                if (response.success) {
                    // Isi form dengan data barang
                    $('#update-id-barang').val(response.data.id_barang);
                    $('#update-nama_barang').val(response.data.nama_barang);
                    $('#update-id-kategori').val(response.data.id_kategori);
                    $('#update-harga_sewa').val(response.data.harga_sewa);
                    $('#update-status').val(response.data.status);
                    $('#update-deskripsi').val(response.data.deskripsi);

                    // Perbarui foto barang
                    if (response.link_foto) {
                        $('#update-foto-barang').attr('src', response
                            .link_foto); // Gunakan URL foto dari server
                    } else {
                        $('#update-foto-barang').attr('src',
                            '/storage/barang_foto/default.jpg'); // Foto default jika tidak ada foto
                    }

                    // Tampilkan modal
                    $('#updateBarangModal').removeClass('hidden');
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat memuat data barang!');
            }
        });
    }

    // Fungsi untuk menghapus barang
    function deleteBarang(id) {
        if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
            $.ajax({
                url: '/barang/' + id, // Pastikan URL ini benar
                type: 'DELETE',
                success: function(response) {
                    alert(response.message);
                    loadBarang(); // Reload data barang setelah dihapus
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat menghapus barang!');
                }
            });
        }
    }

    // Fungsi untuk menyimpan data barang yang diupdate
    $('#form-update-barang').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '/barang/' + $('#update-id-barang').val(), // Endpoint untuk update barang
            type: 'PUT',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                $('#updateBarangModal').addClass('hidden'); // Tutup modal setelah update berhasil
                loadBarang(); // Reload data barang setelah update
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat memperbarui barang!');
            }
        });
    });

    // Memuat data barang saat halaman siap
    $(document).ready(function() {
        loadBarang();
    });
</script>

</html>
