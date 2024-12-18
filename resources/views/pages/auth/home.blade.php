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

        .hidden {
            display: none;
        }
    </style>

    </style>
</head>

<body id="body" class="relative">
    <!-- Background Blur -->
    <div class="absolute inset-0 -z-10"
        style="background-image: url('{{ asset('src/assets/images/bgwebsite.jpeg') }}'); 
               background-size: cover; 
               background-position: center; 
               filter: blur(10px); 
               opacity: 0.9;">
    </div>
    @include('pages.layout.nav');
    <div class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg">
        {{ session('notif') }}
    </div>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="text-white flex justify-between sm:px-[4.271vw] px-[8.372vw] pt-[2.604vw] relative">

        <div class="w-[23.031vw] overflow-y-auto max-h-[100vh] scrollbar-hide sticky top-[0.833vw] sm:inline hidden">
            <div class="space-y-[1.198vw]">
                <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="100" class="space-y-[0.729vw]">
                    <h2 class="text-[1.25vw] font-semibold">Filters:</h2>
                    <hr>
                </div>

                <div class="space-y-[1vw]">
                    <!-- Tombol dan Dropdown -->
                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">
                        <div class="space-y-[0.729vw]">
                            <!-- Tombol Toggle -->
                            <a href="javascript:void(0)" data-dropdown-toggle data-target="dropdownListKategori">
                                <div data-aos-delay="200" class="flex items-center justify-between">
                                    <h2 class="text-[1.146vw] font-medium">Categories</h2>
                                    <img id="dropdownIconKategori" src="src/assets/icons/arrow-icon.svg" alt=""
                                        class="w-[0.833vw] rotate-0 transition-transform duration-500">
                                </div>
                            </a>
                            <hr>

                            <!-- Dropdown List -->
                            <div id="dropdownListKategori"
                                class="overflow-auto max-h-[30vw] transition-all duration-500 ease-in-out hidden">  
                                <div class="space-y-[0.729vw]">
                                    <ul class="text-[0.938vw] space-y-[0.5vw] max-w-[3vw]">
                                        @foreach ($kategori as $kat)
                                            <li>
                                                <a href="javascript:void(0)" data-kategori="{{ $kat->id_kategori }}">
                                                    {{ $kat->nama_kategori }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="space-y-[1vw]">
    <!-- Tombol dan Dropdown -->
    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">
        <div class="space-y-[0.729vw]">
            <!-- Tombol Toggle -->
            <a href="javascript:void(0)" id="dropdownToggleKategori">
                <div class="flex items-center justify-between">
                    <h2 class="text-[1.146vw] font-medium">Availability:</h2>
                    <img id="dropdownIconKategori" src="src/assets/icons/arrow-icon.svg" alt="Dropdown Icon"
                        class="w-[0.833vw] rotate-0 transition-transform duration-500">
                </div>
            </a>
            <hr>

            <!-- Dropdown List -->
            <div id="AvailabilityList" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                <ul class="text-[0.938vw] space-y-[0.781vw]">
                    <!-- List Item In-Stock -->
                    <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                        <input type="checkbox" id="inStock" name="availability" class="w-[1.302vw] h-[1.302vw] accent-white" checked>
                        <label for="inStock" class="text-[0.938vw] font-medium cursor-pointer">In Stock</label>
                    </li>
                    <!-- List Item Out-of-Stock -->
                    <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                        <input type="checkbox" id="outOfStock" name="availability" class="w-[1.302vw] h-[1.302vw] accent-white" checked>
                        <label for="outOfStock" class="text-[0.938vw] font-medium cursor-pointer">Out of Stock</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('dropdownToggleKategori');
    const dropdownList = document.getElementById('AvailabilityList');
    const dropdownIcon = document.getElementById('dropdownIconKategori');
    const listItems = document.querySelectorAll('#AvailabilityList li');

    toggleButton.addEventListener('click', () => {
        // Toggle dropdown visibility
        dropdownList.classList.toggle('max-h-0');
        dropdownList.classList.toggle('max-h-[10vw]');

        // Rotate dropdown icon
        dropdownIcon.classList.toggle('rotate-0');
        dropdownIcon.classList.toggle('rotate-180');

        // Animate list items
        listItems.forEach((item, index) => {
            setTimeout(() => {
                item.classList.toggle('opacity-0');
                item.classList.toggle('translate-x-[-100%]');
                item.classList.toggle('translate-x-0');
            }, index * 100); // Delay animation per list item
        });
    });
});
</script><div class="space-y-[1vw]">
    <!-- Tombol dan Dropdown -->
    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">
        <div class="space-y-[0.729vw]">
            <!-- Tombol Toggle -->
            <a href="javascript:void(0)" id="dropdownToggleHarga">
                <div class="flex items-center justify-between">
                    <h2 class="text-[1.146vw] font-medium">Price</h2>
                    <img id="dropdownIconHarga" src="src/assets/icons/arrow-icon.svg" alt="Dropdown Icon"
                        class="w-[0.833vw] rotate-0 transition-transform duration-500">
                </div>
            </a>
            <hr>

            <!-- Dropdown List -->
            <div id="PriceList" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                <div class="flex items-center space-x-[1vw] mt-[1vw]">
                    <!-- Input MIN -->
                    <div class="border border-gray-300 p-[0.5vw] rounded">
                        <label for="minPrice" class="text-gray-500 text-[0.938vw]">Rp MIN</label>
                        <input id="minPrice" type="number" placeholder="0"
                            class="w-[6vw] text-[0.938vw] outline-none bg-transparent">
                    </div>

                    <!-- Separator -->
                    <span class="text-gray-500 text-[0.938vw]">—</span>

                    <!-- Input MAX -->
                    <div class="border border-gray-300 p-[0.5vw] rounded">
                        <label for="maxPrice" class="text-gray-500 text-[0.938vw]">Rp MAKS</label>
                        <input id="maxPrice" type="number" placeholder="1000000"
                            class="w-[6vw] text-[0.938vw] outline-none bg-transparent">
                    </div>
                </div>

                <!-- Tombol Terapkan -->
                <div class="mt-[1vw]">
                    <button id="applyPriceFilter" class="bg-[#000000] text-white font-medium py-[0.5vw] w-full rounded">
                        TERAPKAN
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Toggle Dropdown -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('dropdownToggleHarga');
    const dropdownList = document.getElementById('PriceList');
    const dropdownIcon = document.getElementById('dropdownIconHarga');

    toggleButton.addEventListener('click', () => {
        // Toggle dropdown visibility
        dropdownList.classList.toggle('max-h-0');
        dropdownList.classList.toggle('max-h-[10vw]');

        // Rotate dropdown icon
        dropdownIcon.classList.toggle('rotate-0');
        dropdownIcon.classList.toggle('rotate-180');
    });
});
</script>

<div data-aos="fade-right" data-aos-duration="500" data-aos-delay="500">
    <div class="space-y-[0.729vw]">
        <!-- Tombol Toggle -->
        <a href="javascript:void(0)" onclick="toggleDropdown4()">
            <div class="flex items-center justify-between">
                <h2 class="text-[1.146vw] font-medium">Size:</h2>
                <img id="arrowIcon4" src="src/assets/icons/arrow-icon.svg" alt="Dropdown Icon"
                    class="w-[0.833vw] rotate-0 transition-transform duration-500">
            </div>
        </a>
        <hr>

        <!-- Dropdown List -->
        <div id="dropdownList4" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
            <ul class="text-[0.938vw] space-y-[0.781vw]">
                <!-- List Item S -->
                <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                    <input type="checkbox" id="sizeS" name="size" class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white">
                    <label for="sizeS" class="text-[0.938vw] font-medium cursor-pointer">S</label>
                </li>
                <!-- List Item M -->
                <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                    <input type="checkbox" id="sizeM" name="size" class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white">
                    <label for="sizeM" class="text-[0.938vw] font-medium cursor-pointer">M</label>
                </li>
                <!-- List Item L -->
                <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                    <input type="checkbox" id="sizeL" name="size" class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white">
                    <label for="sizeL" class="text-[0.938vw] font-medium cursor-pointer">L</label>
                </li>
                <!-- List Item XL -->
                <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                    <input type="checkbox" id="sizeXL" name="size" class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white">
                    <label for="sizeXL" class="text-[0.938vw] font-medium cursor-pointer">XL</label>
                </li>
                <!-- List Item XXL -->
                <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                    <input type="checkbox" id="sizeXXL" name="size" class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white">
                    <label for="sizeXXL" class="text-[0.938vw] font-medium cursor-pointer">XXL</label>
                </li>
                <!-- List Item XXXL -->
                <li class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                    <input type="checkbox" id="sizeXXXL" name="size" class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white">
                    <label for="sizeXXXL" class="text-[0.938vw] font-medium cursor-pointer">XXXL</label>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
// Fungsi untuk toggle dropdown
function toggleDropdown4() {
    const dropdownList = document.getElementById('dropdownList4');
    const arrowIcon = document.getElementById('arrowIcon4');
    const listItems = document.querySelectorAll('#dropdownList4 li');

    // Toggle dropdown visibility
    dropdownList.classList.toggle('max-h-0');
    dropdownList.classList.toggle('max-h-[10vw]');

    // Rotate dropdown icon
    arrowIcon.classList.toggle('rotate-0');
    arrowIcon.classList.toggle('rotate-180');

    // Animasi item list
    listItems.forEach((item, index) => {
        setTimeout(() => {
            item.classList.toggle('opacity-0');
            item.classList.toggle('translate-x-[-100%]');
            item.classList.toggle('translate-x-0');
        }, index * 100); // Delay animasi per item
    });
}
</script>




</div>
</div>
        
        <div id="barangContainer"
            class="sm:w-[65.729vw] w-[83.256vw] grid sm:grid-cols-4 grid-cols-2 sm:place-items-start place-items-center sm:gap-y-[2.344vw] gap-y-[9.767vw] sm:gap-x-[1.146vw] gap-x-[3.256vw]">
            @foreach ($barang as $item)
                <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}"
                    class="flex justify-center items-center sm:col-span-1 col-span-2 md:col-span-1" data-aos="fade-up"
                    data-aos-duration="500" data-aos-delay="300">
                    <div class="space-y-[0.885vw] relative overflow-hidden">
                        <img src="{{ asset('storage/' . $item->link_foto) }}" alt=""
                            class="sm:w-[15.555vw] w-[83.256vw] sm:h-[20.859vw] h-[111.628vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                        <div
                            class="absolute sm:w-[15.555vw] w-[83.256vw] sm:h-[10.426vw] h-[54.419vw] bg-gradient-to-t from-dark/90 to-dark/0 bottom-0">
                            <div
                                class="absolute bottom-0 sm:px-[0.938vw] px-[7.442vw] sm:pb-[1vw] pb-[7.442vw] text-white">
                                <div>
                                    <h2 class="sm:text-[0.938vw] text-[4.651vw] leading-none">
                                        {{ $item->nama_barang }}</h2>
                                    <p class="sm:text-[0.938vw] text-[4.651vw] opacity-60">
                                        {{ $item->nama_kategori }}</p>
                                </div>
                                <div
                                    class="flex items-center sm:space-x-[0.313vw] space-x-[3.721vw] sm:mt-[0.938vw] mt-[2.181vw]">
                                    <h2 class="sm:text-[1.25vw] text-[6.047vw]">Rp.
                                        {{ number_format($item->harga_sewa, 0, ',', '.') }}</h2>
                                    <h2 class="sm:text-[0.938vw] text-[4.651vw] opacity-50">
                                        <s>{{ number_format($item->harga_sewa * 2, 0, ',', '.') }}</s>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @include('pages.layout.footer')
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fungsi toggle untuk setiap dropdown
            function toggleDropdown(target) {
                const dropdown = $(`#${target}`);
                const arrowIcon = $(`#${target.replace('List', 'Icon')}`);

                if (dropdown.is(':hidden')) {
                    dropdown.slideDown(300).removeClass('hidden');
                    arrowIcon.css('transform', 'rotate(180deg)');
                } else {
                    dropdown.slideUp(300).addClass('hidden');
                    arrowIcon.css('transform', 'rotate(0deg)');
                }
            }

            // Event listener untuk dropdown
            $('[data-dropdown-toggle]').on('click', function() {
                const target = $(this).data('target');
                toggleDropdown(target);
            });
        });
        $(document).ready(function() {
            // Event handler untuk klik kategori
            $('a[data-kategori]').on('click', function(e) {
                e.preventDefault();

                const kategoriId = $(this).data('kategori'); // Ambil ID kategori
                const targetContainer = $('#barangContainer'); // Target untuk memuat ulang barang

                $.ajax({
                    url: '{{ route('barang.by.kategori') }}',
                    method: 'GET',
                    data: {
                        kategori_id: kategoriId
                    },
                    success: function(response) {
                        // Bersihkan kontainer
                        targetContainer.empty();

                        // Iterasi hasil barang dan tambahkan ke kontainer
                        response.forEach(item => {
                            const barangHtml = `
                        <a href="/detailbarang/${item.id_barang}" 
                           class="flex justify-center items-center sm:col-span-1 col-span-2 md:col-span-1"
                           data-aos="fade-up" data-aos-duration="500" data-aos-delay="300">
                            <div class="space-y-[0.885vw] relative overflow-hidden">
                                <img src="/storage/${item.link_foto}" alt=""
                                     class="sm:w-[15.555vw] w-[83.256vw] sm:h-[20.859vw] h-[111.628vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                                <div class="absolute sm:w-[15.555vw] w-[83.256vw] sm:h-[10.426vw] h-[54.419vw] bg-gradient-to-t from-dark/90 to-dark/0 bottom-0">
                                    <div class="absolute bottom-0 sm:px-[0.938vw] px-[7.442vw] sm:pb-[1vw] pb-[7.442vw] text-white">
                                        <div>
                                            <h2 class="sm:text-[0.938vw] text-[4.651vw] leading-none">${item.nama_barang}</h2>
                                            <p class="sm:text-[0.938vw] text-[4.651vw] opacity-60">${item.nama_kategori}</p>
                                        </div>
                                        <div class="flex items-center sm:space-x-[0.313vw] space-x-[3.721vw] sm:mt-[0.938vw] mt-[2.181vw]">
                                            <h2 class="sm:text-[1.25vw] text-[6.047vw]">Rp. ${item.harga_sewa.toLocaleString('id-ID')}</h2>
                                            <h2 class="sm:text-[0.938vw] text-[4.651vw] opacity-50">
                                                <s>Rp. ${(item.harga_sewa * 2).toLocaleString('id-ID')}</s>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `;
                            targetContainer.append(barangHtml);
                        });
                    },
                    error: function() {
                        alert('Gagal memuat barang. Silakan coba lagi.');
                    }
                });
            });
        });


        AOS.init();
    </script>
    @include('pages.layout.script');
</body>

</html>
