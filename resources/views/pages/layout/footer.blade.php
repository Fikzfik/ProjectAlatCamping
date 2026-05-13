<footer class="bg-slate-900 border-t border-white/5 pt-24 pb-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-20">
            <!-- Brand Section -->
            <div class="space-y-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500 shadow-lg shadow-indigo-600/30">
                        <i class="fa-solid fa-mountain-sun text-white"></i>
                    </div>
                    <h2 class="text-2xl font-black tracking-tighter text-white logo">CAMPROVER</h2>
                </a>
                <p class="text-slate-400 leading-relaxed max-w-xs">
                    Penyedia perlengkapan camping premium untuk petualangan tanpa batas. Kualitas terjamin, harga bersaing, dan layanan terpercaya.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 transition-all">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 transition-all">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 transition-all">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white hover:bg-indigo-600 transition-all">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-8">
                <h3 class="text-xs font-black text-white uppercase tracking-widest">Navigation</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Home</a></li>
                    <li><a href="{{ route('blog') }}" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Adventure Blog</a></li>
                    <li><a href="{{ route('location') }}" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Store Locations</a></li>
                    <li><a href="{{ route('history') }}" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Rental History</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div class="space-y-8">
                <h3 class="text-xs font-black text-white uppercase tracking-widest">Support</h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">FAQ</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Terms of Service</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Privacy Policy</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-indigo-400 transition-colors font-bold text-sm">Contact Us</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="space-y-8">
                <h3 class="text-xs font-black text-white uppercase tracking-widest">Newsletter</h3>
                <p class="text-slate-400 text-sm">Dapatkan info promo dan tips camping terbaru.</p>
                <div class="flex gap-2">
                    <input type="email" placeholder="Email address" class="flex-1 bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-indigo-500 outline-none transition-all">
                    <button class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs transition-all shadow-lg shadow-indigo-600/20">
                        JOIN
                    </button>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">
                &copy; {{ date('Y') }} CAMPROVER ADVENTURE. ALL RIGHTS RESERVED.
            </p>
            <div class="flex items-center gap-8">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-4 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-6 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="h-5 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all cursor-pointer">
            </div>
        </div>
    </div>
</footer>

<!-- Global Features Popup (Under Development) -->
<div id="popup" class="fixed inset-0 z-[300] items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-md" onclick="togglePopup(false)"></div>
    <div class="bg-slate-900 border border-white/10 flex flex-col items-center p-12 rounded-[40px] shadow-2xl relative z-10 max-w-md w-full mx-6" onclick="event.stopPropagation()">
        <div class="w-24 h-24 bg-indigo-600/20 rounded-3xl flex items-center justify-center mb-8 animate-bounce">
            <i class="fa-solid fa-screwdriver-wrench text-4xl text-indigo-500"></i>
        </div>
        <h2 class="text-2xl font-black text-white text-center mb-4 tracking-tight">FEATURE UNDER CONSTRUCTION</h2>
        <p class="text-slate-400 text-center mb-10 leading-relaxed font-medium">Kami sedang menyiapkan sesuatu yang luar biasa untuk Anda. Mohon tunggu kabar selanjutnya!</p>
        <button onclick="togglePopup(false)" class="w-full btn-premium py-5 rounded-2xl text-white font-black uppercase tracking-widest">Understood</button>
    </div>
</div>

<script>
    function togglePopup(show) {
        const popup = document.getElementById('popup');
        if (show) {
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.style.overflow = 'hidden';
        } else {
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }
</script>