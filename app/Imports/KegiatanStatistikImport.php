<?php

namespace App\Imports;

use App\Models\KegiatanStatistik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KegiatanStatistikImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new KegiatanStatistik([
            'dinas_id' => $row['dinas_id'],
            'nama'     => $row['nama'],
            'jenis'    => $row['jenis'],
            'tahun'    => $row['tahun'],
        ]);
    }

    public function rules(): array
    {
        return [
            'dinas_id' => 'required|integer|exists:dinas,id',
            'nama'     => 'required|string|max:255',
            'jenis'    => 'required|string|in:survei,pendataan_lengkap,kompromin',
            'tahun'    => 'required|integer|min:2020|max:2099',
        ];
    }
}
