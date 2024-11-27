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
            fetch("{{ route('keranjang.view') }}")
                .then(response => response.json())
                .then(data => {
                    keranjangContent.innerHTML = '';
                    let total = 0;
                    if (data.length > 0) {
                        data.forEach(item => {
                            const keranjangItem = `
                    <div class="flex justify-between items-center border-b pb-4 mb-4">
                        
                        <img src="${item.link_foto}" alt="${item.nama_barang}" class="sm:w-[30vw] w-[70vw] sm:h-[40vw] h-[80vw] object-cover">
                        <div class="flex-1 ml-4">
                            <h3 class="font-semibold">${item.nama_barang}</h3>
                            <p class="text-sm text-gray-600">Rp ${item.harga_sewa}</p>
                            <div class="flex items-center">
                                <button class="decrease-quantity bg-gray-200 px-2 py-1 rounded" data-id="${item.id_keranjang}">-</button>
                                <span class="mx-2">${item.jumlah_barang}</span>
                                <button class="increase-quantity bg-gray-200 px-2 py-1 rounded" data-id="${item.id_keranjang}">+</button>
                            </div>
                        </div>
                        <div>
                            <button class="remove-item text-red-500 hover:text-red-600" data-id="${item.id_keranjang}">Remove</button>
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
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const overlay = document.getElementById("overlay");
        const modal = document.getElementById("keranjangModal");
        const closeModal = document.getElementById("closeModal");

        const toggleModal = (show) => {
            if (show) {
                overlay.classList.remove("hidden");
                modal.classList.remove("translate-x-full", "opacity-0", "invisible");
            } else {
                overlay.classList.add("hidden");
                modal.classList.add("translate-x-full", "opacity-0", "invisible");
            }
        };

        // Tombol untuk membuka modal
        document.getElementById("openModalButton").addEventListener("click", () => toggleModal(true));

        // Tombol untuk menutup modal
        closeModal.addEventListener("click", () => toggleModal(false));

        // Klik overlay untuk menutup modal
        overlay.addEventListener("click", (e) => {
            if (e.target.id === "overlay") {
                toggleModal(false);
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const addToBagButtons = document.querySelectorAll('.add-to-bag');

        addToBagButtons.forEach(button => {
            button.addEventListener('click', () => {
                const idBarang = button.getAttribute('data-id-barang');
                const quantity = document.getElementById('quantity1').textContent;

                fetch("{{ route('keranjang.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            id_barang: idBarang,
                            jumlah_barang: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menambahkan ke keranjang.',
                        });
                        console.error(error);
                    });
            });
        });
    });

    function increment1(id) {
        const quantityElement = document.getElementById(id);
        quantityElement.textContent = parseInt(quantityElement.textContent) + 1;
    }

    function decrement1(id) {
        const quantityElement = document.getElementById(id);
        if (parseInt(quantityElement.textContent) > 1) {
            quantityElement.textContent = parseInt(quantityElement.textContent) - 1;
        }
    }
</script>
