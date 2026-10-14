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
            'id_romantik'    => $row['id_romantik'],
            'jenis'          => $row['jenis'],
            'tahun'          => $row['tahun'],
            'status_dinas'   => $row['status_dinas'] ?? 'belum_menyusun',
            'status_kominfo' => $row['status_kominfo'] ?? 'belum_diajukan',
            'status_bps'     => $row['status_bps'] ?? 'sedang_diperiksa',
        ]);
    }

    public function rules(): array
    {
        return [
            // unique: relasi 1:1 dengan romantik
            'id_romantik'    => 'required|integer|exists:romantik,id|unique:metadata,id_romantik',
            'jenis'          => 'required|string|in:kegiatan,variabel,indikator',
            'tahun'          => 'required|integer|min:2020|max:2099',
            'status_dinas'   => 'nullable|string|in:belum_menyusun,sudah_menyusun',
            'status_kominfo' => 'nullable|string|in:belum_diajukan,draft,submit,sudah_diperbaiki,disetujui',
            'status_bps'     => 'nullable|string|in:sedang_diperiksa,perlu_perbaikan,disetujui',
        ];
    }
}
