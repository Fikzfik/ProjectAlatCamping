<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('src/css/output.css') }}">
<link rel="stylesheet" href="{{ asset('src/css/font.css') }}">
<link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="{{ asset('node_modules/aos/dist/aos.css') }}" rel="stylesheet">
<script src="{{ asset('node_modules/aos/dist/aos.js') }}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<style>
    /* Modal container */
    #dropdownList1 {
        transition: max-height 0.5s ease-in-out;
        max-height: 0;
        /* Initially closed */
    }

    .max-h-[20vw] {
        max-height: 20vw;
        /* Open state */
    }

    #kategoriModal {
        z-index: 9999;
        /* Modal harus berada di atas */
    }

    .swal2-container {
        z-index: 10500 !important;
    }

    .modal {
        position: fixed;
        /* Ensure it is fixed to the screen */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Optional: Dim the background */
        z-index: 9999;
        /* Set a high z-index value to ensure it appears on top */
    }

    /* Modal content */
    .modal-content {
        position: relative;
        /* Ensure modal content is above other content */
        z-index: 10000;
        /* Set a higher value if necessary */
        /* Other styling properties */
    }

    /* Optional custom styles to override defaults */
    #keranjangModal {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Overlay dan Modal */
    #overlay {
        z-index: 9999;
        /* Pastikan overlay selalu di atas */
    }

    #keranjangModal {
        z-index: 10000;
        max-height: 100vh;
        /* Maksimal tinggi modal 80% dari tinggi layar */
        overflow-y: auto;
    }

    /* Elemen Halaman Utama */
    body>*:not(#overlay):not(#keranjangModal) {
        z-index: auto;
        /* Pastikan elemen halaman utama tidak mengganggu */
    }

    .keranjang-item img {
        width: 80px;
        height: 120px;
        object-fit: cover;
        border-radius: 4px;
        /* Opsional: untuk membuat sudut gambar melengkung */
    }

    #keranjangContent {
        max-height: 60vh;
        /* Limit height of the cart items */
        overflow-y: auto;
        /* Add scroll if there are many items */
    }

    .keranjangItem {
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 16px;
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .keranjangItem img {
        width: 80px;
        /* Small image size for better alignment */
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-right: 16px;
        /* Add space between image and content */
    }

    .keranjangItem .flex-1 {
        flex: 1;
    }

    .keranjangItem .quantity-container {
        display: flex;
        align-items: center;
        gap: 12px;
        /* Reduce space between buttons */
    }

    .decrease-quantity,
    .increase-quantity {
        padding: 8px 12px;
        border-radius: 50%;
        font-size: 18px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .decrease-quantity {
        background-color: #f87171;
        /* Red background */
    }

    .increase-quantity {
        background-color: #3b82f6;
        /* Blue background */
    }

    .decrease-quantity:hover,
    .increase-quantity:hover {
        transform: scale(1.1);
        /* Slightly enlarge buttons on hover */
    }

    button.remove-item {
        font-size: 14px;
        text-color: red;
        transition: color 0.3s ease;
    }

    button.remove-item:hover {
        color: #e63946;
    }
</style>
{{-- <title><p>{{ $title }}</p></title> --}}
