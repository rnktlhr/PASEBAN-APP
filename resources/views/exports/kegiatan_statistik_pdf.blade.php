<!DOCTYPE html>
<html>
<head>
    <title>Export Identifikasi Kegiatan Statistik</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Identifikasi Kegiatan Statistik Sektoral - {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Jenis Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatanItems as $index => $kegiatan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kegiatan->nama }}</td>
                <td>{{ $kegiatan->dinas->nama ?? '-' }}</td>
                <td>{{ $kegiatan->jenis instanceof \App\Enums\JenisKegiatan ? $kegiatan->jenis->label() : ucfirst($kegiatan->jenis) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
