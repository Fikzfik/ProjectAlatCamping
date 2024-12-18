<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Home</title>
    <style>
        #dropdownList5,
        #dropdownList6,
        #dropdownList7 {
            max-height: 0;
            /* Default tertutup */
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        .container {
            max-width: 1200px;
        }

        .flex-1:hover {
            cursor: pointer;
        }

        .grid-cols-1 .item {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rounded-lg {
            border-radius: 12px;
        }
    </style>
</head>

<body id="body" class="relative">
    <!-- Background Blur -->
    <div class="absolute inset-0 -z-10"
        style="background-image: url('{{ asset('src/assets/images/bgwebsite.jpeg') }}'); 
               background-size: cover; 
               background-position: center; 
               filter: blur(10px); 
               opacity: 0.9;
               pointer-events: none;">
    </div>
    @include('pages.layout.nav');
    @if (session('notif'))
        <div class="alert alert-success">
            {{ session('notif') }}
        </div>
    @endif

    <!-- Jika ada error -->
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mx-auto p-4 relative z-20">
        <!-- Tabs -->
        <div class="flex border-b border-gray-500">
            <button onclick="showTab('booked')" id="tab-booked"
                class="flex-1 py-2 px-4 text-gray-400 text-center hover:text-white hover:bg-gray-500 cursor-pointer">
                Sudah Dibooking
            </button>
            <button onclick="showTab('rented')" id="tab-rented"
                class="flex-1 py-2 px-4 text-gray-400 text-center hover:text-white hover:bg-gray-500 cursor-pointer">
                Sedang Disewa
            </button>
            <button onclick="showTab('history')" id="tab-history"
                class="flex-1 py-2 px-4 text-gray-400 text-center hover:text-white hover:bg-gray-500 cursor-pointer">
                History Penyewaan
            </button>
        </div>

        <!-- Content Section -->
        <div class="mt-4">
            <!-- Sudah Dibooking -->
            <div id="content-booked" class="grid sm:grid-cols-2 grid-cols-1 gap-6">
                @forelse ($barangBooked as $item)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}">
                            <img src="{{ asset('storage/' . $item->link_foto) }}" alt="Barang Image"
                                class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-gray-800 font-semibold">{{ $item->nama_barang }}</h3>
                            <p class="text-gray-600">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-sm">Tanggal Booking: {{ $item->tanggal_booking }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-white">
                        Kamu tidak mempunyai barang yang dibooking.
                    </div>
                @endforelse
            </div>

            <div id="content-rented" class="hidden grid sm:grid-cols-2 grid-cols-1 gap-6">
                @forelse ($barangRented as $item)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}">
                            <img src="{{ asset('storage/' . $item->link_foto) }}" alt="Barang Image"
                                class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-gray-800 font-semibold">{{ $item->nama_barang }}</h3>
                            <p class="text-gray-600">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-sm">Tanggal Sewa: {{ $item->tanggal_sewa }}</p>
                            <p class="text-gray-500 text-sm">Tanggal Kembali: {{ $item->tanggal_kembali }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-white">
                        Kamu tidak mempunyai barang yang sedang disewa.
                    </div>
                @endforelse
            </div>

            {{-- @dd($barangHistory); --}}
            <div id="content-history" class="hidden grid sm:grid-cols-2 grid-cols-1 gap-6">
                @forelse ($barangHistory as $item)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}">
                            <img src="{{ asset('storage/' . $item->link_foto) }}" alt="Barang Image"
                                class="w-full h-48 object-cover">
                        </a>
                        <div class="p-4">
                            <h3 class="text-gray-800 font-semibold">{{ $item->nama_barang }}</h3>
                            <p class="text-gray-600">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</p>
                            <p class="text-gray-500 text-sm">Tanggal Sewa: {{ $item->tanggal_sewa }}</p>
                            <p class="text-gray-500 text-sm">Tanggal Kembali: {{ $item->tanggal_kembali }}</p>
                            @if (empty($item->id_feedback))
                                <!-- Tombol Feedback -->
                                <form action="{{ route('storeFeedback') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_barang" value="{{ $item->id_barang }}">
                                    <input type="hidden" name="id_penyewaan" value="{{ $item->id_penyewaan }}">

                                    <button type="button" onclick="openModal()"
                                        class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Beri Feedback
                                    </button>
                                </form>
                            @else
                                <!-- Jika Sudah Difedback -->
                                <p class="text-green-500 mt-4">Feedback sudah diberikan.</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-10 text-white">
                        Kamu tidak mempunyai sejarah penyewaan barang.
                    </div>
                @endforelse
            </div>

        </div>
        <div id="feedbackModal"
            class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg w-full sm:w-1/3">
                <h3 class="text-xl font-semibold mb-4">Beri Feedback</h3>

                <form action="{{ route('storeFeedback') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_barang" value="{{ $item->id_barang }}">
                    <input type="hidden" name="id_penyewaan" value="{{ $item->id_penyewaan }}">

                    <label for="rating" class="block mb-2 text-sm font-medium text-gray-700">Rating:</label>
                    <select name="rating" id="rating" required
                        class="block w-full p-2 mb-4 border border-gray-300 rounded">
                        <option value="5">5 - Sangat Puas</option>
                        <option value="4">4 - Puas</option>
                        <option value="3">3 - Cukup</option>
                        <option value="2">2 - Kurang</option>
                        <option value="1">1 - Tidak Puas</option>
                    </select>

                    <label for="komentar" class="block mb-2 text-sm font-medium text-gray-700">Komentar:</label>
                    <textarea name="komentar" id="komentar" rows="4" class="block w-full p-2 mb-4 border border-gray-300 rounded"></textarea>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                            Kirim Feedback
                        </button>
                        <button type="button" onclick="closeModal()"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Tutup
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    @include('pages.layout.footer')
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
    @include('pages.layout.script');
    <script>
        // Fungsi untuk membuka modal
        function openModal() {
            document.getElementById('feedbackModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('feedbackModal').classList.add('hidden');
        }
    </script>

    <script>
        function showTab(tabId) {
            // Hide all content sections
            document.getElementById('content-booked').classList.add('hidden');
            document.getElementById('content-rented').classList.add('hidden');
            document.getElementById('content-history').classList.add('hidden');

            // Remove active styles from all tabs
            document.getElementById('tab-booked').classList.remove('bg-gradient-to-r', 'from-gray-700', 'to-gray-500',
                'text-white');
            document.getElementById('tab-rented').classList.remove('bg-gradient-to-r', 'from-gray-700', 'to-gray-500',
                'text-white');
            document.getElementById('tab-history').classList.remove('bg-gradient-to-r', 'from-gray-700', 'to-gray-500',
                'text-white');

            // Show selected content section
            document.getElementById(`content-${tabId}`).classList.remove('hidden');

            // Add active styles to selected tab
            document.getElementById(`tab-${tabId}`).classList.add('bg-gradient-to-r', 'from-gray-700', 'to-gray-500',
                'text-white');
        }
    </script>
    <script>
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
    </script>
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
    @include('pages.layout.script');
</body>

</html>
