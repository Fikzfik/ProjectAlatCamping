<div class="w-[100vw] sm:overflow-visible overflow-hidden">
    <div id="nav"
        class="sm:hidden block w-[100vw] h-[216.744vw] overflow-x-hidden absolute z-[2] pointer-events-none">
        <div id="sidebar" class="absolute right-0 bg-white w-[100vw] h-[216.744vw] px-[8.372vw] slide-out-left-active">
            <button id="cross" class="mt-[9.767vw]"><img src="assets/icons/close-icon.svg" alt=""></button>
            <a href="{{ route('home') }}">
                <h1 class="text-black text-[4.651vw] text-center logo">CampRover</h1>
            </a>
            <ul class="flex flex-col gap-[7.442vw] text-black font-semibold text-[4.186vw] mt-[4.884vw]">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('blog') }}">Blog</a></li>
                <li><a href="{{ route('location') }}">Store Location</a></li>
            </ul>
        </div>
        <div id="filterSide"
            class="fixed right-0 bg-white w-[100vw] h-[216.744vw] px-[8.372vw] pb-[8.372vw] slide-out-active">
            <button id="crossFilter" class="ml-[76.512vw] mt-[9.767vw]"><img src="assets/icons/close-icon.svg"
                    alt=""></button>
            <a href="{{ route('home') }}">
                <h1 class="text-black text-[4.651vw] text-center logo">CampRover</h1>
            </a>
            <div class="space-y-[4.651vw] mt-[4.884vw] h-[150.744vw] overflow-x-hidden overflow-y-scroll">
                <div class="space-y-[0.729vw]">
                    <h2 class="sm:text-[1.25vw] text-[4.651vw] font-semibold">Filters:</h2>
                    <hr class="h-[0.465vw] bg-black">
                </div>
                <div>
                    <div class="">
                        <div class="sideElement transform translate-x-[-100%] transition-transform duration-500">
                            <a href="javascript:void(0)" onclick="toggleDropdown5()">
                                <div class="flex items-center justify-between">
                                    <h2 class="sm:text-[1.146vw] text-[4.186vw] font-medium">Collection:</h2>
                                    <img id="arrowIcon5" src="assets/icons/arrow-icon-black.svg" alt=""
                                        class="w-[2.326vw] rotate-180 transition-transform duration-500">
                                </div>
                            </a>
                            <hr class="h-[0.465vw] bg-black mt-[1.86vw]">
                        </div>
                        <div id="dropdownList5" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                            <ul id="listItems5" class="text-[3.721vw] space-y-[2.326vw]">
                                <li
                                    class="font-medium opacity-100 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <a href="">Dark Series</a>
                                </li>
                                <li
                                    class="opacity-60 hover:opacity-100 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <a href="">Summer Edition</a>
                                </li>
                                <li
                                    class="opacity-60 hover:opacity-100 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <a href="">Clean Art</a>
                                </li>
                                <li
                                    class="opacity-60 hover:opacity-100 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <a href="">Treadwear x Aerostreet</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="space-y-[0.729vw]">
                        <div class="sideElement transform translate-x-[-100%] transition-transform duration-500">
                            <a href="javascript:void(0)" onclick="toggleDropdown6()">
                                <div class="flex items-center justify-between">
                                    <h2 class="sm:text-[1.146vw] text-[4.186vw] font-medium">Availability:</h2>
                                    <img id="arrowIcon6" src="assets/icons/arrow-icon-black.svg" alt=""
                                        class="w-[2.326vw] rotate-0 transition-transform duration-500">
                                </div>
                            </a>
                            <hr class="h-[0.465vw] bg-black">
                        </div>
                        <div id="dropdownList6" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                            <ul id="listItems6" class="text-[0.938vw] space-y-[2.326vw] mt-[4.651vw]">
                                <li
                                    class="font-medium flex items-center space-x-[4.884vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[6.977vw] h-[6.977vw] bg-transparent accent-black" checked>
                                    <p class="text-[3.721vw] font-medium">In Stock</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[4.884vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[6.977vw] h-[6.977vw] bg-transparent accent-black" checked>
                                    <p class="text-[3.721vw] font-medium">Out Of Stock</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="space-y-[0.729vw]">
                        <div class="sideElement transform translate-x-[-100%] transition-transform duration-500">
                            <a href="javascript:void(0)" onclick="toggleDropdown7()">
                                <div class="flex items-center justify-between">
                                    <h2 class="sm:text-[1.146vw] text-[4.186vw] font-medium">Price:</h2>
                                    <img id="arrowIcon7" src="assets/icons/arrow-icon-black.svg" alt=""
                                        class="w-[2.326vw] rotate-0 transition-transform duration-500">
                                </div>
                            </a>
                        </div>
                        <hr class="h-[0.465vw] bg-black">
                        <div id="dropdownList7"
                            class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out mt-[6.047vw]">
                            <ul id="listItems7"
                                class="text-[0.938vw] space-y-[1.042vw] flex items-center justify-between space-x-[0.729vw]">
                                <li
                                    class="text-[4.186vw] font-medium opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    Rp
                                </li>
                                <li
                                    class="grid grid-cols-2 text-[3.256vw] gap-[2.558vw] items-center opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="text"
                                        class="w-[34.884vw] h-[11.628vw] bg-transparent border-[0.052vw] border-black px-[4.651vw] placeholder:text-black"
                                        placeholder="From :">
                                    <input type="text"
                                        class="w-[34.884vw] h-[11.628vw] bg-transparent border-[0.052vw] border-black px-[4.651vw] placeholder:text-black"
                                        placeholder="To :">
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <nav
        class="flex justify-between items-center sm:pt-[2.323vw] pt-[9.302vw] sm:px-[4.271vw] px-[8.372vw] sm:mb-0 mb-[6.302vw]">
        <div class="sm:inline hidden">
            <ul class="text-[0.938vw] text-white flex space-x-[1.615vw]">
                <!-- Existing Menu -->
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="400">
                    <a href="{{ route('blog') }}">Blog</a>
                </li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="500">
                    <a href="{{ route('location') }}">Store Location</a>
                </li>

                <!-- Admin Menu -->
                <!-- Admin Menu -->
                <li class="relative group" data-aos="fade-right" data-aos-duration="500" data-aos-delay="600">
                    <a href="javascript:void(0)" onclick="toggleAdminMenu()" class="flex items-center">
                    Admin
                        <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <!-- Dropdown -->
                    <ul id="adminDropdown"
                        class="hidden absolute left-0 bg-gray-800 text-white text-sm rounded shadow-lg mt-2 z-10">
                        <li class="px-4 py-2 hover:bg-gray-700"><a href="{{ route('stock') }}">Stock Management</a></li>
                        <li class="px-4 py-2 hover:bg-gray-700"><a href="{{ route('barang') }}">Barang Management</a></li>
                        <li class="px-4 py-2 hover:bg-gray-700"><a href="{{ route('kategori') }}">Kategori Management</a></li>
                        <li class="px-4 py-2 hover:bg-gray-700"><a href="{{ route('menu') }}">Menu Management</a></li>
                        <li class="px-4 py-2 hover:bg-gray-700"><a href="{{ route('settingmenu') }}">Setting Menu Management</a></li>
                    </ul>
                </li>

            </ul>
        </div>

        <div class="flex">
            <button data-aos="fade-right" data-aos-duration="500" data-aos-delay="300" id="hamburger"
                class="sm:hidden inline"><img src="assets/icons/hamburger.svg" alt=""></button>
            <a href="index.html">
                <h1 data-aos="fade-up" data-aos-duration="500" data-aos-delay="200"
                    class="text-white sm:text-[1.667vw] text-[3.721vw] logo sm:ml-0 ml-[4.884vw]">CampRover</h1>
            </a>
        </div>
        <div class="flex items-center sm:space-x-[1.875vw] space-x-[3.721vw]">
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="400"
                class="sm:flex hidden items-center w-[16.25vw] h-[2.917vw] pl-[1.042vw] bg-transparent border border-white ">
                <svg viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"
                    class="w-[1vw] h-[1vw] hover:cursor-pointer">
                    <path
                        d="M16.031 14.617L20.314 18.899L18.899 20.314L14.617 16.031C13.0237 17.3082 11.042 18.0029 9 18C4.032 18 0 13.968 0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18.0029 11.042 17.3082 13.0237 16.031 14.617ZM14.025 13.875C15.2938 12.5697 16.0025 10.8204 16 9C16 5.133 12.867 2 9 2C5.133 2 2 5.133 2 9C2 12.867 5.133 16 9 16C10.8204 16.0025 12.5697 15.2938 13.875 14.025L14.025 13.875Z"
                        fill="#FFF" />
                </svg>
                <input type="text" placeholder="Search"
                    class="w-full pl-[0.521vw] pr-[1.302vw] text-white text-[0.938vw] placeholder-white focus:outline-none bg-transparent" />
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="350" class="sm:hidden block">
                <button href="" onclick="searching()">
                    <img src="src/assets/icons/search-white.svg" alt="" class="sm:w-[2.083vw] w-[4.651vw]">
                </button>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="350">
                <button>
                    <a href="bag.html">
                        <img src="{{ asset('src/assets/icons/bag-icon.svg') }}" alt="" class="sm:w-[2.083vw] w-[4.651vw]">

                    </a>
                </button>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="300" class="relative">
                <button class="flex items-center justify-center" id="profile-button">
                    <img src="{{ asset('src/assets/icons/profile-icon.svg') }}" alt="Profile Icon"
                    class="sm:w-[2.083vw] w-[4.651vw] transition duration-300 ease-in-out hover:scale-110">
                </button>
                <div id="submenu"
                    class="submenu absolute right-0 hidden bg-white shadow-lg rounded-lg mt-2 p-4 w-48">
                    <ul>
                        <li><a href="profile.html" class="block py-2 px-4 hover:bg-gray-200">Profile</a></li>
                        <li><a href="settings.html" class="block py-2 px-4 hover:bg-gray-200">Settings</a></li>
                        <li><a href="{{ route('logout') }}" class="block py-2 px-4 hover:bg-gray-200">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="sm:hidden block px-[8.372vw] mb-[6.302vw]">
        <div id="searchBar"
            class="sm:hidden hidden items-center sm:w-[16.25vw] w-[83.256vw] sm:h-[2.917vw] h-[13.023vw] sm:pl-[1.042vw] pl-[4.651vw] bg-transparent border border-white ">
            <button><img src="src/assets/icons/search-white.svg" alt="" class="w-[3.721vw]"></button>
            <input type="text" placeholder="Search"
                class="w-full pl-[0.521vw] pr-[1.302vw] text-white text-[4.186vw] placeholder-white focus:outline-none bg-transparent ml-[2.326vw]" />
        </div>
    </div>
    <div class="sm:px-[4.271vw] px-[8.372vw] pt-[2.604vw]">
        <div class="text-white text-[0.938vw] flex sm:flex-row flex-col justify-between">
            <ul class="sm:text-[0.938vw] text-[3.291vw] space-x-[0.417vw] flex">
                <a data-aos="fade-right" data-aos-duration="500" data-aos-delay="200" href="index.html">
                    <li>Home</li>
                </a>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">/</li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">All Products</li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">/</li>
            </ul>
            <div class="flex items-center sm:justify-start justify-between sm:mt-0 mt-[3.953vw] sm:mb-0 mb-[5.116vw]">
                <button data-aos="fade-right" data-aos-duration="500" data-aos-delay="300" id="filter"
                    class="sm:hidden inline w-[5.581vw]"><img src="assets/icons/filters.svg" alt=""></button>
                <div class="flex items-center sm:text-[0.938vw] text-[2.791vw] sm:space-x-[2.135vw] space-x-[4.186vw]">
                    <p>Sort by: Best Selling</p>
                    <p class="opacity-60 font-light">189 Products</p>
                </div>
            </div>
        </div>
    </div>
