<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Home</title>
</head>

<body id="body" class="text-white relative">
    @include('pages.layout.nav');
    <section class="sm:px-[4.271vw] px-[8.372vw] relative pb-[1vw] mt-[5.625vw]">
            <h1 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw]">Manajemen Stok</h1>
            
            <form id="form-manage-stock" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-y-[2vw]">

                    <div class="flex flex-col">
                        <label for="quantity" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Id Barang</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Masukkan jumlah"
                            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                    </div>
                     <!-- Nama Produk -->
                    <div class="flex flex-col">
                        <label for="product_name" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Nama Produk</label>
                        <input type="text" name="product_name" id="product_name" placeholder="Masukkan nama produk"
                            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                    </div>
    
                    <!-- Jumlah -->
                    <div class="flex flex-col">
                        <label for="quantity" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" placeholder="Masukkan jumlah"
                            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                    </div>
    
                    <!-- Harga -->
                    <div class="flex flex-col">
                        <label for="price" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Harga</label>
                        <input type="number" name="price" id="price" placeholder="Masukkan harga"
                            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md">
                    </div>
    
                    <!-- Deskripsi -->
                    <div class="flex flex-col">
                        <label for="description" class="sm:text-[1.042vw] text-[4.581vw] font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" id="description" placeholder="Masukkan deskripsi produk"
                            class="sm:px-[0.833vw] px-[3.721vw] sm:py-[0.625vw] py-[1.93vw] bg-black text-white rounded-md"></textarea>
                    </div>
                </div>
    
                <!-- Tombol Simpan -->
                <div class="flex justify-end mt-[2vw]">
                    <button type="submit"
                        class="sm:px-[1.5vw] px-[5vw] sm:py-[0.833vw] py-[2vw] bg-blue-500 text-white rounded-md">
                        Simpan Stok
                    </button>
                </div>
            </form>
    
            <!-- Tabel Stok -->
            <h2 class="text-center sm:text-[3.333vw] text-[5.581vw] leading-none mb-[2vw] mt-[4vw]">Daftar Stok</h2>
            <div class="overflow-x-auto bg-black shadow-md rounded-lg">
                <table id="stockTable" class="w-full text-left text-sm bg-black text-white">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-sm font-medium uppercase">No</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase">Id Barang</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase">Nama Produk</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase">Harga</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-sm font-medium uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh data stok -->
                        <tr>
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">SKU1234</td>
                            <td class="px-6 py-4">Produk A</td>
                            <td class="px-6 py-4">10</td>
                            <td class="px-6 py-4">Rp 100.000</td>
                            <td class="px-6 py-4">Deskripsi produk A</td>
                            <td class="px-6 py-4">
                                <button class="text-blue-500 hover:underline">Edit</button>
                                <button class="text-red-500 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </body>
    

        
    @include('pages.layout.footer');
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    AOS.init();
</script>
@include('pages.layout.script');
</html>