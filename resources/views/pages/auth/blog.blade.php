<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Blog</title>
</head>

<body id="body" class="relative">
    <div class="absolute inset-0 -z-20"
        style="background-image: url('{{ asset('src/assets/images/bgwebsite.jpeg') }}'); 
           background-size: cover; 
           background-position: center; 
           filter: blur(10px); 
           opacity: 0.5;">
        <!-- Mengurangi opacity -->
    </div>
    @include('pages.layout.nav')
    <section class="sm:px-[4.271vw] px-[8.372vw] relative pb-[1vw] mt-[5.625vw]">
        <h1 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none">BLOGS</h1>
        <div
            class="grid sm:grid-cols-3 grid-cols-1 sm:gap-x-[1vw] gap-x-0 sm:gap-y-[4vw] gap-y-[9.302vw] sm:mt-[2.5vw] mt-[9.302vw]">
            <div class="flex items-center">
                <a class="w-full" href="detailBlog.html">
                    <div class="" data-aos="fade-up" data-aos-duration="500" data-aos-delay="350">
                        <div class="overflow-hidden">
                            <img src="assets/images/detailblog-1.png" alt=""
                                class="w-full sm:h-[22.083vw] h-[98.605vw] object-cover object-center transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="w-full sm:space-y-[0.5vw] space-y-[2.581vw] sm:pt-[1vw] pt-[6.279vw]">
                            <h2 class="w-full font-semibold sm:text-[1.25vw] text-[18px] truncate">Treadwear at
                                Jakarta
                                Fashion Expo 2024</h2>
                            <p class="sm:text-[0.938vw] text-[3.721vw]">23 / 09 / 2024</p>
                            <p class="sm:text-[0.938vw] text-[2.791vw] sm:text-left text-justify pt-0">The treadwear
                                event held at the Jakarta Expo invited various designers to evaluate treadwear
                                designs.
                                This event was held to enliven treadwear's birthday...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <a class="w-full" href="detailBlog.html">
                    <div class="" data-aos="fade-up" data-aos-duration="500" data-aos-delay="400">
                        <div class="overflow-hidden">
                            <img src="assets/images/detailblog-2.png" alt=""
                                class="w-full sm:h-[22.083vw] h-[98.605vw] object-cover object-center transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="w-full sm:space-y-[0.5vw] space-y-[2.581vw] sm:pt-[1vw] pt-[6.279vw]">
                            <h2 class="w-full font-semibold sm:text-[1.25vw] text-[18px] truncate">Look at the
                                Treadwear Hoodie Design</h2>
                            <p class="sm:text-[0.938vw] text-[3.721vw]">23 / 09 / 2024</p>
                            <p class="sm:text-[0.938vw] text-[2.791vw] sm:text-left text-justify pt-0">The treadwear
                                event held at the Jakarta Expo invited various designers to evaluate treadwear
                                designs.
                                This event was held to enliven treadwear's birthday...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <a class="w-full" href="detailBlog.html">
                    <div class="" data-aos="fade-up" data-aos-duration="500" data-aos-delay="450">
                        <div class="overflow-hidden">
                            <img src="assets/images/detailblog-3.png" alt=""
                                class="w-full sm:h-[22.083vw] h-[98.605vw] object-cover object-center transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="w-full sm:space-y-[0.5vw] space-y-[2.581vw] sm:pt-[1vw] pt-[6.279vw]">
                            <h2 class="w-full font-semibold sm:text-[1.25vw] text-[18px] truncate">New 3 Variant
                                Longs
                                Sleeve’s Hoodie</h2>
                            <p class="sm:text-[0.938vw] text-[3.721vw]">23 / 09 / 2024</p>
                            <p class="sm:text-[0.938vw] text-[2.791vw] sm:text-left text-justify pt-0">The treadwear
                                event held at the Jakarta Expo invited various designers to evaluate treadwear
                                designs.
                                This event was held to enliven treadwear's birthday...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <a class="w-full" href="detailBlog.html">
                    <div class="" data-aos="fade-up" data-aos-duration="500" data-aos-delay="500">
                        <div class="overflow-hidden">
                            <img src="assets/images/detailblog-4.png" alt=""
                                class="w-full sm:h-[22.083vw] h-[98.605vw] object-cover object-center transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="w-full sm:space-y-[0.5vw] space-y-[2.581vw] sm:pt-[1vw] pt-[6.279vw]">
                            <h2 class="w-full font-semibold sm:text-[1.25vw] text-[18px] truncate">4R Treadwear
                                Campaign</h2>
                            <p class="sm:text-[0.938vw] text-[3.721vw]">23 / 09 / 2024</p>
                            <p class="sm:text-[0.938vw] text-[2.791vw] sm:text-left text-justify pt-0">The treadwear
                                event held at the Jakarta Expo invited various designers to evaluate treadwear
                                designs.
                                This event was held to enliven treadwear's birthday...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <a class="w-full" href="detailBlog.html">
                    <div class="" data-aos="fade-up" data-aos-duration="500" data-aos-delay="550">
                        <div class="overflow-hidden">
                            <img src="assets/images/detailblog-5.png" alt=""
                                class="w-full sm:h-[22.083vw] h-[98.605vw] object-cover object-center transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="w-full sm:space-y-[0.5vw] space-y-[2.581vw] sm:pt-[1vw] pt-[6.279vw]">
                            <h2 class="w-full font-semibold sm:text-[1.25vw] text-[18px] truncate">Opening of
                                Official
                                Stores in Indonesia</h2>
                            <p class="sm:text-[0.938vw] text-[3.721vw]">23 / 09 / 2024</p>
                            <p class="sm:text-[0.938vw] text-[2.791vw] sm:text-left text-justify pt-0">The treadwear
                                event held at the Jakarta Expo invited various designers to evaluate treadwear
                                designs.
                                This event was held to enliven treadwear's birthday...</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <a class="w-full" href="detailBlog.html">
                    <div class="" data-aos="fade-up" data-aos-duration="500" data-aos-delay="600">
                        <div class="overflow-hidden">
                            <img src="assets/images/detailblog-6.png" alt=""
                                class="w-full sm:h-[22.083vw] h-[98.605vw] object-cover object-center transform transition-transform duration-300 ease-in-out hover:scale-110">
                        </div>
                        <div class="w-full sm:space-y-[0.5vw] space-y-[2.581vw] sm:pt-[1vw] pt-[6.279vw]">
                            <h2 class="w-full font-semibold sm:text-[1.25vw] text-[18px] truncate">Coming Soon New
                                Hoodie Edition</h2>
                            <p class="sm:text-[0.938vw] text-[3.721vw]">23 / 09 / 2024</p>
                            <p class="sm:text-[0.938vw] text-[2.791vw] sm:text-left text-justify pt-0">The treadwear
                                event held at the Jakarta Expo invited various designers to evaluate treadwear
                                designs.
                                This event was held to enliven treadwear's birthday...</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <h1
            class="absolute top-[-6vw] left-0 right-0 bottom-0 text-[16.279vw] sm:text-[12.7vw] font-extrabold text-text_dark flex justify-center z-[-1] shadow__text">
            BLOG
        </h1>
    </section>
    @include('pages.layout.footer')
</body>
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
<script src="./js/main.js"></script>
<script>
    AOS.init();
</script>
@include('pages.layout.script');

</html>
