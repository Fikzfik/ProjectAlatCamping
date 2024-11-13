<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/output.css">
    <link rel="stylesheet" href="src/css/font.css">
    <link rel="stylesheet" href="src/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="../node_modules/aos/dist/aos.css" rel="stylesheet">
    <script src="../node_modules/aos/dist/aos.js"></script>
    <title>Home</title>
</head>

<body class="bg-white">
    <div class="w-[100vw] sm:overflow-visible overflow-hidden">
        <section>
            <div class="w-full flex lg:flex-row flex-col">
                <div class="lg:w-[37.5vw] w-full h-[60vw] login-section lg:h-screen flex flex-col justify-center items-center relative"
                    style="background-image: url('src/assets/images/bg1.jpg'); background-size: cover; background-position: center;">
                    <!-- https://pin.it/7iFmRBHx6 -->
                    <a href="index.html">
                        <h1 data-aos="fade-right" data-aos-duration="500" data-aos-delay="200"
                            class="text-white text-[4vw] lg:text-[1.667vw] logo absolute top-[10vw] left-[8vw] lg:top-[3.5vw] lg:left-[3.5vw] z-20">
                            CampRover</h1>
                    </a>
                    <h1 data-aos="fade-right" data-aos-duration="500" data-aos-delay="300"
                        class="text-white opacity-60 lg:opacity-100 text-[12vw] lg:text-[5.208vw] font-medium text-start tracking-[0.5vw] absolute flex items-center justify-center lg:inset-0 bottom-[12vw] lg:bottom-0 lg:left-[10vw] leading-[5.958vw]">
                        Welcome, Back
                    </h1>
                </div>

                <div class="lg:w-[62.5vw] w-full flex items-center justify-center mt-[10vw] lg:mt-0">
                    <div class="w-full lg:max-w-[30vw] max-w-[80vw]">
                        <!-- Back Icon -->
                        <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="200" class="">
                            <a href="index.html" class="text-black">
                                <img src="src/assets/icons/back-icon.svg" alt="" width=""
                                    class="w-[8vw] h-[8.2vw] lg:w-[2.302vw] lg:h-[2.448vw]">
                            </a>
                        </div>

                        <!-- Form Content -->
                        <form action="dashboard.html">
                            <div class="bg-white pt-2 rounded-lg space-y-[4vw]  lg:space-y-[1.5vw]">
                                <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="300"
                                    class="space-y-[0.3vw]">
                                    <h2 class="text-[7vw] lg:text-[2.083vw] font-semibold text-gray-800">Login</h2>
                                    <p class="text-[3vw] lg:text-[1.042vw] text-gray-500">Sign in to your email</p>
                                </div>
                                <div class="grid grid-cols-1 space-y-[4vw] lg:space-y-[0.5vw]">
                                    <!-- Email Input -->
                                    <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="350"
                                        class=" ">
                                        <label for="email"
                                            class="block text-[4.5vw] lg:text-[1.25vw] font-medium text-gray-700 mb-[0.833vw]">Email</label>
                                        <input type="email" id="email" name="email"
                                            class="w-full p-[3vw] lg:p-[1vw]  border border-gray-400 focus:outline-none focus:ring-2 focus:ring-dark lg:placeholder:text-[0.938vw] placeholder:text-[3.5vw] text-[4.5vw] lg:text-[1.25vw]"
                                            placeholder="Enter Email" autocomplete="off" required>
                                    </div>

                                    <!-- Password Input -->
                                    <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="400"
                                        class=" ">
                                        <label for="password"
                                            class="block text-[4.5vw] lg:text-[1.25vw] font-medium text-gray-700 mb-[0.833vw]">Password</label>
                                        <input type="password" id="password" name="password"
                                            class="w-full p-[3vw] lg:p-[1vw]  border border-gray-400 focus:outline-none focus:ring-2 focus:ring-dark lg:placeholder:text-[0.938vw] placeholder:text-[3.5vw] text-[4.5vw] lg:text-[1.25vw]"
                                            placeholder="Enter Password" autocomplete="off" required>
                                    </div>

                                    <!-- Login Button -->
                                    <div data-aos="fade-left" data-aos-duration="500" data-aos-delay="450"
                                        class="">
                                        <button
                                            class="block w-full text-center bg-dark text-white p-[3vw] lg:p-[1vw] font-medium text-[4vw] lg:text-[1.302vw] mt-[1vw]">Login</button>
                                    </div>
                                </div>

                                <div class="text-center text-[3vw] lg:text-[1.042vw]">
                                    <p class="">Didn't Have Account? <span class="font-semibold"><a
                                                href="register.html">Register Now</a></span></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        AOS.init();
    </script>
</body>

</html>
