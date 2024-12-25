<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UMKM;

class VerifikasiController extends Controller
{
    public function index()
    {
        $umkmData = UMKM::where('status', 'pending')->get();
        return view('verifikasi', compact('umkmData')); // Hanya data pending yang ditampilkan
    }

    public function create()
    {
        return view('umkm.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_toko' => 'required',
            'nama_pemilik' => 'required',
            'jenis_usaha' => 'required',
            'alamat_usaha' => 'required',
            'nib' => 'required',
            'no_hp_wa' => 'required',
        ]);

        $validatedData['status'] = 'pending'; // Set status awal menjadi 'pending'
        UMKM::create($validatedData);

        return redirect()->route('verifikasi.index')->with('success', 'Data UMKM berhasil ditambahkan!');
    }

  
}
