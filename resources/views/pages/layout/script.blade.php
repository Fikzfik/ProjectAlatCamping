<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const filterSide = document.getElementById('filterSide');
        const body = document.getElementById('body');
        const nav = document.getElementById('nav');
        const openButton = document.getElementById('hamburger');
        const closeButton = document.getElementById('cross');
        const filterButton = document.getElementById('filter');
        const closeFilterButton = document.getElementById('crossFilter');
        const sideElements = document.querySelectorAll('.sideElement');

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

        filterButton.addEventListener('click', () => {
            filterSide.classList.remove('slide-out-active');
            filterSide.classList.add('slide-in-active');
            body.classList.add('overflow-y-hidden');
            nav.classList.remove('pointer-events-none');
            sideElements.forEach((sideElement, index) => {
                setTimeout(() => {
                    sideElement.classList.remove('translate-x-[-100%]');
                    sideElement.classList.add('translate-x-0');
                }, index * 100); // Delay 100ms untuk setiap elemen
            });
        });

        // Tombol untuk Slide Out
        closeFilterButton.addEventListener('click', () => {
            filterSide.classList.remove('slide-in-active');
            filterSide.classList.add('slide-out-active');
            body.classList.remove('overflow-y-hidden');
            nav.classList.add('pointer-events-none');
            sideElements.forEach((sideElement, index) => {
                sideElement.classList.add('translate-x-[-100%]');
                sideElement.classList.remove('translate-x-0');
            });
        });

        const slider = document.getElementById('sliderContainer');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        // Konversi dari vw ke pixel
        function vwToPx(vw) {
            return (vw / 100) * window.innerWidth;
        }

        const scrollAmountVW = 19.427; // Misalkan 20vw
        const scrollAmountPx = vwToPx(scrollAmountVW); // Konversi 20vw ke pixel

        nextBtn.addEventListener('click', () => {
            slider.scrollBy({
                left: scrollAmountPx,
                behavior: 'smooth'
            });
        });

        prevBtn.addEventListener('click', () => {
            slider.scrollBy({
                left: -scrollAmountPx,
                behavior: 'smooth'
            });
        });

        // Update nilai scrollAmount saat ukuran viewport berubah
        window.addEventListener('resize', () => {
            scrollAmountPx = vwToPx(scrollAmountVW);
        });

    });
    function toggleAdminMenu() {
        const dropdown = document.getElementById('adminDropdown');
        dropdown.classList.toggle('hidden'); // Toggle visibility
    }

    // Optional: Close dropdown if clicked outside
    document.addEventListener('click', function (event) {
        const dropdown = document.getElementById('adminDropdown');
        const menuButton = dropdown.previousElementSibling; // The Admin button
        if (!dropdown.contains(event.target) && !menuButton.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
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

    function toggleDropdown7() {
        const dropdown = document.getElementById('dropdownList7');
        const arrowIcon = document.getElementById('arrowIcon7');
        if (dropdown.style.maxHeight) {
            dropdown.style.maxHeight = null;
            arrowIcon.style.transform = 'rotate(0deg)';
        } else {
            dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
            arrowIcon.style.transform = 'rotate(180deg)';
        }
    }


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
    document.addEventListener("DOMContentLoaded", function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(csrfToken); // Pastikan token berhasil diambil
    });

    function rebindEventListeners() {
        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', () => {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');
                console.log('CSRF Token:', csrfToken); // Pastikan ini mencetak token yang valid

                const idKeranjang = button.getAttribute('data-id');
                console.log('ID Keranjang:', idKeranjang);

                fetch('/keranjang/increase', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken, // Kirim token CSRF di header
                        },
                        body: JSON.stringify({
                            id_keranjang: idKeranjang
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            loadKeranjang();
                        } else {
                            console.error(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });


        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', () => {
                console.log('Event listener added to button:', button);

                const idKeranjang = button.getAttribute('data-id');
                console.log('Event listener added to button:', idKeranjang);
                fetch('/keranjang/decrease', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            id_keranjang: idKeranjang
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            loadKeranjang();
                        } else {
                            console.error(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    }
    // Pindahkan fungsi loadKeranjang ke luar dari event listener
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
                            <img src="${item.link_foto}" alt="${item.nama_barang}" class="sm:w-[12vw] w-[25vw] sm:h-[12vw] h-[25vw] object-cover rounded-lg">
                            <div class="flex-1 ml-4">
                                <h3 class="font-semibold text-lg text-gray-800 truncate">${item.nama_barang}</h3>
                                <p class="text-sm text-gray-600">Rp ${item.harga_sewa}</p>
                                <div class="flex items-center mt-2 space-x-4">
                                    <button class="decrease-quantity bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition duration-200" data-id="${item.id_keranjang}">-</button>
                                    <span class="text-lg">${item.jumlah_barang}</span>
                                    <button class="increase-quantity bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition duration-200" data-id="${item.id_keranjang}">+</button>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                    `;
                        keranjangContent.innerHTML += keranjangItem;
                        total += parseFloat(item.harga_sewa) * item.jumlah_barang;
                    });
                } else {
                    keranjangContent.innerHTML = '<p class="text-center">Your cart is empty.</p>';
                }
                totalAmount.innerHTML = `Rp ${total.toLocaleString()}`;

                // Re-inisialisasi event listener
                rebindEventListeners();
            })
            .catch(error => {
                console.error("Error loading keranjang data:", error);
                keranjangContent.innerHTML = '<p class="text-center">Failed to load cart data.</p>';
            });
    }

    document.addEventListener("DOMContentLoaded", function() {
        const overlay = document.getElementById('overlay');
        const modal = document.getElementById('keranjangModal');
        const closeModalButton = document.getElementById('closeModal');
        const keranjangContent = document.getElementById('keranjangContent');
        const totalAmount = document.getElementById('totalAmount');
        const openModalButton = document.getElementById('keranjangButton'); // Tombol buka modal

        // Fungsi untuk membuka/menutup modal
        const toggleModal = (show) => {
            if (show) {
                overlay.classList.remove('hidden');
                modal.classList.remove('translate-x-full', 'opacity-0', 'invisible');
            } else {
                overlay.classList.add('hidden');
                modal.classList.add('translate-x-full', 'opacity-0', 'invisible');
            }
        };

        // Event buka modal
        if (openModalButton) {
            openModalButton.addEventListener('click', () => {
                toggleModal(true);
                loadKeranjang(); // Ambil data keranjang
            });
        }

        // Event tutup modal
        closeModalButton.addEventListener('click', () => toggleModal(false));
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) toggleModal(false);
        });
    });
</script>
<script>
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
