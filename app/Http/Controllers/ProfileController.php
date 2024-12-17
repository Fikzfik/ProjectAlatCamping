<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Ambil objek user yang sedang login
        $user = auth()->user();

        // Update data pengguna langsung tanpa validasi
        DB::update('update users set name = ?, email = ? where id_user = ?', [$request->input('name'), $request->input('email'), $user->id_user]);

        // Update data pengguna menggunakan Eloquent untuk foto
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika ada foto yang diunggah
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                // Hapus foto lama
                Storage::delete($user->photo);
            }

            // Simpan foto baru
            $user->photo = $request->file('photo')->store('photos', 'public');
        }

        // Simpan perubahan ke database
        $user->save();

        return redirect()->route('userprofil')->with('success', 'Profil berhasil diperbarui!');
    }
}
