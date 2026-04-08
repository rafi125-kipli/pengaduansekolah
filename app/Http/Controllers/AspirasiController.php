<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function create()
    {
        return view('aspirasi.create', [
            'kategoris' => Kategori::orderBy('ket_kategori')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nis' => 'required|string|size:10',
            'kelas' => 'required|string|max:10',
            'id_kategori' => 'required|integer|exists:kategoris,id_kategori',
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:50',
        ]);

        $siswa = Siswa::updateOrCreate(
            ['nis' => $data['nis']],
            ['kelas' => $data['kelas']]
        );

        $inputAspirasi = InputAspirasi::create([
            'nis' => $siswa->nis,
            'id_kategori' => $data['id_kategori'],
            'lokasi' => $data['lokasi'],
            'ket' => $data['ket'],
        ]);

        Aspirasi::create([
            'id_pelaporan' => $inputAspirasi->id_pelaporan,
            'id_kategori' => $data['id_kategori'],
            'status' => 'Menunggu',
        ]);

        return redirect()->route('aspirasi.selesai');
    }

    public function selesai()
    {
        return view('aspirasi.selesai');
    }

    public function siswaHistory(Request $request)
    {
        $nis = $request->query('nis');
        $aspirasis = null;
        $siswa = null;

        if ($nis) {
            $request->validate([
                'nis' => 'required|string|size:10',
            ]);

            $aspirasis = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.kategori'])
                ->whereHas('inputAspirasi', function ($query) use ($nis) {
                    $query->where('nis', $nis);
                })
                ->orderByDesc('created_at')
                ->get();

            $siswa = Siswa::find($nis);
            $statusCounts = $aspirasis->groupBy('status')->map->count()->toArray();
        }

        return view('siswa.history', [
            'nis' => $nis,
            'aspirasis' => $aspirasis,
            'siswa' => $siswa,
            'statusCounts' => $statusCounts ?? [],
        ]);
    }

    public function adminIndex(Request $request)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $statuses = ['Menunggu', 'Proses', 'Selesai'];
        $query = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.kategori']);

        $filterStatus = $request->query('status');
        $filterKategori = $request->query('id_kategori');
        $filterNis = $request->query('nis');
        $filterStartDate = $request->query('start_date');
        $filterEndDate = $request->query('end_date');

        if ($filterStatus && in_array($filterStatus, $statuses, true)) {
            $query->where('status', $filterStatus);
        }

        if ($filterKategori) {
            $query->where('id_kategori', $filterKategori);
        }

        if ($filterNis) {
            $query->whereHas('inputAspirasi', function ($nested) use ($filterNis) {
                $nested->where('nis', $filterNis);
            });
        }

        if ($filterStartDate) {
            $query->whereDate('created_at', '>=', $filterStartDate);
        }

        if ($filterEndDate) {
            $query->whereDate('created_at', '<=', $filterEndDate);
        }

        $aspirasis = $query->orderByDesc('created_at')->get();
        $kategoris = Kategori::orderBy('ket_kategori')->get();
        $statusCounts = Aspirasi::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return view('admin.dashboard', compact('aspirasis', 'kategoris', 'statusCounts', 'filterStatus', 'filterKategori', 'filterNis', 'filterStartDate', 'filterEndDate'));
    }

    public function edit(Request $request, $id)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $aspirasi = Aspirasi::with(['inputAspirasi.siswa', 'inputAspirasi.kategori'])->findOrFail($id);

        return view('admin.aspirasis.edit', [
            'aspirasi' => $aspirasi,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (! $request->session()->has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $data = $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string|max:500',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Status aspirasi berhasil diperbarui.');
    }
}
