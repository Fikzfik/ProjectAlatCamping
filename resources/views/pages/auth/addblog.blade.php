<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')

    <title>Blog</title>
</head>

<body id="body" class="text-white relative">
    @include('pages.layout.nav')

    <section class="sm:px-[4.271vw] px-[8.372vw] relative pb-[1vw] mt-[5.625vw]">
        <h1 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw]">Tambah Blog</h1>
        <form id="form-tambah-judul" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-y-[2vw]">
                <!-- Nama judul -->
                <div class="flex flex-col">
                    <label for="nama_judul" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Judul
                    </label>
                    <input type="text" name="nama_judul" id="nama_judul" placeholder="Masukkan nama judul"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                </div>



                <!-- konten -->
                <div class="flex flex-col">
                    <label for="konten" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Konten</label>
                    <textarea name="konten" id="konten" placeholder="Masukkan konten judul"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md"></textarea>
                </div>
            </div>

                            <!-- Foto judul -->
                            <div class="flex flex-col">
                                <label for="link_foto" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Upload
                                    Foto</label>
                                <input type="file" name="link_foto" id="link_foto"
                                    class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                            </div>
            
                <!-- Tombol Pilih Tanggal -->
                <div class="flex flex-col mt-[2vw]">
                    <label for="tanggal" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Pilih Tanggal</label>
                    <input type="datetime-local" name="tanggal" id="tanggal"
                        class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end mt-[2vw]">
                <button type="submit"
                    class="sm:px-[1.5vw] px-[5vw] sm:py-[0.833vw] py-[2vw] bg-blue-500 text-white rounded-md">
                    Simpan judul
                </button>
            </div>
        </form>


        <!-- Tabel judul -->
        <h2 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw] mt-[4vw]">Daftar judul</h2>
        <!-- Tabel dengan DataTables -->
        <div class="overflow-x-auto bg-black shadow-md rounded-lg">
            <table id="judulTable" class="w-full text-left text-sm bg-black text-white">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-sm font-medium uppercase">No</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">judul</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Konten</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Foto</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase">Tanggal Upload</th>
                        <th class="px-6 py-3 text-sm font-medium uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($judul as $key => $item)
                        <tr class="hover:bg-gray-800">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>
                            <td class="px-6 py-4">{{ $item->nama_judul }}</td>
                            <td class="px-6 py-4">{{ $item->nama_kategori }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 text-xs font-semibold rounded-full {{ $item->status == 'tersedia' ? 'bg-green-600 text-white' : 'bg-red-600 text-white' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openUpdateModal({{ $item->id_judul }})"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all">
                                    Edit
                                </button>
                                <button onclick="deletejudul({{ $item->id_judul }})"
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
    <div id="updatejudulModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div
            class="bg-white p-4 rounded-md w-[90vw] sm:w-[70vw] md:w-[50vw] lg:w-[40vw] flex flex-col sm:flex-row relative">
            <!-- Bagian Kiri (Form Inputan) -->
            <div class="w-full sm:w-[60%] px-4">
                <h2 class="text-lg font-semibold text-black mb-4">Update judul</h2>

                <form id="form-update-judul" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="update-id-judul" name="id_judul">

                    <div class="grid grid-cols-1 gap-y-4">
                        <!-- Nama judul -->
                        <div class="flex flex-col">
                            <label for="nama_judul_update" class="text-sm font-semibold text-black mb-1">Nama
                                judul</label>
                            <input type="text" name="nama_judul" id="update-nama_judul"
                                placeholder="Masukkan nama judul"
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

                        <!-- konten -->
                        <div class="flex flex-col">
                            <label for="konten_update"
                                class="text-sm font-semibold text-black mb-1">konten</label>
                            <textarea name="konten" id="update-konten" placeholder="Masukkan konten judul"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full"></textarea>
                        </div>

                        <!-- Foto judul -->
                        <div class="flex flex-col">
                            <label for="foto_judul_update" class="text-sm font-semibold text-black mb-1">Ganti Foto
                                judul</label>
                            <input type="file" name="link_foto" id="update-foto_judul"
                                class="px-3 py-2 bg-gray-100 text-black rounded-md w-full" accept="image/*">
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="px-5 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                            Simpan judul
                        </button>
                    </div>
                </form>
            </div>

            <!-- Bagian Kanan (Foto judul) -->
            <div class="w-full sm:w-[40%] px-4 flex flex-col items-center justify-center mt-4 sm:mt-0">
                <h3 class="text-sm font-semibold text-black mb-3">Foto judul</h3>
                <img id="update-foto-judul" src="" alt="Foto judul"
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
        <div class="bg-dark w-auto max-w-lg rounded-md shadow-lg p-6 relative">
            <!-- Tombol Tutup Modal -->
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800"
                onclick="document.getElementById('kategoriModal').classList.add('hidden')">
                &#x2715;
            </button>

            <h2 class="text-xl font-bold mb-4">Tambah Item</h2>

            <!-- Form Inputan -->
            <form id="kategoriForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_item" class="block text-gray-700 font-semibold mb-2">Nama Item</label>
                    <input type="text" name="nama_kategori" id="nama_item" placeholder="Masukkan nama item"
                        class="w-full px-4 py-2 border rounded-md text-black focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="konten" class="block text-gray-700 font-semibold mb-2">konten</label>
                    <textarea name="konten" id="konten" placeholder="Masukkan konten item"
                        class="w-full px-4 py-2 border rounded-md text-black focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
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
            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Daftar Item</h3>
                <table id="itemTable" class="display w-full text-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Item</th>
                            <th>konten</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $key => $category)
                            <tr>
                                <td>{{ $key + 1 }}</td> <!-- Nomor urut -->
                                <td>{{ $category->nama_kategori }}</td> <!-- Nama kategori -->
                                <td>{{ $category->konten }}</td> <!-- konten kategori -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>



    @include('pages.layout.footer')
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
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Event submit pada form
        $("#kategoriForm").submit(function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this); // Ambil data form

            $.ajax({
                url: "/kategori/store", // Ganti dengan endpoint Laravel Anda
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // Token CSRF
                },
                data: formData,
                processData: false, // Jangan proses data form secara otomatis
                contentType: false, // Jangan set content-type secara otomatis
                success: function(response) {
                    console.log(response);
                    // Notifikasi jika berhasil
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: response.message,
                    });

                    // Reset form dan tutup modal
                    $("#kategoriForm")[0].reset();
                    $("#kategoriModal").addClass("hidden");

                    // Tambahkan data baru ke tabel
                    let newRow = `
                    <tr>
                        <td>#</td>
                        <td>${response.nama_kategori}</td>
                        <td>${response.konten}</td>
                    </tr>
                `;
                    $("#itemTable tbody").append(newRow);
                },
                error: function(xhr) {
                    // Notifikasi jika gagal
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: xhr.responseJSON.message ||
                            "Terjadi kesalahan saat menyimpan data.",
                    });
                },
            });
        });
    });


    $(document).ready(function() {

        $("#form-tambah-judul").submit(function(e) {
            e.preventDefault(); // Mencegah form untuk submit secara default

            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('judul.store') }}', // URL yang sesuai dengan route 'judul.store'
                type: 'POST',
                data: formData,
                processData: false, // Jangan memproses data (karena ada file)
                contentType: false, // Jangan set content-type header
                success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: response.message,
                    });
                    $('#form-tambah-judul')[0].reset(); // Reset form setelah sukses
                    loadjudul(); // Reload data judul
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
        $('#judulTable').DataTable({
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
        $('#updatejudulModal').addClass('hidden');
    });

    // Menutup modal juga jika klik di luar modal
    $(window).click(function(event) {
        if (event.target.id === 'updatejudulModal') {
            $('#updatejudulModal').addClass('hidden');
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
    // Fungsi untuk memuat data judul
    function loadjudul() {
        $.ajax({
            url: '{{ route('judul') }}',
            type: 'GET',
            success: function(data) {
                let rows = '';
                $.each(data, function(index, item) {
                    rows += `<tr>
                            <td>${index + 1}</td>
                            <td>${item.nama_judul}</td>
                            <td>${item.nama_kategori}</td>
                            <td>Rp ${number_format(item.harga_sewa, 0, ',', '.')}</td>
                            <td>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full ${item.status == 'tersedia' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'}">
                                    ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                                </span>
                            </td>
                            <td class="text-center">
                                <button onclick="openUpdateModal(${item.id_judul})" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all">Edit</button>
                                <button onclick="deletejudul(${item.id_judul})" class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition-all ml-2">Hapus</button>
                            </td>
                        </tr>`;
                });
                $('#judulTable tbody').html(rows);
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal Memuat Data!",
                    text: "Terjadi kesalahan saat memuat data judul.",
                });
            }
        });
    }

    // Fungsi untuk membuka modal dan mengisi form dengan data judul yang dipilih
    function openUpdateModal(id) {
        $.ajax({
            url: '/judul/' + id,
            type: 'get',
            success: function(response) {
                if (response.success) {
                    $('#update-id-judul').val(response.data.id_judul);
                    $('#update-nama_judul').val(response.data.nama_judul);
                    $('#update-id-kategori').val(response.data.id_kategori);
                    $('#update-harga_sewa').val(response.data.harga_sewa);
                    $('#update-status').val(response.data.status);
                    $('#update-konten').val(response.data.konten);

                    if (response.link_foto) {
                        $('#update-foto-judul').attr('src', response.link_foto);
                    } else {
                        $('#update-foto-judul').attr('src', '/storage/judul_foto/default.jpg');
                    }

                    $('#updatejudulModal').removeClass('hidden');
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat memuat data judul.",
                });
            }
        });
    }

    function openUpdateModal(id) {
        $.ajax({
            url: '/judul/' + id,
            type: 'get',
            success: function(response) {
                if (response.success) {
                    $('#update-id-judul').val(response.data.id_judul);
                    $('#update-nama_judul').val(response.data.nama_judul);
                    $('#update-id-kategori').val(response.data.id_kategori);
                    $('#update-harga_sewa').val(response.data.harga_sewa);
                    $('#update-status').val(response.data.status);
                    $('#update-konten').val(response.data.konten);

                    if (response.link_foto) {
                        $('#update-foto-judul').attr('src', response.link_foto);
                    } else {
                        $('#update-foto-judul').attr('src', '/storage/judul_foto/default.jpg');
                    }

                    $('#updatejudulModal').removeClass('hidden');
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat memuat data judul.",
                });
            }
        });
    }

    function openUpdateModal(id) {
        $.ajax({
            url: '/judul/' + id,
            type: 'get',
            success: function(response) {
                if (response.success) {
                    $('#update-id-judul').val(response.data.id_judul);
                    $('#update-nama_judul').val(response.data.nama_judul);
                    $('#update-id-kategori').val(response.data.id_kategori);
                    $('#update-harga_sewa').val(response.data.harga_sewa);
                    $('#update-status').val(response.data.status);
                    $('#update-konten').val(response.data.konten);

                    if (response.link_foto) {
                        $('#update-foto-judul').attr('src', response.link_foto);
                    } else {
                        $('#update-foto-judul').attr('src', '/storage/judul_foto/default.jpg');
                    }

                    $('#updatejudulModal').removeClass('hidden');
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan saat memuat data judul.",
                });
            }
        });
    }

    // Fungsi untuk menghapus judul
    function deletejudul(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus judul ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/judul/destroy/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil!",
                            text: response.message,
                        });
                        loadjudul(); // Reload data judul setelah berhasil dihapus
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat menghapus judul.",
                        });
                    }
                });
            }
        });
    }
    $('#form-update-judul').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        // Tambahkan _method untuk spoofing PUT
        formData.append('_method', 'PUT');

        $.ajax({
            url: '/judul/update/' + $('#update-id-judul').val(), // Endpoint update judul
            type: 'POST', // Menggunakan POST karena metode spoofing
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: response.message,
                });
                $('#updatejudulModal').addClass('hidden'); // Tutup modal
                loadjudul(); // Reload data judul
            },
            error: function(xhr) {
                // Tangkap pesan error dari server
                let errorMessage = xhr.responseJSON ? xhr.responseJSON.error :
                    'Terjadi kesalahan tak terduga.';
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: errorMessage,
                });
            }
        });
    });

    $(document).ready(function() {
        loadjudul();
    });
</script>

</html>
