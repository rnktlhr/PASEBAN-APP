<?php

namespace App\Imports;

use App\Models\Romantik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RomantikImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Romantik([
            'kegiatan_id'         => $row['kegiatan_id'],
            'tahun'               => $row['tahun'],
            'status_dinas'        => $row['status_dinas'] ?? 'belum_diajukan',
            'status_kominfo'      => $row['status_kominfo'] ?? 'sedang_diperiksa',
            'status_bps'          => $row['status_bps'] ?? 'sedang_diperiksa',
            'tanggal_pengajuan'   => $this->parseDate($row['tanggal_pengajuan'] ?? null),
            'tanggal_persetujuan' => $this->parseDate($row['tanggal_persetujuan'] ?? null),
            'catatan'             => $row['catatan'] ?? null,
        ]);
    }

    private function parseDate($value)
    {
        if (empty($value)) return null;
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value);
        }
        return $value;
    }

    public function rules(): array
    {
        return [
            'kegiatan_id'         => 'required|integer|exists:kegiatan_statistik,id',
            'tahun'               => 'required|integer|min:2020|max:2099',
            'status_dinas'        => 'nullable|string|in:belum_diajukan,sudah_diajukan,belum_diperbaiki,sudah_diperbaiki',
            'status_kominfo'      => 'nullable|string|in:sedang_diperiksa,perlu_perbaikan,disetujui',
            'status_bps'          => 'nullable|string|in:sedang_diperiksa,perlu_perbaikan,disetujui',
            'tanggal_pengajuan'   => 'nullable',
            'tanggal_persetujuan' => 'nullable',
            'catatan'             => 'nullable|string',
        ];
    }
}
