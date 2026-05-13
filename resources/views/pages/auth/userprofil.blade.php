<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Adventurer Profile - CampRover</title>
</head>

<body class="bg-slate-950 overflow-x-hidden">
    @include('pages.layout.nav')

    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute top-0 left-0 w-1/2 h-1/2 bg-indigo-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-purple-600/10 rounded-full blur-[120px]"></div>
    </div>

    <main class="container mx-auto px-6 pt-32 pb-24 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-12" data-aos="fade-down">
                <h1 class="text-4xl font-black text-white tracking-tighter mb-4">ADVENTURER PROFILE</h1>
                <div class="h-1 w-20 bg-indigo-600 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sidebar: Avatar & Info -->
                <div class="lg:col-span-1" data-aos="fade-right">
                    <div class="glass-card p-8 flex flex-col items-center text-center">
                        <div class="relative group mb-6">
                            <div class="w-32 h-32 rounded-[2rem] overflow-hidden border-4 border-white/10 shadow-2xl transition-transform duration-500 group-hover:scale-105">
                                <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=4f46e5&color=fff' }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-600/40">
                                <i class="fa-solid fa-camera text-xs"></i>
                            </div>
                        </div>
                        <h2 class="text-xl font-black text-white mb-2 tracking-tight">{{ $user->name }}</h2>
                        <p class="text-slate-400 text-sm font-medium mb-6 uppercase tracking-widest">{{ $user->email }}</p>
                        
                        <div class="w-full pt-6 border-t border-white/5 space-y-4">
                            <div class="flex justify-between items-center px-2">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Status</span>
                                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-black rounded-md uppercase tracking-tighter tracking-widest">Active Member</span>
                            </div>
                            <div class="flex justify-between items-center px-2">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Joined</span>
                                <span class="text-white text-xs font-bold tracking-tight">{{ $user->created_at ? $user->created_at->format('M Y') : 'May 2024' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content: Edit Profile -->
                <div class="lg:col-span-2" data-aos="fade-left">
                    <div class="glass-card p-10 h-full">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="w-12 h-12 rounded-2xl glass border-white/10 flex items-center justify-center text-indigo-500">
                                <i class="fa-solid fa-user-gear text-xl"></i>
                            </div>
                            <h2 class="text-2xl font-black text-white tracking-tight">Account Settings</h2>
                        </div>

                        @if(session('success'))
                            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl mb-8 flex items-center gap-3">
                                <i class="fa-solid fa-circle-check"></i>
                                <span class="text-sm font-bold uppercase tracking-widest">{{ session('success') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Full Name</label>
                                    <div class="relative">
                                        <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                            class="w-full bg-slate-950/50 border border-white/5 rounded-2xl pl-12 pr-6 py-4 text-white focus:border-indigo-500 outline-none transition-all font-bold tracking-tight"
                                            placeholder="Enter your name">
                                    </div>
                                    @error('name')
                                        <p class="text-rose-500 text-[10px] font-black mt-2 uppercase tracking-widest">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Email Address</label>
                                    <div class="relative">
                                        <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                            class="w-full bg-slate-950/50 border border-white/5 rounded-2xl pl-12 pr-6 py-4 text-white focus:border-indigo-500 outline-none transition-all font-bold tracking-tight"
                                            placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <p class="text-rose-500 text-[10px] font-black mt-2 uppercase tracking-widest">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="photo" class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Profile Picture</label>
                                    <div class="glass border-dashed border-white/10 rounded-2xl p-4 transition-all hover:border-indigo-500/50">
                                        <input type="file" id="photo" name="photo" 
                                            class="w-full text-slate-400 text-xs font-bold file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-indigo-600 file:text-white file:cursor-pointer hover:file:bg-indigo-500 file:transition-all">
                                    </div>
                                    @error('photo')
                                        <p class="text-rose-500 text-[10px] font-black mt-2 uppercase tracking-widest">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="w-full btn-premium py-5 rounded-2xl text-white font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-600/20 transition-all hover:-translate-y-1">
                                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Save Changes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('pages.layout.footer')

    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>
    @include('pages.layout.script')
</body>

</html>
