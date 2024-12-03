<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Detail</title>
    <style>
        #dropdownList5,
        #dropdownList6,
        #dropdownList7 {
            max-height: 0;
            /* Default tertutup */
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
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
                <div class="border border-white sm:px-6 px-4 sm:py-6 py-4 sm:w-[64.74vw] w-full space-y-6">
                    <!-- Looping Barang -->
                    @foreach ($keranjangs as $keranjang)
                        <div
                            class="flex items-start border-b border-gray-300 pb-6 gap-6 hover:shadow-lg hover:scale-105 transform transition duration-300">
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
                                    <!-- Tombol - -->
                                    <button
                                        class="bg-gray-700 text-white px-2 py-1 rounded-lg hover:bg-gray-600 transition duration-200"
                                        onclick="updateQuantity('{{ $keranjang->id_keranjang }}', -1)">
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
                                        onclick="updateQuantity('{{ $keranjang->id_keranjang }}', 1)">
                                        +
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Bagian Metode Pembayaran -->
            <div class="w-full sm:w-[30vw] space-y-[3vw] sticky sm:inline-block overflow-x-hidden overflow-y-auto max-h-[100vh] scrollbar-hide top-[1.2vw] p-4 bg-gray-800 rounded-lg shadow-lg"
                data-aos="fade-left" data-aos-delay="400" data-aos-duration="500">
                <h2 class="text-[1.5vw] font-semibold mb-4">Pilih Metode Pembayaran</h2>
                <form id="paymentForm" onsubmit="return false;">
                    @csrf
                    <div class="space-y-4">
                        <label
                            class="flex items-center space-x-4 p-2 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-200">
                            <input class="form-radio text-blue-500" name="payment_method" type="radio"
                                value="bank_transfer" required />
                            <span>Bank Transfer</span>
                        </label>
                        <div id="bankTransferOptions" class="hidden space-y-4 pl-8">
                            <select name="bank" class="form-select bg-gray-600 text-white rounded-lg p-2 w-full">
                                <option value="bank_a">Bank A</option>
                                <option value="bank_b">Bank B</option>
                                <option value="bank_c">Bank C</option>
                            </select>
                        </div>

                        <label
                            class="flex items-center space-x-4 p-2 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-200">
                            <input class="form-radio text-blue-500" name="payment_method" type="radio"
                                value="credit_card" required />
                            <span>Kartu Kredit</span>
                        </label>
                        <div id="creditCardOptions" class="hidden space-y-4 pl-8">
                            <select name="credit_card_type"
                                class="form-select bg-gray-600 text-white rounded-lg p-2 w-full">
                                <option value="visa">Visa</option>
                                <option value="mastercard">MasterCard</option>
                            </select>
                        </div>

                        <label
                            class="flex items-center space-x-4 p-2 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-200">
                            <input class="form-radio text-blue-500" name="payment_method" type="radio" value="gopay"
                                required />
                            <span>E-Wallet (OVO, GoPay, dll)</span>
                        </label>
                        <div id="ewalletOptions" class="hidden space-y-4 pl-8">
                            <select name="ewallet" class="form-select bg-gray-600 text-white rounded-lg p-2 w-full">
                                <option value="gopay">GoPay</option>
                                <option value="ovo">OVO</option>
                                <option value="shopeepay">ShopeePay</option>
                                <option value="dana">Dana</option>
                            </select>
                        </div>
                    </div>
                    <button
                        class="bg-blue-500 text-white w-full py-2 mt-6 rounded-lg hover:bg-blue-600 transition duration-200"
                        type="button" id="submitPayment">
                        Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>

        <!-- Background Teks Besar -->
        <h1
            class="absolute top-[-6vw] left-0 right-0 bottom-0 text-[13.021vw] md:text-[12.7vw] font-extrabold text-text_dark flex justify-center z-[-1] shadow__text">
            T SHIRT
        </h1>
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
        document.querySelectorAll('input[name="payment_method"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'bank_transfer') {
                    document.getElementById('bankTransferOptions').classList.remove('hidden');
                    document.getElementById('creditCardOptions').classList.add('hidden');
                    document.getElementById('ewalletOptions').classList.add('hidden');
                } else if (this.value === 'credit_card') {
                    document.getElementById('creditCardOptions').classList.remove('hidden');
                    document.getElementById('bankTransferOptions').classList.add('hidden');
                    document.getElementById('ewalletOptions').classList.add('hidden');
                } else if (this.value === 'gopay') {
                    document.getElementById('ewalletOptions').classList.remove('hidden');
                    document.getElementById('bankTransferOptions').classList.add('hidden');
                    document.getElementById('creditCardOptions').classList.add('hidden');
                } else {
                    document.getElementById('bankTransferOptions').classList.add('hidden');
                    document.getElementById('creditCardOptions').classList.add('hidden');
                    document.getElementById('ewalletOptions').classList.add('hidden');
                }
            });
        });
        document.getElementById('submitPayment').addEventListener('click', () => {
            const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!selectedPaymentMethod) {
                Swal.fire({
                    title: 'Metode Pembayaran',
                    text: 'Pilih metode pembayaran sebelum melanjutkan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const paymentMethod = selectedPaymentMethod.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/pembayaran', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        payment_method: paymentMethod
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: 'Berhasil',
                            text: 'Metode pembayaran berhasil dipilih!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Redirect ke Midtrans checkout link
                            window.location.href = data.data
                                .redirect_url; // Pastikan 'data.data.redirect_url' sesuai dengan yang dikirimkan dari server
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


        function validatePaymentMethod() {
            const selectedPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (!selectedPaymentMethod) {
                Swal.fire({
                    title: 'Metode Pembayaran',
                    text: 'Pilih metode pembayaran sebelum melanjutkan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }
            return true;
        }

        function updateQuantity(idKeranjang, change) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const endpoint = change > 0 ? '/keranjang/increase' : '/keranjang/decrease';

            fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        id_keranjang: idKeranjang
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Pastikan data.jumlah_barang tersedia
                    if (data.success) {
                        const jumlahBarangElement = document.getElementById(`jumlah-barang-${idKeranjang}`);
                        if (jumlahBarangElement) {
                            jumlahBarangElement.innerText = data.jumlah_barang; // Update UI
                        }
                    } else {
                        alert(data.message || 'Terjadi kesalahan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
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
    </script>
    <script>
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

            const slider = document.getElementById('sliderContainer');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            function vwToPx(vw) {
                return (vw / 100) * window.innerWidth;
            }

            // Inisialisasi nilai awal
            let scrollAmountVW = 20.573;
            let scrollAmountPx = vwToPx(scrollAmountVW);

            // Fungsi untuk meng-update nilai scrollAmountVW dan scrollAmountPx berdasarkan lebar layar
            function updateScrollAmount() {
                if (window.innerWidth <= 460) {
                    scrollAmountVW = 55.814;
                } else {
                    scrollAmountVW = 20.573;
                }
                scrollAmountPx = vwToPx(scrollAmountVW);
            }

            // Event listener untuk tombol next
            nextBtn.addEventListener('click', () => {
                slider.scrollBy({
                    left: -scrollAmountPx,
                    behavior: 'smooth'
                });
            });

            // Event listener untuk tombol prev
            prevBtn.addEventListener('click', () => {
                slider.scrollBy({
                    left: scrollAmountPx,
                    behavior: 'smooth'
                });
            });

            // Panggil fungsi sekali untuk inisialisasi awal
            updateScrollAmount();

            window.addEventListener('resize', () => {
                scrollAmountPx = vwToPx(scrollAmountVW);
                updateScrollAmount();
            });


        });
    </script>
    <script>
        AOS.init();
    </script>
    <script src="path/to/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@next/dist/aos.js"></script>

    @include('pages.layout.script');
</body>

</html>
