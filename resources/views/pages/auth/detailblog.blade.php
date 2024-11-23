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
    <title>Detail Blog</title>
</head>
<body id="body" class="text-white relative">
    <div id="nav" class="w-[100vw] h-[216.744vw] overflow-x-hidden z-30 fixed pointer-events-none sm:hidden inline">
        <div id="sidebar" class="absolute right-0 bg-white w-[100vw] h-[216.744vw] px-[8.372vw] slide-out-left-active">
            <button id="cross" class="mt-[9.767vw]"><img src="assets/icons/close-icon.svg" alt=""></button>
            <h1 class="text-black text-[4.651vw] text-center logo">Treadwear.co</h1>
            <ul class="flex flex-col gap-[7.442vw] text-black font-semibold text-[4.186vw] mt-[4.884vw]">
                <li><a href="collection.html">Collection</li></a>
                <li><a href="dashboard.html">Product</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="location.html">Store Location</a></li>
            </ul>
        </div>
    </div>
    <nav class="flex justify-between items-center sm:pt-[2.323vw] pt-[9.302vw] sm:px-[4.271vw] px-[8.372vw] sm:mb-0 mb-[6.302vw]">
        <div class="sm:inline hidden">
            <ul class="text-[0.938vw] text-white flex space-x-[1.615vw]">
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="200"><a href="collection.html">Collection</a></li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="300"><a href="dashboard.html">Product</a></li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="400"><a href="blog.html">Blog</a></li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="500"><a href="location.html">Store Location</a></li>
            </ul>
        </div>
        <div class="flex">
            <button data-aos="fade-right" data-aos-duration="500" data-aos-delay="300" id="hamburger" class="sm:hidden inline"><img src="assets/icons/hamburger.svg" alt=""></button>
            <h1 data-aos="fade-up" data-aos-duration="500" data-aos-delay="200" class="text-white sm:text-[1.667vw] text-[3.721vw] logo sm:ml-0 ml-[4.884vw]">Treadwear.co</h1>
        </div>
        <div class="flex items-center sm:space-x-[1.875vw] space-x-[3.721vw]">
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="400" class="sm:flex hidden items-center w-[16.25vw] h-[2.917vw] pl-[1.042vw] bg-transparent border border-white ">
                <svg viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[1vw] h-[1vw] hover:cursor-pointer">
                    <path d="M16.031 14.617L20.314 18.899L18.899 20.314L14.617 16.031C13.0237 17.3082 11.042 18.0029 9 18C4.032 18 0 13.968 0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18.0029 11.042 17.3082 13.0237 16.031 14.617ZM14.025 13.875C15.2938 12.5697 16.0025 10.8204 16 9C16 5.133 12.867 2 9 2C5.133 2 2 5.133 2 9C2 12.867 5.133 16 9 16C10.8204 16.0025 12.5697 15.2938 13.875 14.025L14.025 13.875Z" fill="#FFF"/>
                </svg>
                <input type="text" placeholder="Search" class="w-full pl-[0.521vw] pr-[1.302vw] text-white text-[0.938vw] placeholder-white focus:outline-none bg-transparent" />
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="350" class="sm:hidden block">
                <button href="" onclick="searching()">
                    <img src="assets/icons/search-white.svg" alt="" class="sm:w-[2.083vw] w-[4.651vw]">
                </button>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="350">
                <button>
                    <a href="bag.html">
                        <img src="assets/icons/bag-icon.svg" alt="" class="sm:w-[2.083vw] w-[4.651vw]">
                    </a>
                </button>
            </div>
            <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="300">
                <button>
                    <a href="login.html">
                        <img src="assets/icons/profile-icon.svg" alt="" class="sm:w-[2.083vw] w-[4.651vw]">
                    </a>
                </button>
            </div>
        </div>  
    </nav>
    <div class="sm:hidden block px-[8.372vw] mb-[6.302vw]">
        <div id="searchBar" class="sm:hidden hidden items-center sm:w-[16.25vw] w-[83.256vw] sm:h-[2.917vw] h-[13.023vw] sm:pl-[1.042vw] pl-[4.651vw] bg-transparent border border-white ">
            <button><img src="assets/icons/search-white.svg" alt="" class="w-[3.721vw]"></button>
            <input type="text" placeholder="Search" class="w-full pl-[0.521vw] pr-[1.302vw] text-white text-[4.186vw] placeholder-white focus:outline-none bg-transparent ml-[2.326vw]" />
        </div>  
    </div>  
    <div class="sm:px-[4.271vw] px-[8.372vw] pt-[2.604vw]">
        <div class="text-white text-[0.938vw] flex sm:flex-row flex-col justify-between">
            <ul class="sm:text-[0.938vw] w-full text-[12px] space-x-[0.417vw] flex">
                <li><a data-aos="fade-right" data-aos-duration="500" data-aos-delay="200" href="index.html">Home</a></li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">/</li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="300"><a href="blog.html">Blog</a></li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="200">/</li>
                <li data-aos="fade-right" data-aos-duration="500" data-aos-delay="300"><a href="">Treadwear at Jakarta Fashion Expo 2024</a></li>
            </ul>
        </div>
    </div>

    <section class="sm:px-[12.813vw] px-[8.372vw] sm:mt-[5vw] mt-[19.767vw] relative">
        <div>
            <img src="assets/images/detailblog-1.png" alt="" class="w-full sm:h-[35.885vw] h-[98.605vw] object-cover object-center">
            <div class="sm:mt-[3.073vw] mt-[7.442vw] sm:space-y-[3vw] space-y-[7.442vw]">
                <h2 class="font-bold sm:text-[2.083vw] text-[6.977vw]">Treadwear at Jakarta Fashion Expo 2024</h2>
                <div class="sm:space-y-[1vw] space-y-[7.442vw]">
                    <h2 class="font-medium sm:text-[1.25vw] text-[4.651vw]">Exciting Treadwear Design Exhibition at Jakarta Expo
                    </h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw] sm:leading-normal leading-[5.814vw]">The treadwear design exhibition held at the Jakarta Expo succeeded in attracting the attention of various well-known designers. They gather in one place to showcase innovative works and evaluate the latest trends in the world of treadwear design. This event is not only a competition event, but also a celebration of designers' unlimited creativity.
                    </p>
                </div>
                
                <div class="sm:space-y-[1vw] space-y-[7.442vw]">
                    <h2 class="font-medium sm:text-[1.25vw] text-[4.651vw]">Vibrant Treadwear Birthday
                    </h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw] sm:leading-normal leading-[5.814vw]">Apart from being a design competition, this event was also held to celebrate treadwear's birthday. Various interesting activities such as fashion shows, workshops and work exhibitions are prepared to enliven the celebration. Visitors are invited to learn more about the history and development of treadwear over time. One of the main attractions of this event is the fashion show which displays the works of selected designers. Models confidently strutted down the catwalk, showing off unique and stylish treadwear designs. Starting from classic designs to futuristic ones, everything is presented in a stunning fashion show. Apart from the fashion show, this event also provides workshops guided by experts in the field of treadwear design. Workshop participants have the opportunity to learn the latest techniques and exchange ideas with fellow designers. Meanwhile, the work exhibition provides an opportunity for visitors to take a closer look at the designer's works and gain inspiration.</p>
                </div>
                
                <div class="sm:space-y-[1vw] space-y-[7.442vw]">
                    <h2 class="font-medium sm:text-[1.25vw] text-[4.651vw]">Successful Treadwear Design Exhibition Event</h2>
                    <p class="sm:text-[0.938vw] text-[2.791vw] sm:leading-normal leading-[5.814vw]">Overall, the treadwear design exhibition at the Jakarta Expo could be said to be a great success. This event not only succeeded in bringing together talented designers, but also provided inspiration for the wider community. Hopefully events like this can continue to be held in the future to encourage the development of the treadwear design industry in Indonesia.</p>
                </div>

                <div class="text-center">
                    <p><a href="blog.html" class="sm:text-[1.042vw] lg:text-[1.25vw]"><span class="arrow"><-- </span><span class="underline">Back to Blogs</span></a></p>
                </div>
            </div>
        </div>
        <h1 class="absolute sm:top-[-10vw] top-[-18vw] left-0 right-0 bottom-0 text-[13.021vw] md:text-[12.7vw] font-extrabold text-text_dark flex justify-center z-[-1] shadow__text">
            BLOG
        </h1>
    </section>

    <footer class="w-full sm:h-[20.052vw] h-[160.721vw] sm:mt-[4.792vw] mt-[29.302vw] bg-[#1E1F20]">
        <div class="grid sm:grid-cols-5 grid-cols-2 pt-[3.646vw] h-[12.052vw] text-white sm:px-[11.667vw] px-[8.372vw]">
            <div class="sm:mt-0 mt-[6.512vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="400" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">Treadwear</li>
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light"><a href="location.html">Location</a></li>
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light"><a href="about.html">About Us</a></li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">Contact Us</li>
                </ul>
            </div>
            <div class="sm:mt-0 mt-[6.512vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">Help</li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">FAQ</li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">Payment</li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">Privacy and Policy</li>
                </ul>
            </div>
            <div class="sm:mt-0 mt-[3.721vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="600" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">Customer</li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">Voucher</li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">Order Track</li>
                </ul>
            </div>
            <div class="sm:mt-0 mt-[3.721vw]">
                <ul data-aos="fade-up" data-aos-duration="500" data-aos-delay="700" class="space-y-[0.521vw]">
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] font-semibold">Products</li>
                    <li onclick="togglePopup(true)" class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer">Sale</li>
                    <li class="sm:text-[1.042vw] text-[3.686vw] sm:leading-[2.188vw] leading-[9.628vw] sm:font-normal font-light cursor-pointer"><a href="collection.html">New Collections</a></li>
                </ul>
            </div>
            <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="800" class="sm:space-y-[0.833vw] space-y-[4.186vw] sm:w-auto w-full sm:col-span-1 col-span-2 flex flex-col sm:items-start items-center sm:mt-0 mt-[6.977vw]">
                <a href="index.html"><h1 class="logo sm:text-[1.458vw] text-[4.651vw]">Treadwear.co</h1></a>
                <h2 class="sm:text-[1.25vw] text-[3.186vw] leading-[2.604vw] font-semibold">Follow Us</h2>
                <div class="flex items-center sm:space-x-[1.458vw] space-x-[4.651vw]">
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.3657 0C21.3343 0.00524973 22.3335 0.0157492 23.1962 0.040248L23.5357 0.0524973C23.9277 0.0664966 24.3144 0.0839957 24.7816 0.104995C26.6436 0.19249 27.914 0.486476 29.0287 0.918704C30.1836 1.36318 31.1566 1.96515 32.1295 2.93635C33.0197 3.81084 33.7083 4.86908 34.1472 6.03719C34.5794 7.15189 34.8734 8.42232 34.9609 10.286C34.9819 10.7515 34.9994 11.1382 35.0134 11.5319L35.0239 11.8714C35.0501 12.7324 35.0606 13.7316 35.0641 15.7002L35.0659 17.0056V19.298C35.0701 20.5744 35.0567 21.8508 35.0256 23.1268L35.0151 23.4663C35.0011 23.86 34.9836 24.2468 34.9626 24.7123C34.8751 26.5759 34.5777 27.8446 34.1472 28.961C33.7083 30.1292 33.0197 31.1874 32.1295 32.0619C31.255 32.9521 30.1968 33.6406 29.0287 34.0795C27.914 34.5118 26.6436 34.8057 24.7816 34.8932L23.5357 34.9457L23.1962 34.9562C22.3335 34.9807 21.3343 34.993 19.3657 34.9965L18.0602 34.9982H15.7696C14.4926 35.0027 13.2156 34.9893 11.939 34.958L11.5996 34.9475C11.1842 34.9318 10.7688 34.9137 10.3536 34.8932C8.49172 34.8057 7.22128 34.5118 6.10484 34.0795C4.93735 33.6404 3.87973 32.9518 3.00575 32.0619C2.11495 31.1876 1.42577 30.1293 0.98635 28.961C0.554121 27.8463 0.260136 26.5759 0.17264 24.7123L0.120143 23.4663L0.111394 23.1268C0.0791359 21.8508 0.0645517 20.5744 0.0676457 19.298V15.7002C0.0628022 14.4238 0.0756362 13.1474 0.106144 11.8714L0.118393 11.5319C0.132393 11.1382 0.149892 10.7515 0.170891 10.286C0.258386 8.42232 0.552371 7.15364 0.984599 6.03719C1.42504 4.8686 2.11543 3.81032 3.0075 2.93635C3.88097 2.04661 4.93798 1.35806 6.10484 0.918704C7.22128 0.486476 8.48997 0.19249 10.3536 0.104995C10.8191 0.0839957 11.2076 0.0664966 11.5996 0.0524973L11.939 0.0419978C13.2151 0.0109067 14.4915 -0.00251059 15.7679 0.00174978L19.3657 0ZM17.5668 8.74956C15.2462 8.74956 13.0208 9.67138 11.3799 11.3122C9.73903 12.9531 8.8172 15.1786 8.8172 17.4991C8.8172 19.8196 9.73903 22.0451 11.3799 23.686C13.0208 25.3268 15.2462 26.2487 17.5668 26.2487C19.8873 26.2487 22.1128 25.3268 23.7536 23.686C25.3945 22.0451 26.3163 19.8196 26.3163 17.4991C26.3163 15.1786 25.3945 12.9531 23.7536 11.3122C22.1128 9.67138 19.8873 8.74956 17.5668 8.74956ZM17.5668 12.2494C18.2562 12.2493 18.9388 12.3849 19.5758 12.6487C20.2128 12.9124 20.7916 13.299 21.2791 13.7864C21.7667 14.2738 22.1535 14.8524 22.4174 15.4893C22.6814 16.1262 22.8173 16.8088 22.8174 17.4982C22.8175 18.1876 22.6818 18.8703 22.4181 19.5073C22.1544 20.1443 21.7678 20.7231 21.2804 21.2106C20.793 21.6982 20.2143 22.085 19.5774 22.3489C18.9405 22.6128 18.2579 22.7487 17.5685 22.7489C16.1762 22.7489 14.8409 22.1958 13.8564 21.2112C12.8719 20.2267 12.3188 18.8914 12.3188 17.4991C12.3188 16.1068 12.8719 14.7715 13.8564 13.787C14.8409 12.8025 16.1762 12.2494 17.5685 12.2494M26.7555 6.12469C26.1754 6.12469 25.619 6.35515 25.2088 6.76536C24.7986 7.17558 24.5682 7.73195 24.5682 8.31208C24.5682 8.89221 24.7986 9.44858 25.2088 9.8588C25.619 10.269 26.1754 10.4995 26.7555 10.4995C27.3357 10.4995 27.8921 10.269 28.3023 9.8588C28.7125 9.44858 28.9429 8.89221 28.9429 8.31208C28.9429 7.73195 28.7125 7.17558 28.3023 6.76536C27.8921 6.35515 27.3357 6.12469 26.7555 6.12469Z" fill="white"/>
                        </svg>
                    </a>
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 36 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M35.0667 17.5C35.0667 7.84 27.2267 0 17.5667 0C7.90665 0 0.0666504 7.84 0.0666504 17.5C0.0666504 25.97 6.08665 33.0225 14.0667 34.65V22.75H10.5667V17.5H14.0667V13.125C14.0667 9.7475 16.8141 7 20.1917 7H24.5667V12.25H21.0667C20.1042 12.25 19.3167 13.0375 19.3167 14V17.5H24.5667V22.75H19.3167V34.9125C28.1542 34.0375 35.0667 26.5825 35.0667 17.5Z" fill="white"/>
                        </svg>
                    </a>
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 39 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.0667 0C20.6912 0 22.3574 0.0418002 23.9724 0.1102L25.8801 0.2014L27.706 0.3097L29.416 0.4256L30.9777 0.5472C32.6729 0.676194 34.2682 1.39922 35.4826 2.58894C36.697 3.77866 37.4526 5.35875 37.6164 7.0509L37.6923 7.8584L37.8349 9.5874C37.9679 11.3791 38.0666 13.3323 38.0666 15.2C38.0666 17.0677 37.9679 19.0209 37.8349 20.8126L37.6923 22.5416L37.6164 23.3491C37.4525 25.0415 36.6966 26.6219 35.4818 27.8116C34.2671 29.0014 32.6713 29.7242 30.9758 29.8528L29.4178 29.9725L27.7079 30.0903L25.8801 30.1986L23.9724 30.2898C22.3381 30.3606 20.7025 30.3973 19.0667 30.4C17.4308 30.3973 15.7952 30.3606 14.1609 30.2898L12.2532 30.1986L10.4274 30.0903L8.71735 29.9725L7.15555 29.8528C5.4604 29.7238 3.86513 29.0008 2.65073 27.8111C1.43634 26.6213 0.680713 25.0412 0.51695 23.3491L0.44095 22.5416L0.29845 20.8126C0.153733 18.9451 0.0764157 17.073 0.0666504 15.2C0.0666504 13.3323 0.16545 11.3791 0.29845 9.5874L0.44095 7.8584L0.51695 7.0509C0.680649 5.35905 1.436 3.7792 2.65001 2.58952C3.86402 1.39984 5.45883 0.676621 7.15365 0.5472L8.71355 0.4256L10.4236 0.3097L12.2514 0.2014L14.1589 0.1102C15.7939 0.0393817 17.4302 0.0026402 19.0667 0ZM15.2667 10.5925V19.8075C15.2667 20.6853 16.2166 21.2325 16.9766 20.7955L24.9567 16.188C25.1303 16.088 25.2745 15.9441 25.3748 15.7706C25.4751 15.5972 25.5279 15.4004 25.5279 15.2C25.5279 14.9996 25.4751 14.8028 25.3748 14.6294C25.2745 14.4559 25.1303 14.312 24.9567 14.212L16.9766 9.6064C16.8033 9.50631 16.6066 9.45364 16.4065 9.45367C16.2063 9.4537 16.0097 9.50644 15.8363 9.60658C15.663 9.70672 15.5191 9.85074 15.4191 10.0241C15.3191 10.1975 15.2665 10.3942 15.2667 10.5944V10.5925Z" fill="white"/>
                        </svg>
                    </a>
                    <a href="">
                        <svg class="sm:w-[1.875vw] sm:h-[1.875vw] w-[4.977vw] h-[6.977vw]" viewBox="0 0 31 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23.8677 5.39541C22.5601 3.90216 21.8394 1.98482 21.8396 0H15.9276V23.7245C15.883 25.0087 15.3412 26.2253 14.4167 27.1177C13.4922 28.01 12.2572 28.5084 10.9723 28.5077C8.25543 28.5077 5.99777 26.2883 5.99777 23.5332C5.99777 20.2423 9.17379 17.7742 12.4455 18.7883V12.7423C5.84471 11.8622 0.0666504 16.9898 0.0666504 23.5332C0.0666504 29.9043 5.34726 34.4388 10.9531 34.4388C16.9608 34.4388 21.8396 29.5599 21.8396 23.5332V11.4987C24.2369 13.2204 27.1152 14.1441 30.0667 14.139V8.22704C30.0667 8.22704 26.4697 8.39923 23.8677 5.39541Z" fill="white"/>
                            </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <div id="popup" class="fixed inset-0 items-center justify-center bg-black bg-opacity-50 hidden" onclick="togglePopup(false)">
        <div class="bg-black flex flex-col items-center p-6 rounded-lg shadow-lg sm:w-[20.833vw] w-[69.767vw]" onclick="event.stopPropagation()">
            <img src="assets/icons/gear-512.png" alt="" class="sm:w-[5.208vw] w-[23.256vw] animate-[spin_5s_linear_infinite]">
            <h2 class="text-white text-[4.651vw] text-center sm:text-[1.042vw] font-bold mb-4">This features is under developement now</h2>
            <p class="text-white sm:text-[0.729vw] text-[3.256vw] mb-4">Sorry for the inconvinient</p>
            <button onclick="togglePopup(false)" class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.208vw] py-[0.93vw] bg-red-500 text-white sm:text-[0.729vw] text-[3.256vw] rounded-md">Close</button>
        </div>
    </div>
    <script>
        function togglePopup(show){
            const popup = document.getElementById('popup');
            const body = document.body;
            if (show) {
                popup.classList.remove('hidden');
                popup.classList.add('flex');
                body.style.overflow = 'hidden';  // Disable scrolling
            } else {
                popup.classList.add('hidden');
                popup.classList.remove('flex');
                body.style.overflow = '';  // Enable scrolling
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
    </script>
    <script>
        AOS.init();
    </script>
</body>
</html>