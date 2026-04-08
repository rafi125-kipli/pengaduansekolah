<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.kategoris.index', [
            'kategoris' => Kategori::orderBy('ket_kategori')->get(),
        ]);
    }

    public function store(Request $request)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $data = $request->validate([
            'ket_kategori' => 'required|string|max:30|unique:kategoris,ket_kategori',
        ]);

        Kategori::create($data);

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
}
