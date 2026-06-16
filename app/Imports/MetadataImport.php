<?php

namespace App\Imports;

use App\Models\Metadata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MetadataImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Metadata([
            'kegiatan_id'    => $row['kegiatan_id'],
            'jenis'          => $row['jenis'],
            'tahun'          => $row['tahun'],
            'status_dinas'   => $row['status_dinas'] ?? 'belum_diajukan',
            'status_kominfo' => $row['status_kominfo'] ?? 'sedang_diperiksa',
            'status_bps'     => $row['status_bps'] ?? 'sedang_diperiksa',
            'catatan'        => $row['catatan'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'kegiatan_id'    => 'required|integer|exists:kegiatan_statistik,id',
            'jenis'          => 'required|string|in:kegiatan,variabel,indikator',
            'tahun'          => 'required|integer|min:2020|max:2099',
            'status_dinas'   => 'nullable|string|in:belum_diajukan,sudah_diajukan,belum_diperbaiki,sudah_diperbaiki',
            'status_kominfo' => 'nullable|string|in:sedang_diperiksa,perlu_perbaikan,disetujui',
            'status_bps'     => 'nullable|string|in:sedang_diperiksa,perlu_perbaikan,disetujui',
            'catatan'        => 'nullable|string',
        ];
    }
}
