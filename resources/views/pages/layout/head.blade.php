<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('src/css/output.css') }}">
<link rel="stylesheet" href="{{ asset('src/css/font.css') }}">
<link rel="stylesheet" href="{{ asset('src/css/style.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<style>
    :root {
        --primary: #6366f1;
        --primary-hover: #4f46e5;
        --secondary: #a855f7;
        --accent: #10b981;
        --dark: #0f172a;
        --slate-800: #1e293b;
        --slate-900: #0f172a;
        --glass: rgba(255, 255, 255, 0.05);
        --glass-border: rgba(255, 255, 255, 0.1);
        --glass-blur: blur(12px);
    }

    body {
        font-family: 'Outfit', 'Inter', sans-serif;
        background-color: var(--dark);
        color: #f1f5f9;
        -webkit-font-smoothing: antialiased;
    }

    .glass {
        background: var(--glass);
        backdrop-filter: var(--glass-blur);
        -webkit-backdrop-filter: var(--glass-blur);
        border: 1px solid var(--glass-border);
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.06);
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .btn-premium {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-premium:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
    }

    .text-gradient {
        background: linear-gradient(135deg, #fff 0%, #cbd5e1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: var(--dark);
    }

    ::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 5px;
        border: 2px solid var(--dark);
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }

    /* DataTables Overrides */
    .dataTables_wrapper {
        color: #94a3b8 !important;
    }
    
    table.dataTable.no-footer {
        border-bottom: 1px solid var(--glass-border) !important;
    }

    .dataTables_length select, .dataTables_filter input {
        background-color: var(--slate-800) !important;
        border: 1px solid var(--glass-border) !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
    }

    /* Modal Styling */
    .modal-premium {
        background: rgba(15, 23, 42, 0.8);
        backdrop-filter: blur(8px);
    }
</style>
{{-- <title><p>{{ $title }}</p></title> --}}
