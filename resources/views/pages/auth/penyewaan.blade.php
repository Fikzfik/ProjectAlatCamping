<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-jM8424hiu2OrzsAl"></script>
    <title>Detail</title>
    <style>
        .opacity-50 {
            opacity: 0.5;
        }

        .selected {
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        #dropdownList5,
        #dropdownList6,
        #dropdownList7 {
            max-height: 0;
            /* Default tertutup */
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        .subtotal {
            min-width: 150px;
            /* Ganti dengan lebar yang sesuai */
            overflow: hidden;
        }

        /* Overlay dan Modal */
        #overlay {
            z-index: 9999;
            /* Pastikan overlay selalu di atas */
        }

        #keranjangModal {
            z-index: 10000;
            max-height: 100vh;
            /* Maksimal tinggi modal 80% dari tinggi layar */
            overflow-y: auto;
        }

        /* Elemen Halaman Utama */
        body>*:not(#overlay):not(#keranjangModal) {
            z-index: auto;
            /* Pastikan elemen halaman utama tidak mengganggu */
        }

        .keranjang-item img {
            width: 80px;
            height: 120px;
            object-fit: cover;
            border-radius: 4px;
            /* Opsional: untuk membuat sudut gambar melengkung */
        }
    </style>
</head>

<body id="body" class="">
    @include('pages.layout.nav')
    <section class="sm:px-[4.271vw] px-[8.372vw] text-white pt-[3.1vw] relative">
        <div class="w-full flex sm:flex-row flex-col">
            <!-- Bagian Daftar Barang -->
            <div class="sm:w-[70vw] w-full px-4 sm:px-0">
                <div class="border border-gray-300 sm:px-6 px-4 sm:py-6 py-4 sm:w-[64.74vw] w-full space-y-6">
                    <!-- Looping Barang -->
                    @foreach ($keranjangs as $keranjang)
                        <div class="flex items-start border-b border-gray-300 pb-6 gap-6 hover:shadow-lg hover:scale-105 transform transition duration-300 selected"
                            data-id="{{ $keranjang->id_keranjang }}" data-selected="true" onclick="toggleSelection(this)">
                            <input type="hidden" name="keranjangs[]" value="{{ $keranjang->id_keranjang }}">
                            <!-- Gambar Barang -->
                            <div
                                class="w-[15vw] h-[15vw] sm:w-[10vw] sm:h-[10vw] overflow-hidden rounded-lg relative group shadow-md">
                                <img src="{{ asset('storage/' . $keranjang->link_foto) }}"
                                    alt="{{ $keranjang->nama_barang }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-300">
                            </div>

                            <!-- Deskripsi Barang -->
                            <div class="flex-1 space-y-2 group">
                                <h2
                                    class="text-lg font-semibold leading-tight text-white group-hover:text-blue-400 transition duration-200">
                                    {{ $keranjang->nama_barang }}
                                </h2>
                                <p
                                    class="text-sm text-gray-400 leading-relaxed group-hover:text-gray-200 transition duration-200">
                                    {{ $keranjang->deskripsi }}
                                </p>
                                <p class="text-md font-medium text-blue-400 mt-2">
                                    Rp{{ number_format($keranjang->harga_sewa, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Jumlah Barang dengan Tombol + dan - -->
                            <div class="text-center mt-[1.5vw] sm:mt-[1vw]">
                                <h3 class="font-medium text-gray-300 mb-1">Jumlah:</h3>
                                <div class="flex items-center space-x-2">
                                    <!-- Tombol - -->
                                    <button
                                        class="bg-gray-700 text-white px-2 py-1 rounded-lg hover:bg-gray-600 transition duration-200"
                                        onclick="updateQuantity('{{ $keranjang->id_keranjang }}', -1, event)">
                                        -
                                    </button>
                                    <!-- Jumlah Barang -->
                                    <span id="jumlah-barang-{{ $keranjang->id_keranjang }}"
                                        class="text-lg font-semibold text-white">
                                        {{ $keranjang->jumlah_barang }}
                                    </span>
                                    <!-- Tombol + -->
                                    <button
                                        class="bg-gray-700 text-white px-2 py-1 rounded-lg hover:bg-gray-600 transition duration-200"
                                        onclick="updateQuantity('{{ $keranjang->id_keranjang }}', 1, event)">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- Bagian Total Pembayaran -->
            <div class="w-full sm:w-[30vw] p-4 bg-gray-800 rounded-lg shadow-lg sticky top-[1.2vw]" data-aos="fade-left"
                data-aos-delay="400" data-aos-duration="500">
                <h2 class="text-lg font-semibold mb-4">Total Pembayaran</h2>

                <!-- Subtotal list -->
                <div id="subtotalList" class="mb-4 text-white space-y-2">
                    <!-- Subtotal tiap item akan ditampilkan di sini -->
                </div>

                <!-- Total Pembayaran -->
                <div class="text-2xl font-bold text-blue-400 mb-6" id="totalPembayaran">
                    Rp
                </div>
                <div class="mb-4">
                    <label for="tanggalSewa" class="block text-white font-medium">Tanggal Sewa</label>
                    <input type="date" id="tanggalSewa" name="tanggal_sewa"
                        class="w-full px-4 py-2 mt-2 bg-gray-700 text-white rounded-lg"
                        onchange="updateTotalPembayaran()">
                </div>
                <div class="mb-4">
                    <label for="tanggalKembali" class="block text-white font-medium">Tanggal Pengembalian</label>
                    <input type="date" id="tanggalKembali" name="tanggal_kembali"
                        class="w-full px-4 py-2 mt-2 bg-gray-700 text-white rounded-lg"
                        onchange="updateTotalPembayaran()">
                </div>
                <button id="submitPayment"
                    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white w-full py-2 rounded-lg hover:from-blue-600 hover:to-purple-700 transition duration-200">
                    Lakukan Pembayaran
                </button>

            </div>
        </div>
    </section>

    </div>
    <div id="popup" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden"
        onclick="togglePopup(false)">
        <div class="bg-black flex flex-col items-center p-6 rounded-lg shadow-lg sm:w-[20.833vw] w-[69.767vw]"
            onclick="event.stopPropagation()">
            <img src="src/assets/icons/gear-512.png" alt=""
                class="sm:w-[5.208vw] w-[23.256vw] animate-[spin_5s_linear_infinite]">
            <h2 class="text-white text-[4.651vw] text-center sm:text-[1.042vw] font-bold mb-4">This features is under
                developement now</h2>
            <p class="text-white sm:text-[0.729vw] text-[3.256vw] mb-4">Sorry for the inconvinient</p>
            <button onclick="togglePopup(false)"
                class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.208vw] py-[0.93vw] bg-red-500 text-white sm:text-[0.729vw] text-[3.256vw] rounded-md">Close</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateTotalPembayaran(); // Memanggil fungsi untuk update subtotal saat halaman dimuat
            updateItemSubtotal(); // Memanggil fungsi untuk update subtotal saat halaman dimuat

            // Event listener untuk perubahan tanggal
            document.getElementById('tanggalSewa').addEventListener('input', updateTotalPembayaran);
            document.getElementById('tanggalKembali').addEventListener('input', updateTotalPembayaran);
        });

        function updateTotalPembayaran() {
            const keranjangItems = document.querySelectorAll('.selected'); // hanya barang yang dipilih
            let total = 0;
            const subtotalList = document.getElementById('subtotalList');
            subtotalList.innerHTML = ''; // Kosongkan daftar subtotal sebelum di-update

            const tanggalSewa = document.getElementById('tanggalSewa').value;
            const tanggalKembali = document.getElementById('tanggalKembali').value;

            if (tanggalSewa && tanggalKembali) {
                const startDate = new Date(tanggalSewa);
                const endDate = new Date(tanggalKembali);
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Menghitung jumlah hari

                keranjangItems.forEach(item => {
                    const jumlahElement = item.querySelector('span[id^="jumlah-barang-"]');
                    const harga = parseInt(item.querySelector('.text-blue-400').textContent.replace('Rp', '')
                        .replace(/\./g, ''));
                    const jumlah = parseInt(jumlahElement.textContent);
                    const namaBarang = item.querySelector('h2').textContent; // Ambil nama barang

                    // Hitung subtotal per item berdasarkan jumlah hari
                    const subtotal = harga * jumlah * diffDays;
                    total += subtotal;

                    // Tambahkan subtotal item ke daftar subtotal dengan nama barang
                    const subtotalDiv = document.createElement('div');
                    subtotalDiv.classList.add('text-lg');
                    subtotalDiv.textContent =
                        `${namaBarang}: Rp${subtotal.toLocaleString('id-ID')} (${diffDays} hari)`; // Menambahkan nama barang
                    subtotalList.appendChild(subtotalDiv);
                });
            }

            // Update tampilan total pembayaran
            document.getElementById('totalPembayaran').textContent = `Rp${total.toLocaleString('id-ID')}`;
        }
        // Fungsi untuk menambah atau mengurangi jumlah barang
        function updateQuantity(idKeranjang, change, event) {
            event.stopPropagation(); // Agar tidak memicu toggleSelection
            const jumlahElement = document.getElementById(`jumlah-barang-${idKeranjang}`);
            let jumlah = parseInt(jumlahElement.textContent);

            jumlah = Math.max(0, jumlah + change); // Menjamin jumlah tidak negatif
            jumlahElement.textContent = jumlah;

            // Menghitung gross amount untuk item
            const item = document.querySelector(`[data-id="${idKeranjang}"]`);
            const harga = parseInt(item.querySelector('.text-blue-400').textContent.replace('Rp', '').replace(/\./g, ''));
            const subtotal = harga * jumlah; // Hitung gross amount

            // Kirim perubahan jumlah dan gross amount ke server
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const endpoint = change > 0 ? '/keranjang/increase' : '/keranjang/decrease';

            fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        id_keranjang: idKeranjang,
                        jumlah: jumlah,
                        subtotal: subtotal, // Mengirim gross amount
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update jumlah barang pada UI jika server berhasil memproses
                        jumlahElement.innerText = data.jumlah_barang;
                        updateTotalPembayaran(); // Update total pembayaran setelah pembaruan jumlah
                    } else {
                        alert(data.message || 'Terjadi kesalahan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            updateTotalPembayaran();
            event.preventDefault();
        }


        // Fungsi untuk memperbarui subtotal untuk satu item
        function updateItemSubtotal(idKeranjang, jumlah) {
            const item = document.querySelector(`[data-id="${idKeranjang}"]`);
            const harga = parseInt(item.querySelector('.text-blue-400').textContent.replace('Rp', '').replace(/\./g, ''));
            const namaBarang = item.querySelector('h2').textContent; // Ambil nama barang dari elemen h2
            let subtotalElement = item.querySelector('.subtotal'); // Elemen untuk subtotal

            if (!subtotalElement) {
                // Buat elemen subtotal baru jika belum ada
                subtotalElement = document.createElement('div');
                subtotalElement.classList.add('subtotal');
                item.appendChild(subtotalElement);
            }

            // Hitung subtotal
            const subtotal = harga * jumlah;

            // Update subtotal dengan nama barang dan harga
            subtotalElement.textContent =
                `${namaBarang}: Rp${subtotal.toLocaleString('id-ID')}`; // Menampilkan nama barang dan subtotal

            // Memperbarui total pembayaran setelah update subtotal
            updateTotalPembayaran();
        }


        // Fungsi untuk menghitung total pembayaran berdasarkan keranjang
        function hitungTotalPembayaran() {
            const keranjangItems = @json($keranjangs); // Data keranjang dari Laravel
            let total = 0;

            keranjangItems.forEach(item => {
                total += item.harga_sewa * item.jumlah_barang;
            });

            document.getElementById('totalPembayaran').textContent = `Rp${total.toLocaleString('id-ID')}`;
        }
        document.getElementById('submitPayment').addEventListener('click', () => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const selectedItems = document.querySelectorAll('.selected'); // Ambil barang yang dipilih
            const selectedData = [];
            let totalPembayaran = 0;

            const tanggalSewa = document.getElementById('tanggalSewa').value;
            const tanggalKembali = document.getElementById('tanggalKembali').value;

            // Validasi tanggal
            if (!tanggalSewa || !tanggalKembali) {
                Swal.fire({
                    title: 'Tanggal tidak lengkap',
                    text: 'Harap pilih tanggal sewa dan tanggal pengembalian.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Validasi barang yang dipilih
            if (selectedItems.length === 0) {
                Swal.fire({
                    title: 'Tidak ada barang dipilih',
                    text: 'Pilih minimal satu barang untuk melanjutkan pembayaran.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Hitung total pembayaran
            selectedItems.forEach(item => {
                const idKeranjang = item.dataset.id; // Menggunakan dataset
                const jumlahElement = item.querySelector('span[id^="jumlah-barang-"]');
                const jumlah = parseInt(jumlahElement.textContent);
                const harga = parseInt(item.querySelector('.text-blue-400').textContent.replace('Rp', '')
                    .replace(/\./g, ''));

                // Ambil nama barang dari elemen h2
                const namaBarang = item.querySelector('h2').textContent.trim();

                // Menghitung subtotal berdasarkan jumlah hari sewa
                const startDate = new Date(tanggalSewa);
                const endDate = new Date(tanggalKembali);
                const diffTime = Math.abs(endDate - startDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                const subtotal = harga * jumlah * diffDays;
                totalPembayaran += subtotal;

                selectedData.push({
                    id_keranjang: idKeranjang,
                    jumlah: jumlah,
                    harga_sewa: harga,
                    tanggal_sewa: tanggalSewa,
                    tanggal_kembali: tanggalKembali,
                    subtotal: subtotal,
                    nama_barang: namaBarang
                });
            });

            // Kirim data pembayaran ke server
            fetch('/pembayaran', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        total_pembayaran: totalPembayaran, // Total pembayaran
                        items: selectedData // Data barang yang dipilih
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Pembayaran berhasil diproses!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.snap.pay(data.data.token, {
                                onSuccess: function(result) {
                                    window.location.href =
                                        'http://127.0.0.1:8000/history';
                                },
                                onPending: function(result) {
                                    window.location.href =
                                        'https://abd9-103-47-133-70.ngrok-free.app/api/notfinish';
                                },
                                onError: function(result) {
                                    window.location.href =
                                        'https://abd9-103-47-133-70.ngrok-free.app/api/error';
                                },
                            });
                        });
                    } else {
                        Swal.fire({
                            title: 'Gagal',
                            text: data.message || 'Terjadi kesalahan.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat memproses pembayaran.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        });

        function toggleSelection(element) {
            const isSelected = element.getAttribute('data-selected') === 'true';
            element.setAttribute('data-selected', !isSelected);

            // Tambahkan/kurangi kelas untuk efek visual
            if (isSelected) {
                element.classList.add('opacity-50');
                element.classList.remove('selected');
            } else {
                element.classList.remove('opacity-50');
                element.classList.add('selected');
            }

            // Perbarui total pembayaran
            updateTotalPembayaran();
        }
        // Fungsi yang dijalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', hitungTotalPembayaran);


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
    <script>
        AOS.init();
    </script>
    <script src="path/to/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@next/dist/aos.js"></script>

    @include('pages.layout.script');
</body>

</html>
