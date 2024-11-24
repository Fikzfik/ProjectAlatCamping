<script>
    document.addEventListener("DOMContentLoaded", function() {
        const keranjangButton = document.getElementById("keranjangButton");
        const keranjangModal = document.getElementById("keranjangModal");
        const closeModal = document.getElementById("closeModal");
        const overlay = document.getElementById("overlay");

        // Ketika tombol keranjang diklik, tampilkan modal dan overlay
        keranjangButton.addEventListener("click", function() {
            overlay.classList.remove("hidden"); // Menampilkan overlay
            keranjangModal.classList.remove("opacity-0", "invisible");
            keranjangModal.classList.add("opacity-100", "visible");
            keranjangModal.classList.remove("translate-x-full");
            keranjangModal.classList.add("translate-x-0");
            loadKeranjang(); // Fungsi untuk mengambil dan menampilkan data keranjang
        });

        // Menutup modal dan overlay saat klik X atau overlay
        closeModal.addEventListener("click", function() {
            keranjangModal.classList.remove("opacity-100", "visible");
            keranjangModal.classList.add("opacity-0", "invisible");
            keranjangModal.classList.remove("translate-x-0");
            keranjangModal.classList.add("translate-x-full");
            overlay.classList.add("hidden"); // Menyembunyikan overlay
        });

        // Menutup modal jika overlay diklik
        overlay.addEventListener("click", function() {
            keranjangModal.classList.remove("opacity-100", "visible");
            keranjangModal.classList.add("opacity-0", "invisible");
            keranjangModal.classList.remove("translate-x-0");
            keranjangModal.classList.add("translate-x-full");
            overlay.classList.add("hidden"); // Menyembunyikan overlay
        });

        // Fungsi untuk mengambil data keranjang melalui Ajax (menggunakan PDO di Controller)
        function loadKeranjang() {
            fetch("{{ route('keranjang.view') }}") // Mengambil data keranjang
                .then(response => response.json())
                .then(data => {
                    keranjangContent.innerHTML = ''; // Kosongkan konten sebelumnya
                    let total = 0;
                    if (data.length > 0) {
                        data.forEach(item => {
                            const keranjangItem = `
                            <div class="flex justify-between items-center">
                                <img src="${item.link_foto}" alt="${item.nama_barang}" class="w-16 h-16 object-cover">
                                <div class="flex-1 ml-4">
                                    <h3 class="font-semibold">${item.nama_barang}</h3>
                                    <p class="text-sm text-gray-600">Rp ${item.harga_sewa}</p>
                                    <p class="text-sm text-gray-500">Quantity: ${item.jumlah_barang}</p>
                                </div>
                                <div>
                                    <button class="text-red-500 hover:text-red-600">Remove</button>
                                </div>
                            </div>
                            <hr class="my-2">
                        `;
                            keranjangContent.innerHTML += keranjangItem;
                            total += item.harga_sewa * item.jumlah_barang;
                        });
                    } else {
                        keranjangContent.innerHTML = '<p class="text-center">Your cart is empty.</p>';
                    }
                    totalAmount.innerHTML = `Rp ${total.toLocaleString()}`;
                })
                .catch(error => {
                    console.error("Error loading keranjang data:", error);
                    keranjangContent.innerHTML = '<p class="text-center">Failed to load cart data.</p>';
                });
        }
    });
</script>
