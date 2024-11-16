<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Ganti path file CSS dengan asset() -->
    <link rel="stylesheet" href="{{ asset('src/css/output.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="{{ asset('node_modules/aos/dist/aos.css') }}" rel="stylesheet">
    <script src="{{ asset('node_modules/aos/dist/aos.js') }}"></script>
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
    </style>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav');
    <div class="text-white flex justify-between sm:px-[4.271vw] px-[8.372vw] pt-[2.604vw]">
        <div class="w-[23.031vw] overflow-y-auto max-h-[100vh] scrollbar-hide sticky top-[0.833vw] sm:inline hidden">
            <div class="space-y-[1.198vw]">
                <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="100" class="space-y-[0.729vw]">
                    <h2 class="text-[1.25vw] font-semibold">Filters:</h2>
                    <hr>
                </div>
                <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">
                    <div class="space-y-[0.729vw]">
                        <a href="javascript:void(0)" onclick="toggleDropdown1()">
                            <div data-aos-delay="200" class="flex items-center justify-between">
                                <h2 class="text-[1.146vw] font-medium">Type:</h2>
                                <img id="arrowIcon1" src="assets/icons/arrow-icon.svg" alt=""
                                    class="w-[0.833vw] rotate-180 transition-transform duration-500">
                                <!-- Default open state -->
                            </div>
                        </a>
                        <hr>
                        <div id="dropdownList1"
                            class="overflow-hidden max-h-[20vw] transition-all duration-500 ease-in-out">
                            <!-- Default open state -->
                            <ul class="text-[0.938vw] space-y-[0.5vw] max-w-[3vw]">
                                <li
                                    class="font-medium opacity-100 translate-x-0 transition-all duration-500 ease-in-out">
                                    <a href="">Shirt</a>
                                </li>
                                <li
                                    class="opacity-60 translate-x-0 hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <a href="">Coat</a>
                                </li>
                                <li
                                    class="opacity-60 translate-x-0 hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <a href="">Jacket</a>
                                </li>
                                <li
                                    class="opacity-60 translate-x-0 hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <a href="">Flannel</a>
                                </li>
                                <li
                                    class="opacity-60 translate-x-0 hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <a href="">Short</a>
                                </li>
                                <li
                                    class="opacity-60 translate-x-0 hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <a href="">Pants</a>
                                </li>
                                <li
                                    class="opacity-60 translate-x-0 hover:opacity-100 transition-all duration-500 ease-in-out">
                                    <a href="">Hoodie</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">
                    <div class="space-y-[0.729vw]">
                        <a href="javascript:void(0)" onclick="toggleDropdown2()">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[1.146vw] font-medium">Availability:</h2>
                                <img id="arrowIcon2" src="assets/icons/arrow-icon.svg" alt=""
                                    class="w-[0.833vw] rotate-0 transition-transform duration-500">
                            </div>
                        </a>
                        <hr>
                        <div id="dropdownList2" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                            <ul id="listItems2" class="text-[0.938vw] space-y-[0.781vw]">
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">In Stock</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">Out Of Stock</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="400">
                    <div class="space-y-[0.729vw]">
                        <a href="javascript:void(0)" onclick="toggleDropdown3()">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[1.146vw] font-medium">Price:</h2>
                                <img id="arrowIcon3" src="assets/icons/arrow-icon.svg" alt=""
                                    class="w-[0.833vw] rotate-0 transition-transform duration-500">
                            </div>
                        </a>
                        <hr>
                        <div id="dropdownList3" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                            <ul class="text-[0.938vw] space-y-[1.042vw] flex items-center space-x-[0.729vw]">
                                <li
                                    class="text-[1.042vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    Rp
                                </li>
                                <li
                                    class="grid grid-cols-2 gap-[1.25vw] items-center opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="text"
                                        class="w-[9.583vw] h-[2.604vw] bg-transparent border-[0.052vw] border-white px-[1.042vw] placeholder:text-white"
                                        placeholder="From :">
                                    <input type="text"
                                        class="w-[9.583vw] h-[2.604vw] bg-transparent border-[0.052vw] border-white px-[1.042vw] placeholder:text-white"
                                        placeholder="To :">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="500">
                    <div class="space-y-[0.729vw]">
                        <a href="javascript:void(0)" onclick="toggleDropdown4()">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[1.146vw] font-medium">Size:</h2>
                                <img id="arrowIcon4" src="assets/icons/arrow-icon.svg" alt=""
                                    class="w-[0.833vw] rotate-0 transition-transform duration-500">
                            </div>
                        </a>
                        <hr>
                        <div id="dropdownList4"
                            class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
                            <ul class="text-[0.938vw] space-y-[0.781vw]">
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">S</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">M</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">L</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">XL</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">XXL</p>
                                </li>
                                <li
                                    class="font-medium flex items-center space-x-[0.885vw] opacity-0 translate-x-[-100%] transition-all duration-500 ease-in-out">
                                    <input type="checkbox" name="" id=""
                                        class="w-[1.302vw] h-[1.302vw] bg-transparent accent-white" checked>
                                    <p class="text-[0.938vw] font-medium">XXXL</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sm:w-[65.729vw] w-[83.256vw]">
            <div
                class="grid sm:grid-cols-4 grid-cols-2 sm:place-items-start place-items-center sm:gap-y-[2.344vw] gap-y-[9.767vw] sm:gap-x-[1.146vw] gap-x-[3.256vw]">
                <!-- Item 1 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300"
                    class="flex justify-center items-center sm:col-span-1 col-span-2 md:col-span-1">
                    <div class="space-y-[0.885vw] relative overflow-hidden">
                        <!-- https://pin.it/5tOrEauML -->
                        <img src="src/assets/images/cloth-2.png" alt=""
                            class="sm:w-[15.555vw] w-[83.256vw] sm:h-[20.859vw] h-[111.628vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">

                        <div
                            class="absolute sm:w-[15.555vw] w-[83.256vw] sm:h-[10.426vw] h-[54.419vw] bg-gradient-to-t from-dark/90 to-dark/0 bottom-0">

                            <div
                                class="absolute bottom-0 sm:px-[0.938vw] px-[7.442vw] sm:pb-[1vw] pb-[7.442vw] text-white">
                                <div>
                                    <h2 class="sm:text-[0.938vw] text-[4.651vw] leading-none">Black Grafiti Shirt</h2>
                                    <p class="sm:text-[0.938vw] text-[4.651vw] opacity-60">T - Shirt</p>
                                </div>
                                <div
                                    class="flex items-center sm:space-x-[0.313vw] space-x-[3.721vw] sm:mt-[0.938vw] mt-[2.181vw]">
                                    <h2 class="sm:text-[1.25vw] text-[6.047vw]">Rp. 175.000</h2>
                                    <h2 class="sm:text-[0.938vw] text-[4.651vw] opacity-50"><s>Rp. 350.000</s></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 1 -->
                <!-- Item 2 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="350"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-2.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/5OBKtVWaz -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Black Green Grafiti Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 2 -->
                <!-- Item 3 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="400"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-3.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/24zGqV8V5 -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Organic Chemistry Clean Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 3 -->

                <!-- Item 4 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="450"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-4.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://images.app.goo.gl/R1FwJFf9BY23ZF3s6 -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Blue Ocean Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 4 -->

                <!-- Item 5 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-5.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/KPdwGa88L -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Green White Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 5 -->

                <!-- Item 6 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="550"
                    class="sm:flex justify-center items-center hidden">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-6.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/6bYpGRWCS -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Future Coming Art</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 6 -->

                <!-- Item 7 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="600"
                    class="col-span-2 flex justify-center items-center">
                    <div class="relative">
                        <img src="assets/images/collections-image.png" alt=""
                            class="sm:w-[32.292vw] w-[83.256vw] sm:h-[20.859vw] h-[53.721vw]">
                        <!-- https://images.app.goo.gl/zqY9PMEhaKLVE5maA -->
                        <div
                            class="absolute sm:w-[32.292vw] w-[83.256vw] sm:h-[10.426vw] h-[29.535vw] bg-gradient-to-t from-dark/90 to-dark/0 bottom-0 sm:px-[1.875vw] px-[4.884vw] sm:pt-[2.708vw] pt-[6.512vw]">
                            <h1 class="sm:text-[2.5vw] text-[7.442vw]">New Collection Out Now</h1>
                            <button
                                class="sm:w-[11.042vw] w-[30.828vw] sm:h-[2.604vw] h-[7.072vw] text-dark bg-white sm:text-[1.042vw] text-[2.791vw] font-medium"
                                onclick="togglePopup(true)">Shop Now <span class="arrow">--></span></button>
                        </div>
                    </div>
                </div>
                <!-- End Item 7 -->

                <!-- Item 6 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="550"
                    class="sm:hidden justify-center items-center flex">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-6.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/6bYpGRWCS -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Future Coming Art</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 6 -->

                <!-- Item 8 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-7.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/2SKLtUYOg -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Summer Moments Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 8 -->

                <!-- Item 9 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="350"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-8.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://pin.it/6XWuC9AJ3 -->
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Skate Ramp Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 9 -->

                <!-- Item 10 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="400"
                    class="sm:flex justify-center items-center hidden">
                    <a href="detail.html">
                        <div class="space-y-[0.885vw] relative  overflow-hidden">
                            <img src="assets/images/cloth-9.png" alt=""
                                class="w-[15.365vw] h-[20.859vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                            <!-- https://www.birden.com.br/prod/1555/camiseta-oversized-collective-grove#s8203 -->

                            <div
                                class="absolute w-[15.365vw] h-[10.426vw] bg-gradient-to-t from-dark/90 to-dark/0 bottom-0">

                                <div class="absolute bottom-0 px-[0.938vw] pb-[1vw] text-white">
                                    <div>
                                        <h2 class="text-[0.938vw]">Soft Green Oversized</h2>
                                        <p class="text-[0.938vw] opacity-60">T - Shirt</p>
                                    </div>
                                    <div class="flex items-center space-x-[0.313vw]">
                                        <h2 class="text-[1.25vw]">Rp. 175.000</h2>
                                        <h2 class="text-[0.938vw] opacity-50"><s>Rp. 350.000</s></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Item 10 -->

                <!-- Item 11 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="450"
                    class="flex justify-center items-center">
                    <div class="flex flex-col justify-between h-auto">
                        <div class="overflow-hidden">
                            <img src="assets/images/cloth-10.png" alt=""
                                class="sm:w-[15.555vw] w-[39.767vw] sm:h-[15.115vw] h-[39.302vw] object-cover object-top transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="">
                            <div class="mt-[10px]">
                                <h2
                                    class="sm:text-[0.938vw] text-[2.791vw] font-semibold truncate sm:w-[15.555vw] w-[40vw]">
                                    Color Grafiti Oversized Shirt</h2>
                                <p class="sm:text-[0.938vw] text-[2.326vw] opacity-60">T - Shirt</p>
                            </div>
                            <div class="flex items-center sm:space-x-[0.313vw] space-x-[2.326vw] mt-[1vw]">
                                <h2 class="sm:text-[1.25vw] text-[3.256vw]">Rp. 175.000</h2>
                                <h2 class="sm:text-[0.938vw] text-[2.791vw] opacity-50"><s>Rp. 350.000</s></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Item 11 -->
                <!-- Item 12 -->
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500"
                    class="sm:hidden flex justify-center items-center sm:col-span-1 col-span-2 md:col-span-1">
                    <a href="detail.html">
                        <div class="space-y-[0.885vw] relative">
                            <img src="assets/images/cloth-9.png" alt=""
                                class="sm:w-[15.555vw] w-[83.256vw] sm:h-[20.859vw] h-[111.628vw] object-cover object-top">
                            <!-- https://pin.it/2B1dHMvN3 -->

                            <div
                                class="absolute sm:w-[15.555vw] w-[83.256vw] sm:h-[10.426vw] h-[54.419vw] bg-gradient-to-t from-dark/90 to-dark/0 bottom-0">

                                <div
                                    class="absolute bottom-0 sm:px-[0.938vw] px-[7.442vw] sm:pb-[1vw] pb-[7.442vw] text-white">
                                    <div>
                                        <h2 class="sm:text-[0.938vw] text-[4.651vw] leading-none">Soft Green Oversized
                                        </h2>
                                        <p class="sm:text-[0.938vw] text-[4.651vw] opacity-60">T - Shirt</p>
                                    </div>
                                    <div
                                        class="flex items-center sm:space-x-[0.313vw] space-x-[3.721vw] sm:mt-0 mt-[2.181vw]">
                                        <h2 class="sm:text-[1.25vw] text-[6.047vw]">Rp. 175.000</h2>
                                        <h2 class="sm:text-[0.938vw] text-[4.651vw] opacity-50"><s>Rp. 350.000</s></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- End Item 12 -->
            </div>
        </div>
    </div>
    @include('pages.layout.footer')
    </div>
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
    <script>
        function toggleAdminMenu() {
            const dropdown = document.getElementById('adminDropdown');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        }


        function toggleDropdown5() {
            const dropdown = document.getElementById('dropdownList5');
            const arrowIcon = document.getElementById('arrowIcon5');
            if (dropdown.style.maxHeight) {
                dropdown.style.maxHeight = null; // Tutup dropdown
                arrowIcon.style.transform = 'rotate(180deg)'; // Kembalikan panah
            } else {
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px'; // Buka dropdown
                arrowIcon.style.transform = 'rotate(0deg)'; // Rotasi panah ke bawah
            }
        }

        function toggleDropdown6() {
            const dropdown = document.getElementById('dropdownList6');
            const arrowIcon = document.getElementById('arrowIcon6');
            if (dropdown.style.maxHeight) {
                dropdown.style.maxHeight = null;
                arrowIcon.style.transform = 'rotate(0deg)';
            } else {
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
                arrowIcon.style.transform = 'rotate(180deg)';
            }
        }

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
</body>

</html>
