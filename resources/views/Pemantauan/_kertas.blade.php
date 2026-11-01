@use('App\Models\PemantauanForm', 'F')
@php
    $edit = $edit ?? false;
    $dok = F::DOKUMEN;

    // nilai: old() -> data tersimpan
    $val = fn(string $name, $default) => old(str_replace(['[', ']'], ['.', ''], $name), $default);

    // kolom isian: input saat mode edit, teks biasa saat mode lihat/cetak
    $in = function (string $name, $default, string $type = 'text', string $ph = '', string $cls = '') use (
        $edit,
        $val,
    ) {
        $v = $val($name, $default);
        if ($edit) {
            $raw = $type === 'date' && $v ? \Illuminate\Support\Carbon::parse($v)->format('Y-m-d') : $v;
            return '<input class="in ' .
                $cls .
                '" type="' .
                $type .
                '" name="' .
                e($name) .
                '" value="' .
                e($raw) .
                '" placeholder="' .
                e($ph) .
                '">';
        }
        if ($v === null || $v === '') {
            return '<span class="ph ' . $cls . '">' . e($ph) . '</span>';
        }
        $t = $type === 'date' ? \Illuminate\Support\Carbon::parse($v)->translatedFormat('d F Y') : $v;
        return e($t);
    };

    // pilihan V / X
    $sel = function (string $name, $default) use ($edit, $val) {
        $v = $val($name, $default);
        if (!$edit) {
            return e($v);
        }
        return '<select class="in" name="' .
            e($name) .
            '"><option value=""></option>' .
            '<option value="V"' .
            ($v === 'V' ? ' selected' : '') .
            '>V</option>' .
            '<option value="X"' .
            ($v === 'X' ? ' selected' : '') .
            '>X</option></select>';
    };

    $tglDefault = $form->tanggal ?: ($edit && !$form->exists ? now() : null);
    $bulanVal = old('bulan', $form->bulan ?? ($edit && !$form->exists ? now()->month : null));
@endphp

<div class="paper {{ $edit ? 'edit' : '' }}">

    {{-- ===== HEADER ===== --}}
    <table class="hdr">
        <tr>
            <td class="logo" rowspan="2" style="height:68px">
                <img src="{{ asset('images/logo-kai.png') }}" alt="KAI">
            </td>
            <td class="judul" rowspan="2">{{ $dok['perusahaan'] }}<br>{{ $dok['divisi'] }}</td>
            <td class="lbl">Nomor</td>
            <td class="val">
                <div style="display:flex; gap:4px; align-items:center">:&nbsp;{!! $in('doc_nomor', $form->doc_nomor ?: $dok['nomor']) !!}</div>
            </td>
        </tr>
        <tr>
            <td class="lbl">Tanggal Terbit</td>
            <td class="val">
                <div style="display:flex; gap:4px; align-items:center">:&nbsp;{!! $in('doc_tanggal', $form->doc_tanggal ?: $dok['tanggal']) !!}</div>
            </td>
        </tr>
        <tr>
            <td class="logo" rowspan="2" style="height:68px"><span class="terbatas">TERBATAS</span></td>
            <td class="judul" rowspan="2">
                @foreach ($dok['judul'] as $baris)
                    {{ $baris }}<br>
                @endforeach
            </td>
            <td class="lbl">Status Revisi</td>
            <td class="val">
                <div style="display:flex; gap:4px; align-items:center">:&nbsp;{!! $in('doc_revisi', $form->doc_revisi ?: $dok['revisi']) !!}</div>
            </td>
        </tr>
        <tr>
            <td class="lbl">Halaman</td>
            <td class="val">
                <div style="display:flex; gap:4px; align-items:center">:&nbsp;{!! $in('doc_halaman', $form->doc_halaman ?: $dok['halaman']) !!}</div>
            </td>
        </tr>
    </table>

    {{-- ===== NO REF / TANGGAL / BUSINESS AREA ===== --}}
    <table class="ref">
        <tr>
            <td class="k">No Ref</td>
            <td class="c">:</td>
            <td class="v">{!! $in('no_ref', $form->no_ref, 'text', '__ / __ / ___') !!}</td>
        </tr>
        <tr>
            <td class="k">Tanggal</td>
            <td class="c">:</td>
            <td class="v">{!! $in('tanggal', $tglDefault, 'date', '__ / __ / ____') !!}</td>
        </tr>
        <tr>
            <td class="k">Business Area</td>
            <td class="c">:</td>
            <td class="v">{!! $in('business_area', $form->business_area, 'text', '____') !!}</td>
        </tr>
    </table>

    {{-- ===== TABEL CHECKLIST ===== --}}
    <table class="tbl">
        <colgroup>
            <col style="width:34px">
            <col style="width:175px">
            @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                <col>
            @endfor
        </colgroup>

        <tr>
            <td class="lab nomor" rowspan="6" style="background:#d9d9d9">No</td>
            <td class="lab">Periode</td>
            <td colspan="{{ F::JUMLAH_MINGGU }}" class="ctr">
                Bulan :
                @if ($edit)
                    <select name="bulan" class="in"
                        style="width:auto; font-size:11px; text-align:left; text-align-last:left">
                        <option value=""></option>
                        @foreach (F::BULAN as $n => $nama)
                            <option value="{{ $n }}" @selected($bulanVal == $n)>{{ $nama }}
                            </option>
                        @endforeach
                    </select>
                @else
                    {{ F::BULAN[$bulanVal] ?? '.................' }}
                @endif
                &nbsp;&nbsp;&nbsp;&nbsp; Tahun :
                @if ($edit)
                    <input class="in" type="number" name="tahun" min="2000" max="2100"
                        style="width:70px; font-weight:700" value="{{ old('tahun', $form->tahun ?? now()->year) }}">
                @else
                    {{ $form->tahun ?: '…............' }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="lab">Minggu ke-</td>
            @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                <th class="m">M{{ $m + 1 }}</th>
            @endfor
        </tr>
        <tr>
            <td class="lab">Ruangan</td>
            @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                <td class="ctr">{!! $in("minggu[$m][ruangan]", $form->infoMinggu($m, 'ruangan') ?: 'Network') !!}</td>
            @endfor
        </tr>
        <tr>
            <td class="lab">Tanggal Pelaksanaan</td>
            @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                <td class="ctr">{!! $in("minggu[$m][tanggal]", $form->infoMinggu($m, 'tanggal'), 'date', '(tanggal pemantauan)', 'red') !!}</td>
            @endfor
        </tr>
        <tr>
            <td class="lab">Jam Pengecekan</td>
            @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                <td class="ctr">{!! $in("minggu[$m][jam]", $form->infoMinggu($m, 'jam'), 'time', '(waktu / jam pemantauan)', 'red') !!}</td>
            @endfor
        </tr>
        <tr>
            <td class="lab">Subject</td>
            @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                <td class="gray"></td>
            @endfor
        </tr>

        @foreach (F::SUBJECTS as $i => $subject)
            <tr>
                <td class="nomor c">{{ $i + 1 }}</td>
                <td class="sub">{{ $subject }}</td>
                @for ($m = 0; $m < F::JUMLAH_MINGGU; $m++)
                    <td class="chk">{!! $sel("checklist[$i][$m]", $form->nilai($i, $m)) !!}</td>
                @endfor
            </tr>
        @endforeach
    </table>

    {{-- ===== CATATAN ===== --}}
    <div class="catatan">
        Catatan :
        <div class="box">
            @if ($edit)
                <textarea class="in" name="catatan" rows="4"
                    placeholder="(catatan mengenai pemantauan ruang network/jaringan, jika ada)">{{ old('catatan', $form->catatan) }}</textarea>
            @else
                @if ($form->catatan)
                    {{ $form->catatan }}
                @else
                    <span class="ph red">(catatan mengenai pemantauan ruang network/jaringan, jika ada)</span>
                @endif
            @endif
        </div>
    </div>

    {{-- ===== KETERANGAN + TANDA TANGAN ===== --}}
    <table class="ttd">
        <tr>
            <td style="width:30%" class="kecil">
                Keterangan :<br>V : Kondisi Baik<br>X : Kondisi Kurang Baik
            </td>
            <td style="width:35%; text-align:center">
                Mengetahui,
                <div class="garis"></div>
                <div class="nama">{!! $in('mengetahui_nama', $form->mengetahui_nama, 'text', '', 'ctr') !!}</div>
                <div class="nipp">NIPP. {!! $in('mengetahui_nipp', $form->mengetahui_nipp, 'text', '........................') !!}</div>
            </td>
            <td style="width:35%; text-align:center">
                <div style="display:flex; justify-content:center; gap:4px; align-items:center">
                    <span style="width:150px">{!! $in('petugas_kota', $form->petugas_kota, 'text', '..............................') !!}</span>,
                    <span style="width:170px">{!! $in('petugas_tanggal', $form->petugas_tanggal, 'date', '..............................') !!}</span>
                </div>
                Petugas
                <div class="garis" style="height:34px"></div>
                <div class="nama">{!! $in('petugas_nama', $form->petugas_nama, 'text', '', 'ctr') !!}</div>
                <div class="nipp">NIPP. {!! $in('petugas_nipp', $form->petugas_nipp, 'text', '........................') !!}</div>
            </td>
        </tr>
    </table>
</div>
