<head>
    @include('pages.layout.head')
    <title>History Penyewaan</title>
    <style>
        /* Style untuk dropdown interaktif */
        .dropdown-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        .dropdown-open .dropdown-list {
            max-height: 500px; /* Atur sesuai kebutuhan */
        }

        .dropdown-arrow {
            transition: transform 0.5s ease-in-out;
        }

        .dropdown-open .dropdown-arrow {
            transform: rotate(180deg);
        }
    </style>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav')

    @if (session('notif'))
        <div class="alert alert-success">
            {{ session('notif') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-white sm:px-[4.271vw] px-[8.372vw] pt-[2.604vw]">
        <div class="space-y-[2vw]">
            <h1 class="text-[2vw] font-bold">History Penyewaan</h1>
            
            <!-- Tabel Barang Tersewa -->
            <div>
                <h2 class="text-[1.5vw] font-semibold mb-[1vw]">Barang Tersewa</h2>
                <div class="grid sm:grid-cols-4 grid-cols-2 gap-[2.344vw]">
                    @forelse ($barangTersewa as $item)
                        <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}" class="group">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $item->link_foto) }}" alt="{{ $item->nama_barang }}"
                                    class="w-full h-auto object-cover transform group-hover:scale-110 transition-transform">
                                <div class="absolute bottom-0 w-full bg-gradient-to-t from-black to-transparent p-2">
                                    <h2 class="text-white text-lg">{{ $item->nama_barang }}</h2>
                                    <p class="text-gray-400">{{ $item->nama_kategori }}</p>
                                    <h2 class="text-white">Rp. {{ number_format($item->harga_sewa, 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-400 col-span-4">Tidak ada barang yang sedang tersewa.</p>
                    @endforelse
                </div>
            </div>

            <!-- Tabel Barang Selesai -->
            <div>
                <h2 class="text-[1.5vw] font-semibold mb-[1vw]">Barang Selesai</h2>
                <div class="grid sm:grid-cols-4 grid-cols-2 gap-[2.344vw]">
                    @forelse ($barangSelesai as $item)
                        <a href="{{ route('detailbarang', ['id' => $item->id_barang]) }}" class="group">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $item->link_foto) }}" alt="{{ $item->nama_barang }}"
                                    class="w-full h-auto object-cover transform group-hover:scale-110 transition-transform">
                                <div class="absolute bottom-0 w-full bg-gradient-to-t from-black to-transparent p-2">
                                    <h2 class="text-white text-lg">{{ $item->nama_barang }}</h2>
                                    <p class="text-gray-400">{{ $item->nama_kategori }}</p>
                                    <h2 class="text-white">Rp. {{ number_format($item->harga_sewa, 0, ',', '.') }}</h2>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-400 col-span-4">Tidak ada barang yang selesai disewa.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @include('pages.layout.footer')
</body>
