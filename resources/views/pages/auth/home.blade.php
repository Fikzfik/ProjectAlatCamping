<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Home - CampRover Premium Gear</title>
</head>

<body class="bg-slate-950 overflow-x-hidden">
    @include('pages.layout.nav')

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 px-6 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-[128px] animate-pulse"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-[128px] animate-pulse" style="animation-delay: 2s"></div>
        </div>
        
        <div class="container mx-auto text-center relative">
            <span data-aos="fade-up" class="inline-block px-4 py-1.5 rounded-full glass border-white/10 text-indigo-400 text-xs font-black uppercase tracking-[0.2em] mb-6">Explore the Wilderness</span>
            <h1 data-aos="fade-up" data-aos-delay="100" class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tighter">
                Premium Gear for <br><span class="text-gradient">Your Next Adventure</span>
            </h1>
            <p data-aos="fade-up" data-aos-delay="200" class="max-w-2xl mx-auto text-slate-400 text-lg mb-10 leading-relaxed">
                Sewa perlengkapan camping terbaik dengan kualitas premium. Siapkan petualangan Anda dengan alat yang aman dan terpercaya.
            </p>
        </div>
    </div>

    <main class="container mx-auto px-6 pb-24">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Sidebar Filters -->
            <aside class="lg:w-80 space-y-8">
                <div data-aos="fade-right" class="glass-card p-8 sticky top-32">
                    <div class="flex items-center gap-3 mb-8">
                        <i class="fa-solid fa-sliders text-indigo-500"></i>
                        <h2 class="text-xl font-black text-white">Filters</h2>
                    </div>

                    <!-- Categories -->
                    <div class="space-y-6 mb-10">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest">Categories</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="javascript:void(0)" data-kategori="all" class="px-4 py-2 rounded-xl glass border-white/5 text-sm font-bold text-slate-400 hover:bg-indigo-600 hover:text-white hover:border-indigo-500 transition-all">All</a>
                            @foreach ($kategori as $kat)
                                <a href="javascript:void(0)" data-kategori="{{ $kat->id_kategori }}" class="px-4 py-2 rounded-xl glass border-white/5 text-sm font-bold text-slate-400 hover:bg-indigo-600 hover:text-white hover:border-indigo-500 transition-all">
                                    {{ $kat->nama_kategori }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Availability -->
                    <div class="space-y-6 mb-10">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest">Stock Status</h3>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" id="inStock" class="hidden peer" checked>
                                <div class="w-6 h-6 rounded-lg glass border-white/10 flex items-center justify-center peer-checked:bg-indigo-600 peer-checked:border-indigo-500 transition-all">
                                    <i class="fa-solid fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100"></i>
                                </div>
                                <span class="text-sm font-bold text-slate-400 group-hover:text-white transition-colors">In Stock</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" id="outOfStock" class="hidden peer">
                                <div class="w-6 h-6 rounded-lg glass border-white/10 flex items-center justify-center peer-checked:bg-indigo-600 peer-checked:border-indigo-500 transition-all">
                                    <i class="fa-solid fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100"></i>
                                </div>
                                <span class="text-sm font-bold text-slate-400 group-hover:text-white transition-colors">Out of Stock</span>
                            </label>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="space-y-6">
                        <h3 class="text-xs font-black text-slate-500 uppercase tracking-widest">Price Range</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <input id="minPrice" type="number" placeholder="Min" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-indigo-500 outline-none transition-all">
                            <input id="maxPrice" type="number" placeholder="Max" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <button id="applyPriceFilter" class="w-full py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-sm transition-all shadow-lg shadow-indigo-600/20">
                            Apply Filter
                        </button>
                    </div>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="flex-1">
                <div id="barangContainer" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach ($barang as $item)
                        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}" class="group">
                            <div class="glass-card overflow-hidden h-full flex flex-col">
                                <div class="relative aspect-[4/5] overflow-hidden">
                                    <img src="{{ asset('storage/' . $item->link_foto) }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60"></div>
                                    
                                    <!-- Category Badge -->
                                    <div class="absolute top-6 left-6">
                                        <span class="px-4 py-1.5 rounded-full glass border-white/10 text-[10px] font-black uppercase tracking-widest text-indigo-400">
                                            {{ $item->nama_kategori }}
                                        </span>
                                    </div>

                                    <!-- Price Badge -->
                                    <div class="absolute bottom-6 left-6">
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Per Malam</p>
                                        <p class="text-2xl font-black text-white">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="p-8 flex flex-col flex-1">
                                    <h3 class="text-xl font-black text-white mb-3 tracking-tight group-hover:text-indigo-400 transition-colors">{{ $item->nama_barang }}</h3>
                                    <p class="text-slate-500 text-sm line-clamp-2 mb-8 leading-relaxed">
                                        {{ $item->deskripsi ?? 'Perlengkapan camping premium untuk menunjang aktivitas luar ruangan Anda.' }}
                                    </p>
                                    
                                    <div class="mt-auto flex items-center justify-between gap-4">
                                        <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}" class="flex-1 py-4 rounded-2xl glass border-white/5 text-center text-sm font-black text-white hover:bg-white/10 transition-all uppercase tracking-widest">
                                            Details
                                        </a>
                                        <button class="w-14 h-14 rounded-2xl btn-premium flex items-center justify-center text-white shadow-lg shadow-indigo-600/20 add-to-bag" data-id-barang="{{ $item->id_barang }}">
                                            <i class="fa-solid fa-cart-plus text-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    @include('pages.layout.footer')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Category Filter
            $('a[data-kategori]').on('click', function(e) {
                e.preventDefault();
                const kategoriId = $(this).data('kategori');
                const targetContainer = $('#barangContainer');
                
                // Visual feedback
                $('a[data-kategori]').removeClass('bg-indigo-600 text-white').addClass('text-slate-400');
                $(this).addClass('bg-indigo-600 text-white').removeClass('text-slate-400');

                $.ajax({
                    url: '{{ route('barang.by.kategori') }}',
                    method: 'GET',
                    data: { kategori_id: kategoriId },
                    success: function(response) {
                        targetContainer.empty();
                        response.forEach((item, index) => {
                            const html = renderProductCard(item, index);
                            targetContainer.append(html);
                        });
                        AOS.refresh();
                    }
                });
            });

            // Price Filter
            $('#applyPriceFilter').on('click', function() {
                const minPrice = $('#minPrice').val() || 0;
                const maxPrice = $('#maxPrice').val() || 999999999;

                $.ajax({
                    url: '{{ route('barang.by.price') }}',
                    method: 'GET',
                    data: { min_price: minPrice, max_price: maxPrice },
                    success: function(response) {
                        $('#barangContainer').empty();
                        response.forEach((item, index) => {
                            $('#barangContainer').append(renderProductCard(item, index));
                        });
                        AOS.refresh();
                    }
                });
            });

            function renderProductCard(item, index) {
                return `
                    <div data-aos="fade-up" data-aos-delay="${index * 50}" class="group">
                        <div class="glass-card overflow-hidden h-full flex flex-col">
                            <div class="relative aspect-[4/5] overflow-hidden">
                                <img src="/storage/${item.link_foto}" alt="${item.nama_barang}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60"></div>
                                <div class="absolute top-6 left-6">
                                    <span class="px-4 py-1.5 rounded-full glass border-white/10 text-[10px] font-black uppercase tracking-widest text-indigo-400">
                                        ${item.nama_kategori}
                                    </span>
                                </div>
                                <div class="absolute bottom-6 left-6">
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Per Malam</p>
                                    <p class="text-2xl font-black text-white">Rp ${new Intl.NumberFormat('id-ID').format(item.harga_sewa)}</p>
                                </div>
                            </div>
                            <div class="p-8 flex flex-col flex-1">
                                <h3 class="text-xl font-black text-white mb-3 tracking-tight group-hover:text-indigo-400 transition-colors">${item.nama_barang}</h3>
                                <p class="text-slate-500 text-sm line-clamp-2 mb-8 leading-relaxed">
                                    ${item.deskripsi || 'Perlengkapan camping premium untuk menunjang aktivitas luar ruangan Anda.'}
                                </p>
                                <div class="mt-auto flex items-center justify-between gap-4">
                                    <a href="/detailbarang/${item.id_barang}" class="flex-1 py-4 rounded-2xl glass border-white/5 text-center text-sm font-black text-white hover:bg-white/10 transition-all uppercase tracking-widest">
                                        Details
                                    </a>
                                    <button class="w-14 h-14 rounded-2xl btn-premium flex items-center justify-center text-white shadow-lg shadow-indigo-600/20 add-to-bag" data-id-barang="${item.id_barang}">
                                        <i class="fa-solid fa-cart-plus text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        });

        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
    @include('pages.layout.script')
</body>

</html>
