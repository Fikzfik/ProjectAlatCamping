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
    <title>Location</title>
</head>

<body id="body" class="text-white relative">
    @include('pages.layout.nav');

    <section class="sm:px-[4.271vw] px-[8.372vw]" data-aos="fade-up" data-aos-duration="500" data-aos-delay="450">
        <div class="mapouter relative text-right sm:h-[34.438rem] h-[56.744vw] w-full mt-[4vw]">
            <div class="gmap_canvas overflow-hidden bg-none h-full w-full">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1179.0071355660243!2d106.64427682041833!3d-6.3042360406827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb4cdb86c07b%3A0xcdf5c0a3abb8a5b1!2sCinema%20XXI!5e0!3m2!1sen!2sid!4v1728871110414!5m2!1sen!2sid"
                    class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <section class="sm:px-[4.271vw] px-[8.372vw] sm:mt-[5vw] mt-[8.837vw] pb-[1vw] space-y-[5vw] relative">
        <div>
            <div class="flex flex-col items-center">
                <!-- Flexbox untuk menempatkan elemen secara vertikal dan sejajar di tengah -->
                <h1 class="sm:text-[3.333vw] text-[5.581vw] text-center sm:mb-[2vw] mb-[8.837vw]" data-aos="fade-up"
                    data-aos-duration="500" data-aos-delay="500">FIND A STORE</h1>
                <div
                    class="flex items-center sm:w-[16.25vw] w-[65.581vw] sm:h-[2.917vw] h-[13.023vw] sm:pl-[1.042vw] pl-[3.721vw] bg-transparent border border-white aos-init aos-animate">
                    <svg viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="sm:w-[1vw] w-[3.721vw] sm:h-[1vw] h-[3.721vw] hover:cursor-pointer">
                        <path
                            d="M16.031 14.617L20.314 18.899L18.899 20.314L14.617 16.031C13.0237 17.3082 11.042 18.0029 9 18C4.032 18 0 13.968 0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18.0029 11.042 17.3082 13.0237 16.031 14.617ZM14.025 13.875C15.2938 12.5697 16.0025 10.8204 16 9C16 5.133 12.867 2 9 2C5.133 2 2 5.133 2 9C2 12.867 5.133 16 9 16C10.8204 16.0025 12.5697 15.2938 13.875 14.025L14.025 13.875Z"
                            fill="#FFF"></path>
                    </svg>
                    <input type="text" placeholder="Search"
                        class="w-full sm:pl-[0.521vw] pl-[2.326vw] pr-[1.302vw] text-white sm:text-[0.938vw] text-[4.186vw] placeholder-white focus:outline-none bg-transparent">
                </div>
            </div>
        </div>

        <div class="grid sm:grid-cols-3 grid-cols-1 gap-x-[1vw] sm:gap-y-[2vw] gap-y-[4.651vw]">

            <div
                class="flex justify-center items-center bg-text_dark w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">
                <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                    <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">Armada Town Square</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw]">2nd Floor Pop Up Unit - Jl. Jkt Garden City Boulevard
                        No.1, RT.8/RW.6, Cakung Tim., Kec. Cakung, East Jakarta City, Special Capital Region of Jakarta
                        13910</p>
                    <div class="">
                        <a href="" class="sm:text-[0.938vw] text-[2.791vw]">View on Map <span class="arrow"> -->
                            </span></a>
                    </div>
                </div>
            </div>

            <div
                class="flex justify-center items-center bg-text_dark w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">
                <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                    <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">Iron Mall</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw]">2nd Floor Pop Up Unit - Jl. Jkt Garden City Boulevard
                        No.1, RT.8/RW.6, Cakung Tim., Kec. Cakung, East Jakarta City, Special Capital Region of Jakarta
                        13910</p>
                    <div class="">
                        <a href="" class="sm:text-[0.938vw] text-[2.791vw]">View on Map <span class="arrow"> -->
                            </span></a>
                    </div>
                </div>
            </div>

            <div
                class="flex justify-center items-center bg-text_dark w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">
                <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                    <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">lol City Mall</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw]">2nd Floor Pop Up Unit - Jl. Jkt Garden City Boulevard
                        No.1, RT.8/RW.6, Cakung Tim., Kec. Cakung, East Jakarta City, Special Capital Region of Jakarta
                        13910</p>
                    <div class="">
                        <a href="" class="sm:text-[0.938vw] text-[2.791vw]">View on Map <span class="arrow"> -->
                            </span></a>
                    </div>
                </div>
            </div>

            <div
                class="flex justify-center items-center bg-text_dark w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">
                <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                    <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">The SM Mall Of Asia</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw]">2nd Floor Pop Up Unit - Jl. Jkt Garden City Boulevard
                        No.1, RT.8/RW.6, Cakung Tim., Kec. Cakung, East Jakarta City, Special Capital Region of Jakarta
                        13910</p>
                    <div class="">
                        <a href="" class="sm:text-[0.938vw] text-[2.791vw]">View on Map <span class="arrow"> -->
                            </span></a>
                    </div>
                </div>
            </div>

            <div
                class="flex justify-center items-center bg-text_dark w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">
                <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                    <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">SM Tianjing, China</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw]">2nd Floor Pop Up Unit - Jl. Jkt Garden City Boulevard
                        No.1, RT.8/RW.6, Cakung Tim., Kec. Cakung, East Jakarta City, Special Capital Region of Jakarta
                        13910</p>
                    <div class="">
                        <a href="" class="sm:text-[0.938vw] text-[2.791vw]">View on Map <span class="arrow"> -->
                            </span></a>
                    </div>
                </div>
            </div>

            <div
                class="flex justify-center items-center bg-text_dark w-full sm:py-[2vw] py-[4.884vw] sm:px-[1.5vw] px-[4.884vw]">
                <div class="sm:space-y-[1vw] space-y-[3.488vw]">
                    <h2 class="font-semibold sm:text-[1.25vw] text-[5.581vw]">Central WestGate</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw]">2nd Floor Pop Up Unit - Jl. Jkt Garden City Boulevard
                        No.1, RT.8/RW.6, Cakung Tim., Kec. Cakung, East Jakarta City, Special Capital Region of Jakarta
                        13910</p>
                    <div class="">
                        <a href="" class="sm:text-[0.938vw] text-[2.791vw]">View on Map <span class="arrow"> -->
                            </span></a>
                    </div>
                </div>
            </div>
        </div>
        <h2
            class="absolute sm:top-[-12vw] top-[-10vw] left-0 right-0 bottom-0 text-[13.021vw] md:text-[12.7vw] font-extrabold text-text_dark flex justify-center z-[-1] shadow__text">
            LOCATION
        </h2>
    </section>
    @include('pages.layout.footer')
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
