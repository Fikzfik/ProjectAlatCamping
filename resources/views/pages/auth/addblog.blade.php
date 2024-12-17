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
                    Simpan Blog
                </button>
            </div>
        </form>


        <!-- Tabel judul -->
<h2 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw] mt-[4vw]">Daftar Blog</h2>
<!-- Tabel dengan DataTables -->
<div class="overflow-x-auto bg-black shadow-md rounded-lg">
    <table id="blogTable" class="w-full text-left text-sm bg-black text-white">
        <thead class="bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-sm font-medium uppercase">No</th>
                <th class="px-6 py-3 text-sm font-medium uppercase">Judul</th>
                <th class="px-6 py-3 text-sm font-medium uppercase">Konten</th>
                <th class="px-6 py-3 text-sm font-medium uppercase">Foto</th>
                <th class="px-6 py-3 text-sm font-medium uppercase">Tanggal Upload</th>
                <th class="px-6 py-3 text-sm font-medium uppercase text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @foreach ($blogs as $key => $blog)
                <tr class="hover:bg-gray-800">
                    <td class="px-6 py-4">{{ $key + 1 }}</td>
                    <td class="px-6 py-4">{{ $blog->judul }}</td>
                    <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($blog->konten, 50) }}</td>
                    <td class="px-6 py-4">
                        @if ($blog->foto)
                            <img src="{{ asset('storage/' . $blog->foto) }}" alt="Foto Blog"
                                class="w-16 h-16 object-cover rounded-md">
                        @else
                            <span class="text-gray-400 italic">Tidak ada foto</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $blog->tanggal }}</td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('blogs.edit', $blog->id) }}"
                            class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-all">
                            Edit
                        </a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                            class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-md hover:bg-red-700 transition-all">
                                Hapus
                            </button>
                        </form>
                    </td>
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
                url: '{{ route('blog.store') }}', // URL yang sesuai dengan route 'judul.store'
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
            url: '{{ route('addblog') }}',
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
