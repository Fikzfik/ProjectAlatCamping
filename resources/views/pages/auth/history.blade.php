<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .tab-active {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .tab-inactive {
            color: #94a3b8;
        }

        .tab-inactive:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }

        .badge {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-booked { background: rgba(245, 158, 11, 0.2); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge-rented { background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge-history { background: rgba(99, 102, 241, 0.2); color: #6366f1; border: 1px solid rgba(99, 102, 241, 0.3); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(0,0,0,0.1); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }
    </style>
</head>

<body id="body" class="relative min-h-screen text-slate-200">
    <!-- Background Wrapper -->
    <div class="fixed inset-0 -z-10 bg-slate-950">
        <div class="absolute inset-0"
            style="background-image: url('{{ asset('src/assets/images/bgwebsite.jpeg') }}'); 
                   background-size: cover; 
                   background-position: center; 
                   filter: blur(8px) brightness(0.4);">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/50 via-transparent to-slate-950"></div>
    </div>

    @include('pages.layout.nav')

    <div class="container mx-auto p-6 relative z-10 pt-24">
        @if (session('notif') || session('success'))
            <div class="mb-6 p-4 glass-card border-emerald-500/30 bg-emerald-500/10 text-emerald-400 animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('notif') ?? session('success') }}
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 glass-card border-rose-500/30 bg-rose-500/10 text-rose-400 animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="mb-10" data-aos="fade-down">
            <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white via-indigo-200 to-indigo-400">
                Riwayat Aktivitas
            </h1>
            <p class="text-slate-400 mt-2">Kelola pesanan dan pengalaman berkemah Anda.</p>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex flex-wrap gap-2 mb-8 p-1 glass-card bg-white/5 inline-flex" data-aos="fade-up">
            <button onclick="showTab('booked')" id="tab-booked"
                class="tab-active py-2.5 px-6 rounded-xl font-medium transition-all duration-300">
                Sudah Dibooking
            </button>
            <button onclick="showTab('rented')" id="tab-rented"
                class="tab-inactive py-2.5 px-6 rounded-xl font-medium transition-all duration-300">
                Sedang Disewa
            </button>
            <button onclick="showTab('history')" id="tab-history"
                class="tab-inactive py-2.5 px-6 rounded-xl font-medium transition-all duration-300">
                History Penyewaan
            </button>
        </div>

        <!-- Content Section -->
        <div class="mt-4">
            <!-- Sudah Dibooking -->
            <div id="content-booked" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
                @forelse ($barangBooked as $item)
                    <div class="glass-card group overflow-hidden" data-aos="zoom-in">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $item->link_foto) }}" alt="{{ $item->nama_barang }}"
                                class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4">
                                <span class="badge badge-booked">Booked</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-white font-bold text-xl">{{ $item->nama_barang }}</h3>
                                <span class="text-indigo-400 font-bold">x{{ $item->jumlah_barang }}</span>
                            </div>
                            <p class="text-slate-400 text-sm mb-4">Kategori: {{ $item->nama_kategori }}</p>
                            <div class="flex justify-between items-center pt-4 border-t border-white/10">
                                <div>
                                    <p class="text-xs text-slate-500 uppercase tracking-wider">Total Harga</p>
                                    <p class="text-white font-bold text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-slate-500 uppercase tracking-wider">Tanggal Sewa</p>
                                    <p class="text-indigo-300 font-medium">{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center glass-card">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p class="text-slate-400 text-lg">Kamu tidak mempunyai barang yang dibooking.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Sedang Disewa -->
            <div id="content-rented" class="hidden grid sm:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
                @forelse ($barangRented as $item)
                    <div class="glass-card group overflow-hidden" data-aos="zoom-in">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $item->link_foto) }}" alt="{{ $item->nama_barang }}"
                                class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute top-4 right-4">
                                <span class="badge badge-rented">Active</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-white font-bold text-xl">{{ $item->nama_barang }}</h3>
                                <span class="text-emerald-400 font-bold">x{{ $item->jumlah_barang }}</span>
                            </div>
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Mulai:</span>
                                    <span class="text-slate-300">{{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Kembali:</span>
                                    <span class="text-rose-400">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="pt-4 border-t border-white/10">
                                <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Total Biaya</p>
                                <p class="text-white font-bold text-lg">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center glass-card">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-slate-400 text-lg">Kamu tidak mempunyai barang yang sedang disewa.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- History Penyewaan -->
            <div id="content-history" class="hidden grid sm:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
                @forelse ($barangHistory as $item)
                    <div class="glass-card group overflow-hidden" data-aos="zoom-in">
                        <div class="relative overflow-hidden">
                            <img src="{{ asset('storage/' . $item->link_foto) }}" alt="{{ $item->nama_barang }}"
                                class="w-full h-56 object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                            <div class="absolute top-4 right-4">
                                <span class="badge badge-history">Selesai</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-white font-bold text-xl mb-1">{{ $item->nama_barang }}</h3>
                            <p class="text-slate-500 text-sm mb-4">Sewa pada {{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d M Y') }}</p>
                            
                            @if (empty($item->id_feedback))
                                <button type="button" onclick="openFeedbackModal('{{ $item->id_barang }}', '{{ $item->id_penyewaan }}', '{{ $item->nama_barang }}')"
                                    class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-600/20">
                                    Beri Feedback
                                </button>
                            @else
                                <div class="mt-4 flex items-center text-emerald-400 bg-emerald-400/10 p-3 rounded-xl border border-emerald-400/20">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    <span class="text-sm font-medium">Feedback telah diberikan</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center glass-card">
                        <div class="flex flex-col items-center">
                            <svg class="w-16 h-16 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <p class="text-slate-400 text-lg">Kamu tidak mempunyai sejarah penyewaan barang.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Feedback Modal -->
        <div id="feedbackModal"
            class="fixed inset-0 z-[100] flex items-center justify-center hidden p-4 animate-fade-in">
            <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeFeedbackModal()"></div>
            <div class="glass-card bg-slate-900 w-full max-w-md p-8 relative z-10 shadow-2xl border-white/20">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-white">Beri Feedback</h3>
                    <button onclick="closeFeedbackModal()" class="text-slate-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <p id="modal-barang-name" class="text-indigo-400 font-medium mb-6"></p>

                <form action="{{ route('storeFeedback') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_barang" id="modal_id_barang">
                    <input type="hidden" name="id_penyewaan" id="modal_id_penyewaan">

                    <div class="mb-6">
                        <label for="rating" class="block mb-2 text-sm font-medium text-slate-300 uppercase tracking-wider">Rating Pengalaman</label>
                        <div class="grid grid-cols-5 gap-2">
                            @for($i=1; $i<=5; $i++)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="rating" value="{{ $i }}" class="peer sr-only" required {{ $i == 5 ? 'checked' : '' }}>
                                    <div class="flex items-center justify-center p-3 rounded-xl border border-white/10 bg-white/5 peer-checked:bg-indigo-600 peer-checked:border-indigo-500 transition-all text-slate-400 peer-checked:text-white">
                                        <span class="font-bold text-lg">{{ $i }}</span>
                                    </div>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="komentar" class="block mb-2 text-sm font-medium text-slate-300 uppercase tracking-wider">Komentar (Opsional)</label>
                        <textarea name="komentar" id="komentar" rows="4" 
                            placeholder="Ceritakan pengalaman Anda menggunakan alat ini..."
                            class="block w-full p-4 bg-slate-950/50 border border-white/10 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-white placeholder-slate-600"></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 shadow-lg shadow-indigo-600/25">
                            Kirim Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('pages.layout.footer')

    @include('pages.layout.script')
    
    <script>
        function openFeedbackModal(idBarang, idPenyewaan, namaBarang) {
            document.getElementById('modal_id_barang').value = idBarang;
            document.getElementById('modal_id_penyewaan').value = idPenyewaan;
            document.getElementById('modal-barang-name').innerText = "Produk: " + namaBarang;
            document.getElementById('feedbackModal').classList.remove('hidden');
            document.getElementById('feedbackModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeFeedbackModal() {
            document.getElementById('feedbackModal').classList.add('hidden');
            document.getElementById('feedbackModal').classList.remove('flex');
            document.body.style.overflow = '';
        }

        function showTab(tabId) {
            // Hide all content sections
            const contents = ['booked', 'rented', 'history'];
            contents.forEach(id => {
                document.getElementById(`content-${id}`).classList.add('hidden');
                
                const tab = document.getElementById(`tab-${id}`);
                tab.classList.remove('tab-active');
                tab.classList.add('tab-inactive');
            });

            // Show selected content section
            document.getElementById(`content-${tabId}`).classList.remove('hidden');

            // Add active styles to selected tab
            const activeTab = document.getElementById(`tab-${tabId}`);
            activeTab.classList.add('tab-active');
            activeTab.classList.remove('tab-inactive');
        }

        // Initialize AOS
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-quad',
                    once: true
                });
            }
        });
    </script>
</body>
</html>
