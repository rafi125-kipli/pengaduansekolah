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

    public function edit(Request $request, $id_kategori)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $kategori = Kategori::findOrFail($id_kategori);

        return view('admin.kategoris.edit', [
            'kategori' => $kategori,
        ]);
    }

    public function update(Request $request, $id_kategori)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $kategori = Kategori::findOrFail($id_kategori);

        $data = $request->validate([
            'ket_kategori' => 'required|string|max:30|unique:kategoris,ket_kategori,' . $id_kategori . ',id_kategori',
        ]);

        $kategori->update($data);

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, $id_kategori)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
