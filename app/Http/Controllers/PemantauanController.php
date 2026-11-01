<?php

namespace App\Http\Controllers;

use App\Models\PemantauanForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PemantauanController extends Controller
{
    public function index(): View
    {
        $forms = PemantauanForm::latest()->paginate(10);

        return view('pemantauan.index', compact('forms'));
    }

    public function create(): View
    {
        return view('pemantauan.create', ['form' => new PemantauanForm()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $form = PemantauanForm::create($this->bersihkan($request));

        return redirect()->route('pemantauan.show', $form)
            ->with('sukses', 'Formulir berhasil disimpan.');
    }

    public function show(PemantauanForm $pemantauan): View
    {
        return view('pemantauan.show', ['form' => $pemantauan]);
    }

    public function edit(PemantauanForm $pemantauan): View
    {
        return view('pemantauan.edit', ['form' => $pemantauan]);
    }

    public function update(Request $request, PemantauanForm $pemantauan): RedirectResponse
    {
        $pemantauan->update($this->bersihkan($request));

        return redirect()->route('pemantauan.show', $pemantauan)
            ->with('sukses', 'Formulir berhasil diperbarui.');
    }

    public function destroy(PemantauanForm $pemantauan): RedirectResponse
    {
        $pemantauan->delete();

        return redirect()->route('pemantauan.index')
            ->with('sukses', 'Formulir dihapus.');
    }

    private function bersihkan(Request $request): array
    {
        $data = $request->validate([
            'no_ref'           => ['nullable', 'string', 'max:50'],
            'tanggal'          => ['nullable', 'date'],
            'business_area'    => ['nullable', 'string', 'max:50'],
            'bulan'            => ['nullable', 'integer', 'between:1,12'],
            'tahun'            => ['nullable', 'integer', 'between:2000,2100'],

            'minggu'           => ['nullable', 'array', 'max:' . PemantauanForm::JUMLAH_MINGGU],
            'minggu.*.ruangan' => ['nullable', 'string', 'max:100'],
            'minggu.*.tanggal' => ['nullable', 'date'],
            'minggu.*.jam'     => ['nullable', 'string', 'max:20'],

            'checklist'        => ['nullable', 'array'],
            'checklist.*.*'    => ['nullable', 'in:V,X'],

            'catatan'          => ['nullable', 'string', 'max:3000'],

            'mengetahui_nama'  => ['nullable', 'string', 'max:100'],
            'mengetahui_nipp'  => ['nullable', 'string', 'max:50'],
            'petugas_kota'     => ['nullable', 'string', 'max:100'],
            'petugas_tanggal'  => ['nullable', 'date'],
            'petugas_nama'     => ['nullable', 'string', 'max:100'],
            'petugas_nipp'     => ['nullable', 'string', 'max:50'],
        ]);

        $checklist = [];
        foreach (array_keys(PemantauanForm::SUBJECTS) as $i) {
            for ($m = 0; $m < PemantauanForm::JUMLAH_MINGGU; $m++) {
                $checklist[$i][$m] = $data['checklist'][$i][$m] ?? null;
            }
        }

        $minggu = [];
        for ($m = 0; $m < PemantauanForm::JUMLAH_MINGGU; $m++) {
            $minggu[$m] = [
                'ruangan' => $data['minggu'][$m]['ruangan'] ?? null,
                'tanggal' => $data['minggu'][$m]['tanggal'] ?? null,
                'jam'     => $data['minggu'][$m]['jam'] ?? null,
            ];
        }

        $data['checklist'] = $checklist;
        $data['minggu']    = $minggu;

        return $data;
    }
}
