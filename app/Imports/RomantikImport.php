<?php

namespace App\Imports;

use App\Models\Romantik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RomantikImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Romantik([
            'id_kegiatan'    => $row['id_kegiatan'],
            'tahun'          => $row['tahun'],
            'status_dinas'   => $row['status_dinas'] ?? 'belum_diajukan',
            'status_kominfo' => $row['status_kominfo'] ?? 'sedang_diperiksa',
            'status_bps'     => $row['status_bps'] ?? 'sedang_diperiksa',
        ]);
    }

    public function rules(): array
    {
        return [
            // unique: relasi 1:1 dengan kegiatan_statistik
            'id_kegiatan'    => 'required|integer|exists:kegiatan_statistik,id|unique:romantik,id_kegiatan',
            'tahun'          => 'required|integer|min:2020|max:2099',
            'status_dinas'   => 'nullable|string|in:belum_diajukan,sudah_diajukan,belum_diperbaiki,sudah_diperbaiki',
            'status_kominfo' => 'nullable|string|in:sedang_diperiksa,disetujui',
            'status_bps'     => 'nullable|string|in:sedang_diperiksa,perlu_perbaikan,disetujui',
        ];
    }
}
