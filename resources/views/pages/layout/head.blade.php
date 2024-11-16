<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Ganti path file CSS dengan asset() -->
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
<style>
    /* Modal container */
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
</style>
{{-- <title><p>{{ $title }}</p></title> --}}
