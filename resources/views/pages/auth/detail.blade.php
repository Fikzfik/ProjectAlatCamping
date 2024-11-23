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
    <title>Detail</title>
</head>

<body id="body" class="">
    @include('pages.layout.nav');
    <section class="sm:px-[4.271vw] px-[8.372vw] text-white pt-[3.1vw] relative">
        <div class="w-full flex sm:flex-row flex-col">
            <div class="sm:w-[70vw] w-[83.256vw]">
                {{-- @dd($barang); --}}
                <div class="border border-white sm:px-[1.563vw] px-[13.488vw] sm:py-[1.563vw] py-0 sm:w-[64.74vw] sm:h-[31.979vw] w-[83.256vw] h-[89.535vw]">
                    <div class="flex justify-center items-center relative">
                        <div id="sliderContainer" class="w-full flex justify-center items-center">
                            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300">
                                <img src="{{ asset('storage/' . $barang->link_foto) }}"  alt="{{ $barang->nama_barang }}"
                                    class="sm:w-[20vw] w-[55.814vw] sm:h-[28.542vw] h-[89.07vw] object-cover">
                            </div>
                        </div>
                    </div>
                </div>
                <section class="text-white pt-[5.814vw]">
                    <div class="">
                        <div class="flex sm:flex-row flex-col sm:gap-[4.115vw] gap-0">
                            <!-- Product Details Mobile -->
                            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="300"
                                class="sm:w-[30vw] w-[83.256vw] space-y-[3vw] sm:hidden inline overflow-y-auto h-auto scrollbar-hide top-[1.2vw]">
                                <div class="">
                                    <div class="grid gap-y-[4.651vw]">
                                        <div class="">
                                            <h2 class="text-[4.651vw] font-semibold">Soft Green Oversized</h2>
                                            <p class="text-[3.256vw] opacity-60">T - Shirt</p>
                                            <div class="flex gap-x-[1.395vw] pt-[2.791vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="w-[4.651vw] h-[4.651vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="w-[4.651vw] h-[4.651vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="w-[4.651vw] h-[4.651vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="w-[4.651vw] h-[4.651vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="w-[4.651vw] h-[4.651vw]">
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-[0.313vw]">
                                            <h2 class="text-[4.651vw] font-medium">Rp. 175.000</h2>
                                            <h2 class="text-[3.256vw] opacity-50"><s>Rp. 350.000</s></h2>
                                        </div>
                                        <div class="">
                                            <h2 class="text-[4.651vw] font-normal pb-[1vw]">Size</h2>
                                            <div class="flex space-x-4">
                                                <div class="flex space-x-[3.553vw]">
                                                    <div class="">
                                                        <input type="radio" id="option7" name="option"
                                                            class="hidden peer">
                                                        <label for="option7"
                                                            class="flex items-center justify-center w-[10.698vw] h-[10.698vw] text-white text-[3.256vw] bg-transparent border border-gray-300 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                                                            S
                                                        </label>
                                                    </div>
                                                    <div class="">
                                                        <input type="radio" id="option8" name="option"
                                                            class="hidden peer">
                                                        <label for="option8"
                                                            class="flex items-center justify-center w-[10.698vw] h-[10.698vw] text-white text-[3.256vw] bg-transparent border border-gray-300 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                                                            M
                                                        </label>
                                                    </div>
                                                    <div class="">
                                                        <input type="radio" id="option9" name="option"
                                                            class="hidden peer">
                                                        <label for="option9"
                                                            class="flex items-center justify-center w-[10.698vw] h-[10.698vw] text-white text-[3.256vw] bg-transparent border border-gray-300 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                                                            L
                                                        </label>
                                                    </div>
                                                    <div class="">
                                                        <input type="radio" id="option10" name="option"
                                                            class="hidden peer">
                                                        <label for="option10"
                                                            class="flex items-center justify-center w-[10.698vw] h-[10.698vw] text-white text-[3.256vw] bg-transparent border border-gray-300 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                                                            XL
                                                        </label>
                                                    </div>
                                                    <div class="">
                                                        <input type="radio" id="option11" name="option"
                                                            class="hidden peer">
                                                        <label for="option11"
                                                            class="flex items-center justify-center w-[10.698vw] h-[10.698vw] text-white text-[3.256vw] bg-transparent border border-gray-300 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                                                            XXL
                                                        </label>
                                                    </div>
                                                    <div class="">
                                                        <input type="radio" id="option12" name="option"
                                                            class="hidden peer">
                                                        <label for="option12"
                                                            class="flex items-center justify-center w-[10.698vw] h-[10.698vw] text-white text-[3.256vw] bg-transparent border border-gray-300 cursor-pointer peer-checked:bg-white peer-checked:text-black">
                                                            XXXL
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <h2 class="text-[4.651vw] font-normal pb-[1vw]">Quantity</h2>
                                            <div
                                                class="flex items-center justify-between w-[29.767vw] h-[11.628vw] border border-white text-[3.256vw]">
                                                <button class="text-white px-[4.651vw]"
                                                    onclick="decrement()">-</button>
                                                <span id="quantity" class="text-white">1</span>
                                                <button class="text-white px-[4.651vw]"
                                                    onclick="increment()">+</button>
                                            </div>
                                        </div>
                                        <div class="text-dark space-y-[2.791vw] flex flex-col">
                                            <button class="bg-white w-full h-[16.047vw] text-[4.651vw] mt-[0.833vw]">
                                                <h2 class="font-medium"><a href="bag.html">Add to Bag</a></h2>
                                            </button>
                                            <button
                                                class="border border-white text-white w-full h-[16.047vw] text-[4.651vw]">
                                                <div class="flex justify-center items-center gap-x-[0.8vw]">
                                                    <img src="src/assets/icons/love-icon.svg" alt=""
                                                        class="w-[6.977vw] h-[6.977vw]">
                                                    <h2 class="font-medium">Favorite</h2>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col space-y-[9.302vw] pt-[9.302vw] w-full">
                                    <div class="">
                                        <a href="javascript:void(0)" onclick="productDetails()"
                                            class="space-y-[1vw]">
                                            <div class="flex items-center justify-between">
                                                <h2 class="text-[4.651vw] font-semibold">Product Details</h2>
                                                <img id="arrowIcon9" src="src/assets/icons/arrow-icon.svg"
                                                    alt=""
                                                    class="w-[3.256vw] rotate-0 transition-transform duration-500">
                                            </div>
                                            <hr class="w-full">
                                        </a>
                                        <div class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out space-y-[4.884vw] m-0"
                                            id="ProductDetail">
                                            <div>
                                                <p class="text-[2.791vw]">Oversized Streetwear T-Shirt - "Soft Green
                                                    Oversized"</p>
                                            </div>

                                            <div>
                                                <ul id="productDetailsList" class="text-[2.791vw]">
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Color : Green</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Size : Oversized</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Material : 100% Cotton</li>
                                                </ul>
                                            </div>

                                            <div class="text-[2.791vw]">
                                                <p>Features :</p>
                                                <ul id="featuresList" class="list-disc ps-[1vw]">
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Oversized Fit: The t-shirt has a relaxed, oversized fit for a
                                                        comfortable and stylish look.</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        High-Quality Material: Made from 100% soft cotton for maximum
                                                        comfort and breathability.</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Durable Construction: The t-shirt is built to last with
                                                        double-stitched seams and a reinforced neckline.</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Eye-Catching Design: Clean green graphic and text make this
                                                        t-shirt a standout piece.</li>
                                                </ul>
                                            </div>

                                            <div class="text-[2.791vw]">
                                                <p>Care Instructions :</p>
                                                <ul id="careInstructionsList" class="list-disc ps-[1vw]">
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Machine wash cold with like colors</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Tumble dry low</li>
                                                    <li
                                                        class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                                        Do not iron directly on the graphic</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <a href="javascript:void(0)" onclick="moreInfo()" class="space-y-[1vw]">
                                            <div class="flex items-center justify-between">
                                                <h2 class="text-[4.651vw] font-semibold">More Info</h2>
                                                <img id="arrowIcon10" src="src/assets/icons/arrow-icon.svg"
                                                    alt="" class="w-[3.256vw] rotate-0">
                                            </div>
                                            <hr class="w-full">
                                        </a>
                                        <div class="space-y-[1vw] overflow-hidden max-h-0 transition-all duration-500 ease-in-out"
                                            id="moreInfo">
                                            <div>
                                                <p
                                                    class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out text-[2.791vw]">
                                                    Soft Green means something different to everyone. Let this oversized
                                                    T-shirt be the canvas for your story. Pair it with your favorite
                                                    accessories and create a unique and personal style.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Product Details -->
                            <!-- Rating & Review -->
                            <div class="flex flex-col sm:w-[22.188vw] w-[83.256vw] sm:mt-0 mt-[9.302vw]">
                                <h2 data-aos="fade-right" data-aos-duration="500" data-aos-delay="200"
                                    class="sm:text-[1.146vw] text-[4.651vw] font-semibold pb-[1.979vw]">Rating & Review
                                </h2>
                                <div class="space-y-[2vw]">
                                    <div class="flex sm:flex-row flex-col justify-between items-center">
                                        <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="250"
                                            class="flex flex-col sm:items-start items-center">
                                            <h1 class="sm:text-[3.333vw] text-[13.953vw]">4,34</h1>
                                            <div class="flex sm:space-x-[0.313vw] space-x-[1.395vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="sm:w-[0.987vw] w-[4.186vw] sm:h-[0.943vw] h-[4.186vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="sm:w-[0.987vw] w-[4.186vw] sm:h-[0.943vw] h-[4.186vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="sm:w-[0.987vw] w-[4.186vw] sm:h-[0.943vw] h-[4.186vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="sm:w-[0.987vw] w-[4.186vw] sm:h-[0.943vw] h-[4.186vw]">
                                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                                    class="sm:w-[0.987vw] w-[4.186vw] sm:h-[0.943vw] h-[4.186vw]">
                                            </div>
                                            <h2
                                                class="sm:text-[0.938vw] text-[3.256vw] font-semibold sm:pt-[1vw] pt-[4.186vw] sm:pb-0 pb-[6.512vw]">
                                                23 Reviews</h2>
                                        </div>
                                        <div class="space-y-[0.5vw]">
                                            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="300"
                                                class="flex items-center sm:space-x-[0.677vw] space-x-[6.047vw]">
                                                <div class="flex sm:space-x-[0.677vw] space-x-[3.023vw] items-center">
                                                    <img src="src/assets/icons/stars-icon.svg" alt=""
                                                        class="sm:w-[0.987vw] w-[4.419vw] sm:h-[0.943vw] h-[4.419vw]">
                                                    <p class="sm:text-[1.042vw] text-[3.721vw] font-semibold">1</p>
                                                </div>
                                                <div class="">
                                                    <div class="sm:w-[10.833vw] w-[68.605vw] sm:h-[0.938vw] h-[4.186vw] border border-white"
                                                        style="background: linear-gradient(to right, white 30%, transparent 30%);">
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="350"
                                                class="flex items-center sm:space-x-[0.677vw] space-x-[5.116vw]">
                                                <div class="flex sm:space-x-[0.677vw] space-x-[3.023vw] items-center">
                                                    <img src="src/assets/icons/stars-icon.svg" alt=""
                                                        class="sm:w-[0.987vw] w-[4.419vw] sm:h-[0.943vw] h-[4.419vw]">
                                                    <p class="sm:text-[1.042vw] text-[3.721vw] font-semibold">2</p>
                                                </div>
                                                <div class="">
                                                    <div class="sm:w-[10.833vw] w-[68.605vw] sm:h-[0.938vw] h-[4.186vw] border border-white"
                                                        style="background: linear-gradient(to right, white 55%, transparent 30%);">
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="400"
                                                class="flex items-center sm:space-x-[0.677vw] space-x-[5.116vw]">
                                                <div class="flex sm:space-x-[0.677vw] space-x-[3.023vw] items-center">
                                                    <img src="src/assets/icons/stars-icon.svg" alt=""
                                                        class="sm:w-[0.987vw] w-[4.419vw] sm:h-[0.943vw] h-[4.419vw]">
                                                    <p class="sm:text-[1.042vw] text-[3.721vw] font-semibold">3</p>
                                                </div>
                                                <div class="">
                                                    <div class="sm:w-[10.833vw] w-[68.605vw] sm:h-[0.938vw] h-[4.186vw] border border-white"
                                                        style="background: linear-gradient(to right, white 75%, transparent 30%);">
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="450"
                                                class="flex items-center sm:space-x-[0.677vw] space-x-[5.116vw]">
                                                <div class="flex sm:space-x-[0.677vw] space-x-[3.023vw] items-center">
                                                    <img src="src/assets/icons/stars-icon.svg" alt=""
                                                        class="sm:w-[0.987vw] w-[4.419vw] sm:h-[0.943vw] h-[4.419vw]">
                                                    <p class="sm:text-[1.042vw] text-[3.721vw] font-semibold">4</p>
                                                </div>
                                                <div class="">
                                                    <div class="sm:w-[10.833vw] w-[68.605vw] sm:h-[0.938vw] h-[4.186vw] border border-white"
                                                        style="background: linear-gradient(to right, white 45%, transparent 30%);">
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="500"
                                                class="flex items-center sm:space-x-[0.677vw] space-x-[5.116vw]">
                                                <div class="flex sm:space-x-[0.677vw] space-x-[3.023vw] items-center">
                                                    <img src="src/assets/icons/stars-icon.svg" alt=""
                                                        class="sm:w-[0.987vw] w-[4.419vw] sm:h-[0.943vw] h-[4.419vw]">
                                                    <p class="sm:text-[1.042vw] text-[3.721vw] font-semibold">5</p>
                                                </div>
                                                <div class="">
                                                    <div class="sm:w-[10.833vw] w-[68.605vw] sm:h-[0.938vw] h-[4.186vw] border border-white"
                                                        style="background: linear-gradient(to right, white 80%, transparent 30%);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">
                                        <h2
                                            class="font-semibold sm:text-[1.146vw] text-[4.651vw] sm:mt-0 mt-[9.302vw]">
                                            Writing Review</h2>
                                        <div
                                            class="flex items-center sm:space-x-[0.313vw] space-x-[1.395vw] sm:pt-[0.99vw] pt-[4.419vw]">
                                            <img src="src/assets/icons/outline-stars-icon.svg" alt=""
                                                class="sm:w-[1.042vw] w-[4.651vw] sm:h-[0.938vw] h-[4.651vw]">
                                            <img src="src/assets/icons/outline-stars-icon.svg" alt=""
                                                class="sm:w-[1.042vw] w-[4.651vw] sm:h-[0.938vw] h-[4.651vw]">
                                            <img src="src/assets/icons/outline-stars-icon.svg" alt=""
                                                class="sm:w-[1.042vw] w-[4.651vw] sm:h-[0.938vw] h-[4.651vw]">
                                            <img src="src/assets/icons/outline-stars-icon.svg" alt=""
                                                class="sm:w-[1.042vw] w-[4.651vw] sm:h-[0.938vw] h-[4.651vw]">
                                            <img src="src/assets/icons/outline-stars-icon.svg" alt=""
                                                class="sm:w-[1.042vw] w-[4.651vw] sm:h-[0.938vw] h-[4.651vw]">
                                        </div>
                                    </div>

                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">
                                        <h2
                                            class="font-semibold sm:text-[1.146vw] text-[4.651vw] sm:mt-0 mt-[9.302vw]">
                                            Review</h2>
                                        <div class="sm:pt-[0.99vw] pt-[4.651vw]">
                                            <textarea name=""
                                                class="bg-transparent border border-white placeholder:text-white placeholder:opacity-50 sm:text-[0.938vw] text-[2.791vw] sm:p-[1vw] p-[3.488vw] sm:w-[22.188vw] w-full sm:h-[7.552vw] h-[21.628vw]"
                                                placeholder="Write your review here..."></textarea>
                                        </div>
                                    </div>

                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="300">
                                        <h2
                                            class="font-semibold sm:text-[1.146vw] text-[4.651vw] sm:mt-0 mt-[9.302vw]">
                                            Photo or Video (Optional)</h2>
                                        <div class="flex flex-col items-center justify-center">
                                            <label for="file-upload"
                                                class="cursor-pointer flex flex-col items-center justify-center sm:w-[22.188vw] w-full sm:h-[15vw] h-[46.512vw] ">
                                                <div class="border sm:p-[0.833vw] p-[4.651vw]">
                                                    <img src="src/assets/icons/upload-icon.svg" alt=""
                                                        class="sm:w-[3.125vw] w-[13.953vw] sm:h-[3.125vw] h-[13.953vw]">
                                                </div>
                                                <span
                                                    class="text-center sm:text-[0.938vw] text-[2.791vw] sm:pt-[1.5vw] pt-[3.256vw]">Upload
                                                    your product photo</span>
                                                <input id="file-upload" type="file" class="hidden" />
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <h2 data-aos="fade-right" data-aos-duration="500" data-aos-delay="300"
                                            class="font-semibold sm:text-[1.146vw] text-[4.651vw]">Your Public Name &
                                            Email</h2>
                                        <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="350"
                                            class="sm:pt-[0.99vw] pt-[6.977vw] sm:space-y-[1.5vw] space-y-[3.256vw]">
                                            <input type="text"
                                                class="sm:w-[22.188vw] w-full sm:h-[4.219vw] h-[12.558vw] bg-transparent border border-white sm:text-[0.938vw] text-[2.791vw] sm:p-[1vw] p-[5.814vw]"
                                                placeholder="Your name">
                                            <input type="email"
                                                class="sm:w-[22.188vw] w-full sm:h-[4.219vw] h-[12.558vw] bg-transparent border border-white sm:text-[0.938vw] text-[2.791vw] sm:p-[1vw] p-[5.814vw]"
                                                placeholder="Your Email">
                                        </div>
                                        <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="400"
                                            class="sm:space-y-[1.5vw] space-y-[3.256vw] sm:mt-[2.5vw] mt-[6.977vw]">
                                            <button
                                                class="sm:w-[22.188vw] w-full sm:h-[2.604vw] h-[12.558vw] text-dark bg-white sm:text-[1.042vw] text-[3.256vw] font-medium">Submit
                                                Review</button>
                                            <button
                                                class="sm:w-[22.188vw] w-full sm:h-[2.604vw] h-[12.558vw] text-white border border-white sm:text-[1.042vw] text-[3.256vw] font-medium">Cancel
                                                Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Rating & Review -->

                            <!-- Customer Review -->
                            <div class="flex flex-col sm:w-[38.49vw] w-[83.256vw]">
                                <h2 data-aos="fade-right" data-aos-duration="500" data-aos-delay="300"
                                    class="sm:text-[1.146vw] text-[4.651vw] font-semibold pb-[1.979vw] sm:mt-0 mt-[9.302vw]">
                                    Customer Review</h2>
                                <div class="sm:space-y-[2.76vw] space-y-[9.302vw]">
                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="350"
                                        class="sm:space-y-[1vw] space-y-[2.558vw]">
                                        <div class="flex justify-between">
                                            <div class="flex space-x-[2vw]">
                                                <img src="src/assets/images/reviewer-1.png" alt=""
                                                    class="sm:w-[4.167vw] w-[17.674vw] sm:h-[4.167vw] h-[17.674vw]">
                                                <div class="grid sm:gap-y-[0.4vw] gap-y-[1.395vw]">
                                                    <h2
                                                        class="sm:text-[1.25vw] text-[3.721vw] font-medium sm:leading-none leading-none">
                                                        Rick Atsley</h2>
                                                    <div class="flex sm:space-x-[0.4vw] space-x-[0.8vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                    </div>
                                                    <h2 class="sm:text-[1vw] text-[3.256vw]">The size is a bit smaller
                                                        than the previous one</h2>
                                                </div>
                                            </div>
                                            <p
                                                class="sm:static absolute sm:text-[0.938vw] text-[2.791vw] sm:pl-0 pl-[64.419vw]">
                                                23 / 09 / 2024</p>
                                        </div>
                                        <div>
                                            <p class="sm:text-[0.938vw] text-[2.791vw]">The fabric is soft, and the fit
                                                is perfect. Love the stylish design and the color looks exactly like the
                                                picture. Great quality overall</p>
                                        </div>
                                    </div>
                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="400"
                                        class="sm:space-y-[1vw] space-y-[2.558vw]">
                                        <div class="flex justify-between">
                                            <div class="flex space-x-[1.25vw]">
                                                <img src="src/assets/images/reviewer-2.png" alt=""
                                                    class="sm:w-[4.167vw] w-[17.674vw] sm:h-[4.167vw] h-[17.674vw]">
                                                <div class="grid sm:gap-y-[0.4vw] gap-y-[1.395vw]">
                                                    <h2
                                                        class="sm:text-[1.25vw] text-[3.721vw] font-medium sm:leading-none leading-none">
                                                        Gilbert Janong</h2>
                                                    <div class="flex sm:space-x-[0.4vw] space-x-[0.8vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/outline-stars-icon.svg"
                                                            alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/outline-stars-icon.svg"
                                                            alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/outline-stars-icon.svg"
                                                            alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                    </div>
                                                    <h2 class="sm:text-[1vw] text-[3.256vw]">The size is a bit smaller
                                                        than the previous one</h2>
                                                </div>
                                            </div>
                                            <p
                                                class="sm:static absolute sm:text-[0.938vw] text-[2.791vw] sm:pl-0 pl-[64.419vw]">
                                                23 / 09 / 2024</p>
                                        </div>
                                        <div>
                                            <p class="sm:text-[0.938vw] text-[2.791vw]">The fabric is soft, and the fit
                                                is perfect. Love the stylish design and the color looks exactly like the
                                                picture. Great quality overall</p>
                                        </div>
                                    </div>
                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="450"
                                        class="sm:space-y-[1vw] space-y-[2.558vw]">
                                        <div class="flex justify-between">
                                            <div class="flex space-x-[1.25vw]">
                                                <img src="src/assets/images/reviewer-3.png" alt=""
                                                    class="sm:w-[4.167vw] w-[17.674vw] sm:h-[4.167vw] h-[17.674vw]">
                                                <div class="grid sm:gap-y-[0.4vw] gap-y-[1.395vw]">
                                                    <h2
                                                        class="sm:text-[1.25vw] text-[3.721vw] font-medium sm:leading-none leading-none">
                                                        Kevin Durant</h2>
                                                    <div class="flex sm:space-x-[0.4vw] space-x-[0.8vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/outline-stars-icon.svg"
                                                            alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                    </div>
                                                    <h2 class="sm:text-[1vw] text-[3.256vw]">The size is a bit smaller
                                                        than the previous one</h2>
                                                </div>
                                            </div>
                                            <p
                                                class="sm:static absolute sm:text-[0.938vw] text-[2.791vw] sm:pl-0 pl-[64.419vw]">
                                                23 / 09 / 2024</p>
                                        </div>
                                        <div>
                                            <p class="sm:text-[0.938vw] text-[2.791vw]">The fabric is soft, and the fit
                                                is perfect. Love the stylish design and the color looks exactly like the
                                                picture. Great quality overall</p>
                                        </div>
                                    </div>
                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="500"
                                        class="sm:space-y-[1vw] space-y-[2.558vw]">
                                        <div class="flex justify-between">
                                            <div class="flex space-x-[1.25vw]">
                                                <img src="src/assets/images/reviewer-4.png" alt=""
                                                    class="sm:w-[4.167vw] w-[17.674vw] sm:h-[4.167vw] h-[17.674vw]">
                                                <div class="grid sm:gap-y-[0.4vw] gap-y-[1.395vw]">
                                                    <h2
                                                        class="sm:text-[1.25vw] text-[3.721vw] font-medium sm:leading-none leading-none">
                                                        Lebron James</h2>
                                                    <div class="flex sm:space-x-[0.4vw] space-x-[0.8vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                    </div>
                                                    <h2 class="sm:text-[1vw] text-[3.256vw]">The size is a bit smaller
                                                        than the previous one</h2>
                                                </div>
                                            </div>
                                            <p
                                                class="sm:static absolute sm:text-[0.938vw] text-[2.791vw] sm:pl-0 pl-[64.419vw]">
                                                23 / 09 / 2024</p>
                                        </div>
                                        <div>
                                            <p class="sm:text-[0.938vw] text-[2.791vw]">The fabric is soft, and the fit
                                                is perfect. Love the stylish design and the color looks exactly like the
                                                picture. Great quality overall</p>
                                        </div>
                                    </div>
                                    <div data-aos="fade-right" data-aos-duration="500" data-aos-delay="550"
                                        class="sm:space-y-[1vw] space-y-[2.558vw]">
                                        <div class="flex justify-between">
                                            <div class="flex space-x-[1.25vw]">
                                                <img src="src/assets/images/reviewer-5.png" alt=""
                                                    class="sm:w-[4.167vw] w-[17.674vw] sm:h-[4.167vw] h-[17.674vw]">
                                                <div class="grid sm:gap-y-[0.4vw] gap-y-[1.395vw]">
                                                    <h2
                                                        class="sm:text-[1.25vw] text-[3.721vw] font-medium sm:leading-none leading-none">
                                                        Kai Cenat</h2>
                                                    <div class="flex sm:space-x-[0.4vw] space-x-[0.8vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/stars-icon.svg" alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/outline-stars-icon.svg"
                                                            alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                        <img src="src/assets/icons/outline-stars-icon.svg"
                                                            alt=""
                                                            class="sm:w-[0.987vw] w-[2.791vw] sm:h-[0.943vw] h-[2.791vw]">
                                                    </div>
                                                    <h2 class="sm:text-[1vw] text-[3.256vw]">The size is a bit smaller
                                                        than the previous one</h2>
                                                </div>
                                            </div>
                                            <p
                                                class="sm:static absolute sm:text-[0.938vw] text-[2.791vw] sm:pl-0 pl-[64.419vw]">
                                                23 / 09 / 2024</p>
                                        </div>
                                        <div>
                                            <p class="sm:text-[0.938vw] text-[2.791vw]">The fabric is soft, and the fit
                                                is perfect. Love the stylish design and the color looks exactly like the
                                                picture. Great quality overall</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Customer Review -->
                        </div>
                    </div>
                </section>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="400"
                class="w-[30vw] space-y-[3vw] sticky sm:inline hidden overflow-x-hidden overflow-y-auto max-h-[100vh] scrollbar-hide top-[1.2vw]">
                <div class="ps-[2.344vw]">
                    <div class="w-full grid gap-y-[1vw]">
                        <div class="">
                            <h2 class="text-[1.458vw] font-semibold">Soft Green Oversized</h2>
                            <p class="text-[0.938vw] opacity-60">T - Shirt</p>
                            <div class="flex gap-x-[0.4vw] pt-[0.4vw]">
                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                    class="w-[0.938vw] h-[0.938vw]">
                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                    class="w-[0.938vw] h-[0.938vw]">
                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                    class="w-[0.938vw] h-[0.938vw]">
                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                    class="w-[0.938vw] h-[0.938vw]">
                                <img src="src/assets/icons/stars-icon.svg" alt=""
                                    class="w-[0.938vw] h-[0.938vw]">
                            </div>
                        </div>
                        <div class="flex items-center space-x-[0.313vw]">
                            <h2 class="text-[1.146vw] font-medium">Rp. 175.000</h2>
                            <h2 class="text-[0.938vw] opacity-50"><s>Rp. 350.000</s></h2>
                        </div>
                    
                        <div class="">
                            <h2 class="text-[1.146vw] font-medium pb-[1vw]">Quantity</h2>
                            <div
                                class="flex items-center justify-between w-[8vw] py-[0.6vw] border border-white text-[0.938vw]">
                                <button class="text-white px-[0.6vw]" onclick="decrement1('quantity1')">-</button>
                                <span id="quantity1" class="text-white">1</span>
                                <button class="text-white px-[0.6vw]" onclick="increment1('quantity1')">+</button>
                            </div>
                        </div>
                        <div class="text-dark space-y-[1.5vw]">
                            <button class="bg-white w-[23.958vw] py-[1vw] text-[1.302vw] mt-[0.833vw]">
                                <h2 class="font-medium"><a href="bag.html">Add to Bag</h2></a>
                            </button>
                            <button class="border border-white text-white w-[23.958vw] py-[1vw] text-[1.302vw]">
                                <div class="flex justify-center items-center gap-x-[0.8vw]">
                                    <img src="src/assets/icons/love-icon.svg" alt=""
                                        class="w-[1.563vw] h-[1.302vw]">
                                    <h2 class="font-medium">Favorite</h2>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col space-y-[2vw] ps-[2.344vw] absolute w-full pb-[1.667vw]">
                    <div class="space-y-[1vw]">
                        <a href="javascript:void(0)" onclick="productDetails2()" class="space-y-[1vw]">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[1.146vw] font-semibold">Product Details</h2>
                                <img id="arrowIcon11" src="src/assets/icons/arrow-icon.svg" alt=""
                                    class="w-[0.833vw] rotate-0 transition-transform duration-500">
                            </div>
                            <hr class="w-full">
                        </a>
                        <div class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out space-y-[1vw]"
                            id="ProductDetail2">
                            <div>
                                <p class="text-[0.938vw]">Oversized Streetwear T-Shirt - "Soft Green Oversized"</p>
                            </div>

                            <div>
                                <ul id="productDetailsList2" class="text-[0.938vw] space-y-[0.5vw]">
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Color : Green</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Size : Oversized</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Material : 100% Cotton</li>
                                </ul>
                            </div>

                            <div class="text-[0.938vw]">
                                <p>Features :</p>
                                <ul class="list-disc ps-[1vw] space-y-[0.5vw]" id="featuresList2">
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Oversized Fit: The t-shirt has a relaxed, oversized fit for a comfortable and
                                        stylish look.</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        High-Quality Material: Made from 100% soft cotton for maximum comfort and
                                        breathability.</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Durable Construction: The t-shirt is built to last with double-stitched seams
                                        and a reinforced neckline.</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Eye-Catching Design: Clean green graphic and text make this t-shirt a standout
                                        piece.</li>
                                </ul>
                            </div>

                            <div class="text-[0.938vw]">
                                <p>Care Instructions :</p>
                                <ul class="list-disc ps-[1vw] space-y-[0.5vw]" id="careInstructionsList2">
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Machine wash cold with like colors</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Tumble dry low</li>
                                    <li class="opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                        Do not iron directly on the graphic</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-[1vw]">
                        <a href="javascript:void(0)" onclick="moreInfo2()" class="space-y-[1vw]">
                            <div class="flex items-center justify-between">
                                <h2 class="text-[1.146vw] font-semibold">More Info</h2>
                                <img id="arrowIcon12" src="src/assets/icons/arrow-icon.svg" alt=""
                                    class="w-[0.833vw] rotate-0 transition-transform duration-500">
                            </div>
                            <hr class="w-full">
                        </a>
                        <div class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out space-y-[1vw]"
                            id="moreInfo2">
                            <div>
                                <p
                                    class="text-[0.938vw] opacity-0 translate-y-[-100%] transition-all duration-500 ease-in-out">
                                    Soft Green means something different to everyone. Let this oversized T-shirt be the
                                    canvas for your story. Pair it with your favorite accessories and create a unique
                                    and personal style.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1
            class="absolute top-[-6vw] left-0 right-0 bottom-0 text-[13.021vw] md:text-[12.7vw] font-extrabold text-text_dark flex justify-center z-[-1] shadow__text">
            T SHIRT
        </h1>
    </section>

    <footer class="w-full sm:h-[20.052vw] h-[160.721vw] sm:mt-[4.792vw] mt-[29.302vw] bg-[#1E1F20]">
        <div
            class="grid sm:grid-cols-5 grid-cols-2 pt-[3.646vw] h-[12.052vw] text-white sm:px-[11.667vw] px-[8.372vw]">
            <div class="sm:mt-0 mt-[6.512vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="400" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">
                        Treadwear</li>
                    <li
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light">
                        <a href="location.html">Location</a></li>
                    <li
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light">
                        <a href="about.html">About Us</a></li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        Contact Us</li>
                </ul>
            </div>
            <div class="sm:mt-0 mt-[6.512vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">
                        Help</li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        FAQ</li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        Payment</li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        Privacy and Policy</li>
                </ul>
            </div>
            <div class="sm:mt-0 mt-[3.721vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="600" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">
                        Customer</li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        Voucher</li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        Order Track</li>
                </ul>
            </div>
            <div class="sm:mt-0 mt-[3.721vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="700" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">
                        Products</li>
                    <li onclick="togglePopup(true)"
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        Sale</li>
                    <li
                        class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">
                        <a href="collection.html">New Collections</a></li>
                </ul>
            </div>
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="800"
                class="sm:space-y-[0.833vw] space-y-[4.186vw] sm:w-auto w-full sm:col-span-1 col-span-2 flex flex-col sm:items-start items-center sm:mt-0 mt-[6.977vw]">
                <a href="index.html">
                    <h1 class="logo sm:text-[1.458vw] text-[4.651vw]">Treadwear.co</h1>
                </a>
                <h2 class="sm:text-[1.25vw] text-[3.186vw] leading-[2.604vw] font-semibold">Follow Us</h2>
                <div class="flex items-center sm:space-x-[1.458vw] space-x-[4.651vw]">
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 36 35"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.3657 0C21.3343 0.00524973 22.3335 0.0157492 23.1962 0.040248L23.5357 0.0524973C23.9277 0.0664966 24.3144 0.0839957 24.7816 0.104995C26.6436 0.19249 27.914 0.486476 29.0287 0.918704C30.1836 1.36318 31.1566 1.96515 32.1295 2.93635C33.0197 3.81084 33.7083 4.86908 34.1472 6.03719C34.5794 7.15189 34.8734 8.42232 34.9609 10.286C34.9819 10.7515 34.9994 11.1382 35.0134 11.5319L35.0239 11.8714C35.0501 12.7324 35.0606 13.7316 35.0641 15.7002L35.0659 17.0056V19.298C35.0701 20.5744 35.0567 21.8508 35.0256 23.1268L35.0151 23.4663C35.0011 23.86 34.9836 24.2468 34.9626 24.7123C34.8751 26.5759 34.5777 27.8446 34.1472 28.961C33.7083 30.1292 33.0197 31.1874 32.1295 32.0619C31.255 32.9521 30.1968 33.6406 29.0287 34.0795C27.914 34.5118 26.6436 34.8057 24.7816 34.8932L23.5357 34.9457L23.1962 34.9562C22.3335 34.9807 21.3343 34.993 19.3657 34.9965L18.0602 34.9982H15.7696C14.4926 35.0027 13.2156 34.9893 11.939 34.958L11.5996 34.9475C11.1842 34.9318 10.7688 34.9137 10.3536 34.8932C8.49172 34.8057 7.22128 34.5118 6.10484 34.0795C4.93735 33.6404 3.87973 32.9518 3.00575 32.0619C2.11495 31.1876 1.42577 30.1293 0.98635 28.961C0.554121 27.8463 0.260136 26.5759 0.17264 24.7123L0.120143 23.4663L0.111394 23.1268C0.0791359 21.8508 0.0645517 20.5744 0.0676457 19.298V15.7002C0.0628022 14.4238 0.0756362 13.1474 0.106144 11.8714L0.118393 11.5319C0.132393 11.1382 0.149892 10.7515 0.170891 10.286C0.258386 8.42232 0.552371 7.15364 0.984599 6.03719C1.42504 4.8686 2.11543 3.81032 3.0075 2.93635C3.88097 2.04661 4.93798 1.35806 6.10484 0.918704C7.22128 0.486476 8.48997 0.19249 10.3536 0.104995C10.8191 0.0839957 11.2076 0.0664966 11.5996 0.0524973L11.939 0.0419978C13.2151 0.0109067 14.4915 -0.00251059 15.7679 0.00174978L19.3657 0ZM17.5668 8.74956C15.2462 8.74956 13.0208 9.67138 11.3799 11.3122C9.73903 12.9531 8.8172 15.1786 8.8172 17.4991C8.8172 19.8196 9.73903 22.0451 11.3799 23.686C13.0208 25.3268 15.2462 26.2487 17.5668 26.2487C19.8873 26.2487 22.1128 25.3268 23.7536 23.686C25.3945 22.0451 26.3163 19.8196 26.3163 17.4991C26.3163 15.1786 25.3945 12.9531 23.7536 11.3122C22.1128 9.67138 19.8873 8.74956 17.5668 8.74956ZM17.5668 12.2494C18.2562 12.2493 18.9388 12.3849 19.5758 12.6487C20.2128 12.9124 20.7916 13.299 21.2791 13.7864C21.7667 14.2738 22.1535 14.8524 22.4174 15.4893C22.6814 16.1262 22.8173 16.8088 22.8174 17.4982C22.8175 18.1876 22.6818 18.8703 22.4181 19.5073C22.1544 20.1443 21.7678 20.7231 21.2804 21.2106C20.793 21.6982 20.2143 22.085 19.5774 22.3489C18.9405 22.6128 18.2579 22.7487 17.5685 22.7489C16.1762 22.7489 14.8409 22.1958 13.8564 21.2112C12.8719 20.2267 12.3188 18.8914 12.3188 17.4991C12.3188 16.1068 12.8719 14.7715 13.8564 13.787C14.8409 12.8025 16.1762 12.2494 17.5685 12.2494M26.7555 6.12469C26.1754 6.12469 25.619 6.35515 25.2088 6.76536C24.7986 7.17558 24.5682 7.73195 24.5682 8.31208C24.5682 8.89221 24.7986 9.44858 25.2088 9.8588C25.619 10.269 26.1754 10.4995 26.7555 10.4995C27.3357 10.4995 27.8921 10.269 28.3023 9.8588C28.7125 9.44858 28.9429 8.89221 28.9429 8.31208C28.9429 7.73195 28.7125 7.17558 28.3023 6.76536C27.8921 6.35515 27.3357 6.12469 26.7555 6.12469Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 36 35"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M35.0667 17.5C35.0667 7.84 27.2267 0 17.5667 0C7.90665 0 0.0666504 7.84 0.0666504 17.5C0.0666504 25.97 6.08665 33.0225 14.0667 34.65V22.75H10.5667V17.5H14.0667V13.125C14.0667 9.7475 16.8141 7 20.1917 7H24.5667V12.25H21.0667C20.1042 12.25 19.3167 13.0375 19.3167 14V17.5H24.5667V22.75H19.3167V34.9125C28.1542 34.0375 35.0667 26.5825 35.0667 17.5Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 39 32"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M19.0667 0C20.6912 0 22.3574 0.0418002 23.9724 0.1102L25.8801 0.2014L27.706 0.3097L29.416 0.4256L30.9777 0.5472C32.6729 0.676194 34.2682 1.39922 35.4826 2.58894C36.697 3.77866 37.4526 5.35875 37.6164 7.0509L37.6923 7.8584L37.8349 9.5874C37.9679 11.3791 38.0666 13.3323 38.0666 15.2C38.0666 17.0677 37.9679 19.0209 37.8349 20.8126L37.6923 22.5416L37.6164 23.3491C37.4525 25.0415 36.6966 26.6219 35.4818 27.8116C34.2671 29.0014 32.6713 29.7242 30.9758 29.8528L29.4178 29.9725L27.7079 30.0903L25.8801 30.1986L23.9724 30.2898C22.3381 30.3606 20.7025 30.3973 19.0667 30.4C17.4308 30.3973 15.7952 30.3606 14.1609 30.2898L12.2532 30.1986L10.4274 30.0903L8.71735 29.9725L7.15555 29.8528C5.4604 29.7238 3.86513 29.0008 2.65073 27.8111C1.43634 26.6213 0.680713 25.0412 0.51695 23.3491L0.44095 22.5416L0.29845 20.8126C0.153733 18.9451 0.0764157 17.073 0.0666504 15.2C0.0666504 13.3323 0.16545 11.3791 0.29845 9.5874L0.44095 7.8584L0.51695 7.0509C0.680649 5.35905 1.436 3.7792 2.65001 2.58952C3.86402 1.39984 5.45883 0.676621 7.15365 0.5472L8.71355 0.4256L10.4236 0.3097L12.2514 0.2014L14.1589 0.1102C15.7939 0.0393817 17.4302 0.0026402 19.0667 0ZM15.2667 10.5925V19.8075C15.2667 20.6853 16.2166 21.2325 16.9766 20.7955L24.9567 16.188C25.1303 16.088 25.2745 15.9441 25.3748 15.7706C25.4751 15.5972 25.5279 15.4004 25.5279 15.2C25.5279 14.9996 25.4751 14.8028 25.3748 14.6294C25.2745 14.4559 25.1303 14.312 24.9567 14.212L16.9766 9.6064C16.8033 9.50631 16.6066 9.45364 16.4065 9.45367C16.2063 9.4537 16.0097 9.50644 15.8363 9.60658C15.663 9.70672 15.5191 9.85074 15.4191 10.0241C15.3191 10.1975 15.2665 10.3942 15.2667 10.5944V10.5925Z"
                                fill="white" />
                        </svg>
                    </a>
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 31 35"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23.8677 5.39541C22.5601 3.90216 21.8394 1.98482 21.8396 0H15.9276V23.7245C15.883 25.0087 15.3412 26.2253 14.4167 27.1177C13.4922 28.01 12.2572 28.5084 10.9723 28.5077C8.25543 28.5077 5.99777 26.2883 5.99777 23.5332C5.99777 20.2423 9.17379 17.7742 12.4455 18.7883V12.7423C5.84471 11.8622 0.0666504 16.9898 0.0666504 23.5332C0.0666504 29.9043 5.34726 34.4388 10.9531 34.4388C16.9608 34.4388 21.8396 29.5599 21.8396 23.5332V11.4987C24.2369 13.2204 27.1152 14.1441 30.0667 14.139V8.22704C30.0667 8.22704 26.4697 8.39923 23.8677 5.39541Z"
                                fill="white" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
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
    <script>
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
</body>

</html>
