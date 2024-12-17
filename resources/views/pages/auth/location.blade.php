<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Location</title>
</head>

<body id="body" class="relative">
    <!-- Background Blur -->
    <div class="absolute inset-0 -z-10"
        style="background-image: url('{{ asset('src/assets/images/bgwebsite.jpeg') }}'); 
               background-size: cover; 
               background-position: center; 
               filter: blur(10px); ">
    </div>

    @include('pages.layout.nav')

    <section class="sm:px-[4.271vw] px-[8.372vw]" data-aos="fade-up" data-aos-duration="500" data-aos-delay="450">
        <div class="mapouter relative text-right sm:h-[34.438rem] h-[56.744vw] w-full mt-[4vw]" style="z-index: 1;">
            <div class="gmap_canvas overflow-hidden bg-none h-full w-full">
                <iframe src="https://www.google.com/maps/embed?pb=..." class="w-full h-full" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <section class="sm:px-[4.271vw] px-[8.372vw] sm:mt-[5vw] mt-[8.837vw] pb-[1vw] space-y-[5vw] relative"
        style="z-index: 1;">

        <div class="grid sm:grid-cols-3 grid-cols-1 gap-x-[1vw] sm:gap-y-[2vw] gap-y-[4.651vw]">
            <!-- Store Entries -->
            @foreach ($stores as $store)
                <div
                    class="flex justify-center items-center bg-white w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">

                    <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                        <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">{{ $store->name }}</h2>
                        <p class="sm:text-[0.938vw] text-[2.791vw]">{{ $store->address }}</p>
                        <div class="">
                            <a href="https://www.google.com/maps?q={{ $store->latitude }},{{ $store->longitude }}"
                                class="sm:text-[0.938vw] text-[2.791vw]" target="_blank">View on Map <span
                                    class="arrow"> --> </span></a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>


    </section>

    @include('pages.layout.footer')

    <div id="popup" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden"
        onclick="togglePopup(false)">
        <div class="bg-black flex flex-col items-center p-6 rounded-lg shadow-lg sm:w-[20.833vw] w-[69.767vw]"
            onclick="event.stopPropagation()">
            <img src="assets/icons/gear-512.png" alt=""
                class="sm:w-[5.208vw] w-[23.256vw] animate-[spin_5s_linear_infinite]">
            <h2 class="text-white text-[4.651vw] text-center sm:text-[1.042vw] font-bold mb-4">This feature is under
                development now</h2>
            <p class="text-white sm:text-[0.729vw] text-[3.256vw] mb-4">Sorry for the inconvenience</p>
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
    @include('pages.layout.script')

</body>

</html>
