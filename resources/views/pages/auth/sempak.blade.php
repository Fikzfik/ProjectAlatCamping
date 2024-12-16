<!DOCTYPE html>
<html lang="en">

<head>
    @include('pages.layout.head')
    <title>Home</title>
</head>

<body id="body" class="relative">
    @include('pages.layout.nav');
    
    @include('pages.layout.footer');
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    AOS.init();
</script>
@include('pages.layout.script');
</html>
