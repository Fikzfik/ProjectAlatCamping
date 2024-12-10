<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Tambahkan file CSS yang diperlukan -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #000000, #333333); /* Gradient untuk background */
            color: #fff; /* Teks putih */
        }
        .navbar {
            background-color: #222222;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(255, 255, 255, 0.1); /* Bayangan untuk navbar */
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #1a1a1a; /* Warna lebih gelap untuk kontainer */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); /* Bayangan kontainer */
        }
        .card {
            background-color: #333333; /* Warna kartu abu-abu gelap */
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(255, 255, 255, 0.1);
            border: 1px solid #444;
        }
        .card h2 {
            margin-top: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #444444; /* Input lebih gelap */
            color: white;
            font-size: 16px;
        }
        .form-group input[type="file"] {
            padding: 5px;
        }
        .btn {
            padding: 10px 20px;
            background-color: #444444;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #555555; /* Hover lebih terang */
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>User Profile</h1>
        <a href="{{ route('home') }}">Home</a>
    </div>

    <div class="container">
        <!-- Bagian Profil -->
        <div class="card">
            <h2>Profil</h2>
            <p><strong>Nama:</strong> {{ $user->name ?? 'John Doe' }}</p>
            <p><strong>Email:</strong> {{ $user->email ?? 'johndoe@example.com' }}</p>
            <p><strong>No HP:</strong> {{ $user->no_hp ?? '081234567890' }}</p>
        </div>

        <!-- Bagian Edit Profil -->
        <div class="card">
            <h2>Edit Profil</h2>
            <form action="{{ route('editprofil') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Edit Nama -->
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" value="{{ $user->name ?? '' }}" required>
                </div>

                <!-- Edit Foto Profil -->
                <div class="form-group">
                    <label for="photo">Foto Profil:</label>
                    <input type="file" id="photo" name="photo" accept="image/*">
                </div>

                <!-- Edit Email -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ $user->email ?? '' }}" required>
                </div>

                <button type="submit" class="btn">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
