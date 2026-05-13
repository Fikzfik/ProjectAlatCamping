<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>{{ $barang->nama_barang }} - CampRover</title>
</head>

<body class="bg-slate-950 overflow-x-hidden">
    @include('pages.layout.nav')

    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-indigo-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-purple-600/10 rounded-full blur-[120px]"></div>
    </div>

    <main class="container mx-auto px-6 pt-32 pb-24">
        <!-- Breadcrumb -->
        <nav data-aos="fade-down" class="flex items-center gap-4 mb-12 text-xs font-black uppercase tracking-widest text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <i class="fa-solid fa-chevron-right text-[8px]"></i>
            <span class="text-indigo-400">{{ $barang->nama_kategori }}</span>
            <i class="fa-solid fa-chevron-right text-[8px]"></i>
            <span class="text-white">{{ $barang->nama_barang }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Left: Image Gallery -->
            <div class="lg:w-2/5" data-aos="fade-right">
                <div class="glass-card p-4 aspect-[4/5] relative group overflow-hidden">
                    <img src="{{ asset('storage/' . $barang->link_foto) }}" alt="{{ $barang->nama_barang }}" class="w-full h-full object-cover rounded-2xl shadow-2xl transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Floating Badge -->
                    <div class="absolute top-8 right-8">
                        <div class="w-16 h-16 rounded-full glass border-white/10 flex flex-col items-center justify-center text-white">
                            <span class="text-[10px] font-black uppercase tracking-tighter">NEW</span>
                            <span class="text-xs font-bold">2024</span>
                        </div>
                    </div>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-3 gap-4 mt-8">
                    <div class="glass-card p-6 flex flex-col items-center text-center">
                        <i class="fa-solid fa-shield-halved text-indigo-500 mb-3 text-xl"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest text-white">Safe Gear</span>
                    </div>
                    <div class="glass-card p-6 flex flex-col items-center text-center">
                        <i class="fa-solid fa-bolt text-indigo-500 mb-3 text-xl"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest text-white">Fast Setup</span>
                    </div>
                    <div class="glass-card p-6 flex flex-col items-center text-center">
                        <i class="fa-solid fa-feather text-indigo-500 mb-3 text-xl"></i>
                        <span class="text-[10px] font-black uppercase tracking-widest text-white">Ultra Light</span>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="lg:w-3/5" data-aos="fade-left">
                <div class="mb-10">
                    <span class="inline-block px-4 py-1.5 rounded-full glass border-white/10 text-indigo-400 text-[10px] font-black uppercase tracking-widest mb-6">{{ $barang->nama_kategori }}</span>
                    <h1 class="text-5xl font-black text-white mb-6 tracking-tighter">{{ $barang->nama_barang }}</h1>
                    
                    <div class="flex items-center gap-6 mb-8">
                        <div class="flex items-center gap-1 text-amber-400">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star text-sm"></i>
                            @endfor
                        </div>
                        <span class="text-slate-500 text-sm font-bold border-l border-white/10 pl-6">{{ $totalReviews }} Verified Reviews</span>
                    </div>

                    <div class="flex items-end gap-4 mb-10">
                        <p class="text-4xl font-black text-white">Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}</p>
                        <p class="text-lg font-bold text-slate-500 line-through mb-1">Rp {{ number_format($barang->harga_sewa * 1.5, 0, ',', '.') }}</p>
                        <span class="bg-rose-500/10 text-rose-500 text-[10px] font-black px-2 py-1 rounded-md mb-2">-33% OFF</span>
                    </div>

                    <p class="text-slate-400 text-lg leading-relaxed mb-10 border-l-4 border-indigo-600 pl-8">
                        {{ $barang->deskripsi ?? 'Perlengkapan camping premium yang dirancang untuk kenyamanan maksimal saat berpetualang. Material tahan lama dan cuaca ekstrem.' }}
                    </p>

                    <!-- Purchase Actions -->
                    <div class="flex flex-col sm:flex-row items-center gap-6 p-8 glass-card border-indigo-500/20 bg-indigo-600/5">
                        <div class="flex items-center gap-6 bg-slate-950/50 rounded-2xl p-2 border border-white/5">
                            <button onclick="changeQty(-1)" class="w-12 h-12 rounded-xl hover:bg-white/5 text-white transition-all flex items-center justify-center font-black">-</button>
                            <span id="quantity-display" class="text-lg font-black text-white min-w-[2ch] text-center">1</span>
                            <button onclick="changeQty(1)" class="w-12 h-12 rounded-xl hover:bg-white/5 text-white transition-all flex items-center justify-center font-black">+</button>
                        </div>
                        
                        <button class="flex-1 w-full btn-premium py-5 rounded-2xl text-white font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-600/20 add-to-bag" data-id-barang="{{ $barang->id_barang }}">
                            <i class="fa-solid fa-cart-plus mr-3"></i> Add to Adventure
                        </button>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="mt-20">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-2xl font-black text-white tracking-tight">Adventurer Reviews</h2>
                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="text-3xl font-black text-white">{{ number_format($averageRating, 1) }}</p>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Global Rating</p>
                            </div>
                            <div class="w-12 h-12 rounded-2xl glass flex items-center justify-center text-amber-400">
                                <i class="fa-solid fa-star text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        @forelse ($feedbacks as $feedback)
                            <div class="glass-card p-8 group hover:border-indigo-500/30 transition-all">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-indigo-600/20 flex items-center justify-center text-indigo-400 font-black">
                                            {{ substr($feedback->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-white font-black">{{ $feedback->name }}</p>
                                            <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">{{ $feedback->tanggal_feedback }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 text-amber-400">
                                        @for ($i = 0; $i < $feedback->rating; $i++)
                                            <i class="fa-solid fa-star text-[10px]"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-slate-400 leading-relaxed italic">"{{ $feedback->komentar }}"</p>
                            </div>
                        @empty
                            <div class="glass-card p-12 text-center">
                                <i class="fa-solid fa-comments text-slate-700 text-5xl mb-6"></i>
                                <p class="text-slate-500 font-bold">No reviews yet for this gear.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Background Text -->
    <div class="fixed bottom-0 left-0 right-0 pointer-events-none opacity-[0.02] select-none overflow-hidden h-[30vh]">
        <h1 class="text-[25vw] font-black text-white whitespace-nowrap leading-none transform translate-y-1/2">
            ADVENTURE GEAR • ADVENTURE GEAR
        </h1>
    </div>

    @include('pages.layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let quantity = 1;
        function changeQty(amt) {
            quantity = Math.max(1, quantity + amt);
            document.getElementById('quantity-display').innerText = quantity;
        }

        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>
    @include('pages.layout.script')
</body>

</html>
