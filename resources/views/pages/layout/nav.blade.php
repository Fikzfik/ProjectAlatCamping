<!-- Modern Navigation -->
<header id="main-header" class="fixed top-0 inset-x-0 z-[100] transition-all duration-300">
    <div class="container mx-auto px-6 py-4">
        <nav class="glass rounded-3xl px-8 py-4 flex items-center justify-between shadow-xl shadow-black/20 border-white/10">
            <!-- Mobile Menu Toggle -->
            <button id="hamburger" class="lg:hidden text-white hover:text-indigo-400 transition-colors">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </button>

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500 shadow-lg shadow-indigo-600/30">
                    <i class="fa-solid fa-mountain-sun text-white"></i>
                </div>
                <h1 class="text-2xl font-black tracking-tighter text-white logo">CAMPROVER</h1>
            </a>

            <!-- Desktop Menu -->
            <ul class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-300 uppercase tracking-widest">
                <li><a href="{{ route('home') }}" class="hover:text-white transition-colors py-2 relative group">Home<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-500 transition-all duration-300 group-hover:w-full"></span></a></li>
                <li><a href="{{ route('blog') }}" class="hover:text-white transition-colors py-2 relative group">Blog<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-500 transition-all duration-300 group-hover:w-full"></span></a></li>
                <li><a href="{{ route('location') }}" class="hover:text-white transition-colors py-2 relative group">Stores<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-500 transition-all duration-300 group-hover:w-full"></span></a></li>
                <li><a href="{{ route('history') }}" class="hover:text-white transition-colors py-2 relative group">History<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-indigo-500 transition-all duration-300 group-hover:w-full"></span></a></li>
                
                @if(Auth::check() && Auth::user()->id_role == 1)
                <li class="relative group">
                    <button class="hover:text-white transition-colors flex items-center gap-1">
                        Admin <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-4 w-56 glass rounded-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 shadow-2xl">
                        <a href="{{ route('stock') }}" class="block px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white transition-all">Stock Management</a>
                        <a href="{{ route('addblog') }}" class="block px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white transition-all">Blogs Management</a>
                        <a href="{{ route('return') }}" class="block px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white transition-all">Returns</a>
                    </div>
                </li>
                @endif
            </ul>

            <!-- Actions -->
            <div class="flex items-center gap-6">
                <!-- Search -->
                <div class="hidden sm:flex items-center glass rounded-2xl px-4 py-2 border-white/5 group focus-within:border-indigo-500/50 transition-all">
                    <i class="fa-solid fa-magnifying-glass text-slate-500 text-sm group-focus-within:text-indigo-400"></i>
                    <input type="text" placeholder="Search gear..." class="bg-transparent border-none outline-none pl-3 text-sm text-white placeholder-slate-600 w-32 focus:w-48 transition-all">
                </div>

                <!-- Cart -->
                <button id="keranjangButton" class="relative group">
                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center glass group-hover:bg-indigo-600 transition-all duration-300">
                        <i class="fa-solid fa-cart-shopping text-slate-300 group-hover:text-white"></i>
                    </div>
                    <span id="cart-count" class="absolute -top-1 -right-1 w-5 h-5 bg-indigo-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-slate-900 shadow-lg animate-bounce">0</span>
                </button>

                <!-- Profile -->
                <div class="relative group">
                    <button id="profile-button" class="w-11 h-11 rounded-2xl overflow-hidden glass p-0.5 group-hover:border-indigo-500 transition-all">
                        <img src="{{ asset('src/assets/icons/profile-icon.svg') }}" alt="User" class="w-full h-full object-cover rounded-xl bg-slate-800">
                    </button>
                    <div id="submenu" class="absolute top-full right-0 mt-4 w-56 glass rounded-2xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 shadow-2xl scale-95 group-hover:scale-100">
                        <div class="px-4 py-3 border-b border-white/5 mb-2">
                            <p class="text-xs text-slate-500 uppercase tracking-widest font-bold">Logged in as</p>
                            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        </div>
                        <a href="{{ route('userprofil') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-slate-400 hover:text-white transition-all">
                            <i class="fa-solid fa-user-gear text-sm"></i> My Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-rose-500/10 text-slate-400 hover:text-rose-400 transition-all">
                                <i class="fa-solid fa-power-off text-sm"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Mobile Sidebar -->
<div id="sidebar" class="fixed inset-0 z-[200] opacity-0 invisible transition-all duration-500">
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-md" onclick="closeSidebar()"></div>
    <div class="absolute left-0 top-0 bottom-0 w-80 glass border-r border-white/10 p-8 transform -translate-x-full transition-transform duration-500 ease-out flex flex-col">
        <div class="flex justify-between items-center mb-12">
            <h1 class="text-2xl font-black text-white">CAMPROVER</h1>
            <button onclick="closeSidebar()" class="w-10 h-10 rounded-xl glass flex items-center justify-center text-slate-400 hover:text-white">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        
        <ul class="space-y-6 text-xl font-bold">
            <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-white flex items-center gap-4"><i class="fa-solid fa-house text-lg w-8"></i> Home</a></li>
            <li><a href="{{ route('blog') }}" class="text-slate-400 hover:text-white flex items-center gap-4"><i class="fa-solid fa-newspaper text-lg w-8"></i> Blog</a></li>
            <li><a href="{{ route('location') }}" class="text-slate-400 hover:text-white flex items-center gap-4"><i class="fa-solid fa-map-location-dot text-lg w-8"></i> Stores</a></li>
            <li><a href="{{ route('history') }}" class="text-slate-400 hover:text-white flex items-center gap-4"><i class="fa-solid fa-clock-rotate-left text-lg w-8"></i> History</a></li>
        </ul>

        @if(Auth::check() && Auth::user()->id_role == 1)
        <div class="mt-12 pt-12 border-t border-white/5">
            <p class="text-xs font-black text-slate-600 uppercase tracking-widest mb-6">Administrator</p>
            <ul class="space-y-4">
                <li><a href="{{ route('stock') }}" class="text-slate-400 hover:text-white flex items-center gap-4 font-bold text-base"><i class="fa-solid fa-boxes-stacked w-8 text-indigo-500"></i> Stock</a></li>
                <li><a href="{{ route('addblog') }}" class="text-slate-400 hover:text-white flex items-center gap-4 font-bold text-base"><i class="fa-solid fa-pen-to-square w-8 text-indigo-500"></i> Blogs</a></li>
                <li><a href="{{ route('return') }}" class="text-slate-400 hover:text-white flex items-center gap-4 font-bold text-base"><i class="fa-solid fa-rotate-left w-8 text-indigo-500"></i> Returns</a></li>
            </ul>
        </div>
        @endif

        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full btn-premium py-4 rounded-2xl font-bold text-white flex items-center justify-center gap-3">
                    <i class="fa-solid fa-power-off"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Cart Overlay/Modal -->
<div id="overlay" class="fixed inset-0 z-[150] opacity-0 invisible transition-all duration-500">
    <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="toggleCart(false)"></div>
    <div id="keranjangModal" class="absolute top-0 right-0 bottom-0 w-full sm:w-[450px] bg-slate-900 border-l border-white/10 p-8 transform translate-x-full transition-transform duration-500 flex flex-col shadow-2xl">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black text-white">Keranjang</h2>
                <p class="text-slate-500 text-sm">Review perlengkapan Anda.</p>
            </div>
            <button id="closeModal" class="w-12 h-12 rounded-2xl glass flex items-center justify-center text-slate-400 hover:text-white transition-all">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <div id="keranjangContent" class="flex-1 overflow-y-auto space-y-6 pr-2 -mr-2">
            <!-- Items populated by JS -->
        </div>

        <div class="mt-8 pt-8 border-t border-white/10 space-y-6">
            <div class="flex justify-between items-center">
                <span class="text-slate-400 font-medium">Estimasi Total</span>
                <span id="totalAmount" class="text-2xl font-black text-white">Rp 0</span>
            </div>
            <a href="{{ route('penyewaan') }}" class="block">
                <button class="w-full btn-premium py-5 rounded-2xl text-white font-black uppercase tracking-widest shadow-lg shadow-indigo-600/20 group">
                    Lanjut Checkout <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                </button>
            </a>
        </div>
    </div>
</div>

<script>
    // Header Scroll Effect
    window.addEventListener('scroll', () => {
        const header = document.getElementById('main-header');
        if (window.scrollY > 20) {
            header.classList.add('py-2');
            header.querySelector('.container').classList.add('max-w-7xl');
        } else {
            header.classList.remove('py-2');
            header.querySelector('.container').classList.remove('max-w-7xl');
        }
    });

    // Mobile Sidebar Toggle
    const sidebar = document.getElementById('sidebar');
    const sideContent = sidebar.querySelector('.w-80');
    
    document.getElementById('hamburger').onclick = () => {
        sidebar.classList.remove('invisible', 'opacity-0');
        sideContent.classList.remove('-translate-x-full');
    };

    function closeSidebar() {
        sidebar.classList.add('invisible', 'opacity-0');
        sideContent.classList.add('-translate-x-full');
    }

    // Cart Toggle
    const keranjangButton = document.getElementById('keranjangButton');
    const overlay = document.getElementById('overlay');
    const modal = document.getElementById('keranjangModal');
    const closeBtn = document.getElementById('closeModal');

    keranjangButton.onclick = () => toggleCart(true);
    closeBtn.onclick = () => toggleCart(false);

    function toggleCart(show) {
        if(show) {
            overlay.classList.remove('invisible', 'opacity-0');
            modal.classList.remove('translate-x-full');
            document.body.style.overflow = 'hidden';
        } else {
            overlay.classList.add('invisible', 'opacity-0');
            modal.classList.add('translate-x-full');
            document.body.style.overflow = '';
        }
    }
</script>
