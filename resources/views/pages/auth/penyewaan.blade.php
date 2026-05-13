<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-jM8424hiu2OrzsAl"></script>
    <title>Checkout - CampRover</title>
</head>

<body class="bg-slate-950 overflow-x-hidden">
    @include('pages.layout.nav')

    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-1/2 h-1/2 bg-indigo-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-purple-600/10 rounded-full blur-[120px]"></div>
    </div>

    <main class="container mx-auto px-6 pt-32 pb-24 min-h-screen">
        <div class="mb-12" data-aos="fade-down">
            <h1 class="text-4xl font-black text-white tracking-tighter mb-4">RENTAL CHECKOUT</h1>
            <div class="h-1 w-20 bg-indigo-600 rounded-full"></div>
        </div>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Left Side: Items List -->
            <div class="lg:w-2/3 space-y-6" data-aos="fade-right">
                @if(count($keranjangs) == 0)
                    <div class="glass-card p-20 text-center">
                        <div class="w-24 h-24 bg-indigo-600/10 rounded-3xl flex items-center justify-center mx-auto mb-8">
                            <i class="fa-solid fa-cart-shopping text-4xl text-indigo-500"></i>
                        </div>
                        <h2 class="text-2xl font-black text-white mb-4">Your cart is empty</h2>
                        <p class="text-slate-400 mb-10 max-w-sm mx-auto">Mulai petualanganmu dengan memilih perlengkapan camping terbaik kami.</p>
                        <a href="{{ route('home') }}" class="btn-premium px-10 py-4 rounded-xl text-white font-black uppercase tracking-widest inline-block">Explore Gear</a>
                    </div>
                @else
                    @foreach ($keranjangs as $keranjang)
                        <div class="item-card glass-card p-6 flex flex-col md:flex-row items-center gap-8 cursor-pointer transition-all duration-500 group relative overflow-hidden selected"
                             data-id="{{ $keranjang->id_keranjang }}" data-selected="true" onclick="toggleSelection(this)">
                            
                            <!-- Selection Overlay -->
                            <div class="absolute inset-0 bg-indigo-600/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            
                            <!-- Image -->
                            <div class="w-32 h-32 rounded-2xl overflow-hidden border border-white/10 shadow-2xl relative z-10 shrink-0">
                                <img src="{{ asset('storage/' . $keranjang->link_foto) }}"
                                     alt="{{ $keranjang->nama_barang }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-2 left-2 w-6 h-6 bg-indigo-600 rounded-lg flex items-center justify-center text-white text-[10px] shadow-lg">
                                    <i class="fa-solid fa-check check-icon"></i>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="flex-1 relative z-10 text-center md:text-left">
                                <h2 class="text-xl font-black text-white mb-2 tracking-tight group-hover:text-indigo-400 transition-colors">{{ $keranjang->nama_barang }}</h2>
                                <p class="text-slate-400 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $keranjang->deskripsi }}</p>
                                <div class="text-xl font-black text-indigo-400 tracking-tighter price-val">
                                    Rp{{ number_format($keranjang->harga_sewa, 0, ',', '.') }}<span class="text-[10px] text-slate-500 ml-1">/ day</span>
                                </div>
                            </div>

                            <!-- Controls -->
                            <div class="flex items-center gap-4 bg-slate-950/50 rounded-2xl p-2 border border-white/5 relative z-10" onclick="event.stopPropagation()">
                                <button onclick="updateQuantity('{{ $keranjang->id_keranjang }}', -1, event)"
                                        class="w-10 h-10 rounded-xl glass border-white/10 flex items-center justify-center text-white hover:bg-rose-500/20 hover:text-rose-500 transition-all">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </button>
                                <span id="jumlah-barang-{{ $keranjang->id_keranjang }}" class="w-8 text-center text-lg font-black text-white tracking-tighter">
                                    {{ $keranjang->jumlah_barang }}
                                </span>
                                <button onclick="updateQuantity('{{ $keranjang->id_keranjang }}', 1, event)"
                                        class="w-10 h-10 rounded-xl glass border-white/10 flex items-center justify-center text-white hover:bg-emerald-500/20 hover:text-emerald-500 transition-all">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Right Side: Summary Sticky -->
            <div class="lg:w-1/3">
                <div class="glass-card p-10 sticky top-32" data-aos="fade-left">
                    <h2 class="text-2xl font-black text-white mb-8 tracking-tight flex items-center gap-3">
                        <i class="fa-solid fa-receipt text-indigo-500"></i>
                        Order Summary
                    </h2>

                    <!-- Date Selection -->
                    <div class="space-y-6 mb-10">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Rental Duration</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase ml-1">Start</span>
                                    <input type="date" id="tanggalSewa" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:border-indigo-500 outline-none transition-all font-bold">
                                </div>
                                <div class="space-y-2">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase ml-1">End</span>
                                    <input type="date" id="tanggalKembali" class="w-full bg-slate-950/50 border border-white/10 rounded-xl px-4 py-3 text-xs text-white focus:border-indigo-500 outline-none transition-all font-bold">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Breakdowns -->
                    <div id="subtotalList" class="space-y-4 mb-10 border-y border-white/5 py-8">
                        <!-- Dynamic content -->
                    </div>

                    <!-- Final Total -->
                    <div class="flex justify-between items-end mb-10 px-2">
                        <div>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Total Amount</span>
                            <div id="totalPembayaran" class="text-4xl font-black text-white tracking-tighter mt-1">Rp0</div>
                        </div>
                        <div class="text-right">
                            <span id="day-count" class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">0 Days</span>
                        </div>
                    </div>

                    <button id="submitPayment" class="w-full btn-premium py-6 rounded-2xl text-white font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-600/30 group">
                        Proceed to Payment
                        <i class="fa-solid fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>

    @include('pages.layout.footer')

    <style>
        .item-card.selected {
            border-color: rgba(79, 70, 229, 0.5);
            background: rgba(79, 70, 229, 0.05);
        }
        .item-card:not(.selected) {
            opacity: 0.5;
            filter: grayscale(1);
        }
        .item-card:not(.selected) .check-icon {
            display: none;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateTotalPembayaran();
            
            document.getElementById('tanggalSewa').addEventListener('input', updateTotalPembayaran);
            document.getElementById('tanggalKembali').addEventListener('input', updateTotalPembayaran);
        });

        function updateTotalPembayaran() {
            const selectedItems = document.querySelectorAll('.item-card.selected');
            let total = 0;
            const subtotalList = document.getElementById('subtotalList');
            subtotalList.innerHTML = '';

            const tglSewa = document.getElementById('tanggalSewa').value;
            const tglKembali = document.getElementById('tanggalKembali').value;
            let diffDays = 0;

            if (tglSewa && tglKembali) {
                const start = new Date(tglSewa);
                const end = new Date(tglKembali);
                const diffTime = end - start;
                // Inclusive days: (end - start) + 1
                diffDays = Math.max(0, Math.ceil(diffTime / (1000 * 60 * 60 * 24))) + 1;
            }

            document.getElementById('day-count').textContent = `${diffDays} Days`;

            if (selectedItems.length === 0) {
                subtotalList.innerHTML = '<div class="text-slate-500 text-xs font-bold text-center italic">No items selected</div>';
            }

            selectedItems.forEach(item => {
                const nama = item.querySelector('h2').textContent;
                const hargaText = item.querySelector('.price-val').textContent.split('/')[0];
                const harga = parseInt(hargaText.replace(/[^\d]/g, ''));
                const jumlah = parseInt(item.querySelector('span[id^="jumlah-barang-"]').textContent);
                
                const itemSub = harga * jumlah * (diffDays || 0);
                total += itemSub;

                const row = document.createElement('div');
                row.className = 'flex justify-between items-center text-xs font-bold';
                row.innerHTML = `
                    <span class="text-slate-400">${nama} (${jumlah}x)</span>
                    <span class="text-white">Rp${itemSub.toLocaleString('id-ID')}</span>
                `;
                subtotalList.appendChild(row);
            });

            document.getElementById('totalPembayaran').textContent = `Rp${total.toLocaleString('id-ID')}`;
        }

        function updateQuantity(id, change, event) {
            event.stopPropagation();
            const el = document.getElementById(`jumlah-barang-${id}`);
            let val = parseInt(el.textContent);
            val = Math.max(1, val + change);
            el.textContent = val;

            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const endpoint = change > 0 ? '/keranjang/increase' : '/keranjang/decrease';

            fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                body: JSON.stringify({ id_keranjang: id, jumlah: val })
            }).then(() => updateTotalPembayaran());
        }

        function toggleSelection(el) {
            const isSelected = el.getAttribute('data-selected') === 'true';
            el.setAttribute('data-selected', !isSelected);
            el.classList.toggle('selected');
            updateTotalPembayaran();
        }

        document.getElementById('submitPayment').addEventListener('click', () => {
            const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const selectedItems = document.querySelectorAll('.item-card.selected');
            const tglSewa = document.getElementById('tanggalSewa').value;
            const tglKembali = document.getElementById('tanggalKembali').value;

            if (!tglSewa || !tglKembali) {
                return Swal.fire({ title: 'Invalid Dates', text: 'Please select rental dates.', icon: 'warning' });
            }
            if (selectedItems.length === 0) {
                return Swal.fire({ title: 'No Gear Selected', text: 'Select at least one item to rent.', icon: 'warning' });
            }

            const items = [];
            let total = 0;
            const diffTime = new Date(tglKembali) - new Date(tglSewa);
            const days = Math.max(0, Math.ceil(diffTime / (1000 * 60 * 60 * 24))) + 1;

            selectedItems.forEach(item => {
                const id = item.dataset.id;
                const qty = parseInt(item.querySelector('span[id^="jumlah-barang-"]').textContent);
                const hargaText = item.querySelector('.price-val').textContent.split('/')[0];
                const price = parseInt(hargaText.replace(/[^\d]/g, ''));
                const sub = price * qty * days;
                const name = item.querySelector('h2').textContent.trim();
                total += sub;
                items.push({ id_keranjang: id, jumlah: qty, harga_sewa: price, subtotal: sub, tanggal_sewa: tglSewa, tanggal_kembali: tglKembali, nama_barang: name });
            });

            fetch('/pembayaran', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                body: JSON.stringify({ total_pembayaran: total, items: items })
            }).then(r => r.json()).then(data => {
                if (data.success) {
                    window.snap.pay(data.data.token, {
                        onSuccess: () => window.location.href = '/history',
                        onPending: () => Swal.fire('Pending', 'Payment pending...', 'info'),
                        onError: () => Swal.fire('Error', 'Payment failed!', 'error')
                    });
                } else {
                    Swal.fire('Failed', data.message, 'error');
                }
            });
        });
    </script>
    <script>AOS.init({ duration: 800, once: true });</script>
    @include('pages.layout.script')
</body>
</html>
