<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Daftar Penyewaan Selesai</title>
    <style>
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav')

    <div class="container mx-auto mt-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Penyewaan Selesai</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($groupedPenyewaan as $id_penyewaan => $penyewaanGroup)
                <div class="bg-white shadow-md rounded-lg p-4" id="penyewaan-{{ $id_penyewaan }}">
                    <h2 class="text-lg font-bold mb-2">ID Penyewaan: {{ $id_penyewaan }}</h2>
                    <p class="text-sm mb-1"><strong>Tanggal Sewa:</strong> {{ $penyewaanGroup[0]->tanggal_sewa }}</p>
                    <p class="text-sm mb-3"><strong>Tanggal Kembali:</strong> {{ $penyewaanGroup[0]->tanggal_kembali }}
                    </p>
                    <button onclick="toggleDetail('{{ $id_penyewaan }}')"
                        class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Lihat Detail
                    </button>
                    <div id="detail-{{ $id_penyewaan }}" class="hidden mt-4 penyewaan-detail">
                        <h3 class="font-semibold text-lg mb-2">Detail Penyewaan</h3>
                        <div class="grid grid-cols-1 gap-4">
                            <form id="returnForm-{{ $id_penyewaan }}">
                                @foreach ($penyewaanGroup as $penyewaan)
                                    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                        <p><strong>Nama Barang:</strong> {{ $penyewaan->nama_barang }}</p>
                                        <p><strong>Jumlah Barang:</strong> {{ $penyewaan->sisa_barang }}</p>
                                        <p><strong>Harga Sewa:</strong> {{ $penyewaan->harga_sewa }}</p>
                                        <p><strong>Subtotal:</strong> {{ $penyewaan->subtotal }}</p>
                                        <input type="checkbox" name="return_item"
                                            value="{{ $penyewaan->id_detail_penyewaan }}"
                                            data-nama-barang="{{ $penyewaan->nama_barang }}"
                                            data-jumlah-barang="{{ $penyewaan->sisa_barang }}"
                                            class="return-checkbox mt-2">
                                        <label class="ml-2">Pilih untuk Dikembalikan</label>
                                    </div>
                                @endforeach
                                <button type="button" onclick="openReturnModal('{{ $id_penyewaan }}')"
                                    class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded mt-2">
                                    Return Terpilih
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="detailModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="modal-content">
            <h2 class="text-xl font-bold mb-4">Detail Pengembalian</h2>
            <form id="returnForm">
                <div id="return-items-container" class="mb-4">
                    <!-- Kondisi barang dan jumlah pengembalian akan diisi secara dinamis -->
                </div>
                <input type="hidden" id="id_penyewaan" name="id_penyewaan">
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="submitReturn()"
                        class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan Pengembalian
                    </button>
                    <button type="button" onclick="closeReturnModal()"
                        class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded ml-2">
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('pages.layout.footer')

    <!-- Script Modal -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function toggleDetail(idPenyewaan) {
            const detailSection = document.getElementById('detail-' + idPenyewaan);
            if (detailSection) {
                detailSection.classList.toggle('hidden');
                const button = event.target;
                button.textContent = detailSection.classList.contains('hidden') ? 'Lihat Detail' : 'Sembunyikan Detail';
            }
        }

        function openReturnModal(idPenyewaan) {
            const returnItemsContainer = document.getElementById('return-items-container');
            const checkboxes = document.querySelectorAll('input[name="return_item"]:checked');

            returnItemsContainer.innerHTML = ''; // Bersihkan kontainer

            if (checkboxes.length === 0) {
                alert("Harap pilih barang yang ingin dikembalikan.");
                return;
            }

            // Menambahkan input kondisi barang dan jumlah untuk setiap barang yang dipilih
            checkboxes.forEach((checkbox) => {
                const idDetailPenyewaan = checkbox.value; // Dapatkan id_detail_penyewaan dari checkbox
                const namaBarang = checkbox.getAttribute('data-nama-barang'); // Ambil nama barang
                const jumlahBarang = checkbox.getAttribute('data-jumlah-barang'); // Ambil jumlah barang

                const inputKondisiBarang = document.createElement('div');
                inputKondisiBarang.classList.add('mb-4');
                // Pastikan idDetailPenyewaan dan namaBarang ada
                if (idDetailPenyewaan && namaBarang) {
                    inputKondisiBarang.innerHTML = `
        <label for="kondisi_barang_${idDetailPenyewaan}" class="block text-sm font-medium text-gray-700">Kondisi ${namaBarang}</label>
        <input type="text" id="kondisi_barang_${idDetailPenyewaan}"
        name="kondisi_barang[${idDetailPenyewaan}]" required>

        <label for="jumlah_pengembalian_${idDetailPenyewaan}" class="block text-sm font-medium text-gray-700 mt-2">Jumlah Pengembalian</label>
        <input type="number" id="jumlah_pengembalian_${idDetailPenyewaan}"
        name="jumlah_pengembalian[${idDetailPenyewaan}]" required>
    `;
                } else {
                    // Tampilkan pesan kesalahan atau log jika id_penyewaan atau id_detail_penyewaan tidak ada
                    console.error('id_penyewaan atau id_detail_penyewaan tidak ditemukan');
                }

                returnItemsContainer.appendChild(inputKondisiBarang);
            });

            // Menyimpan id_penyewaan pada hidden input
            document.getElementById('id_penyewaan').value = idPenyewaan;

            // Menampilkan modal
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeReturnModal() {
            // Menutup modal
            document.getElementById('detailModal').classList.add('hidden');
        }

        function submitReturn() {
            const idPenyewaan = document.getElementById('id_penyewaan').value;

            const returnItems = [];
            const kondisiInputs = document.querySelectorAll('#return-items-container input[name^="kondisi_barang"]');
            const jumlahInputs = document.querySelectorAll('#return-items-container input[name^="jumlah_pengembalian"]');

            kondisiInputs.forEach((input, index) => {
                const idDetailPenyewaan = input.name.match(/\[([^\]]+)\]/)[1];
                const kondisi = input.value;
                const jumlah = jumlahInputs[index].value;

                if (!kondisi || !jumlah) {
                    alert('Harap isi kondisi barang dan jumlah pengembalian untuk semua barang yang dipilih.');
                    return;
                }

                returnItems.push({
                    id_detail_penyewaan: idDetailPenyewaan,
                    kondisi_barang: kondisi,
                    jumlah_pengembalian: jumlah
                });
            });

            if (returnItems.length === 0) {
                alert('Tidak ada data untuk dikirim.');
                return;
            }

            // Kirim data menggunakan AJAX
            $.ajax({
                url: '/pengembalian',
                method: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    _token: '{{ csrf_token() }}',
                    id_penyewaan: idPenyewaan,
                    items: returnItems
                }),
                success: function(response) {
                    alert(response.message);
                    closeReturnModal();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat pengembalian.');
                }
            });
        }
    </script>
    <script>
        AOS.init();
    </script>
    @include('pages.layout.script')
</body>

</html>
