<!DOCTYPE html>
<html>
<head>
    <title>Export Rekomendasi Statistik (Romantik)</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Rekomendasi Statistik Sektoral (Romantik) - {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Status Dinas</th>
                <th>Status BPS</th>
                <th>Tgl Disetujui</th>
            </tr>
        </thead>
        <tbody>
            @foreach($romantikItems as $index => $romantik)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $romantik->kegiatanStatistik->nama ?? '-' }}</td>
                <td>{{ $romantik->kegiatanStatistik->dinas->nama ?? '-' }}</td>
                <td>{{ $romantik->status_dinas instanceof \App\Enums\StatusDinas ? $romantik->status_dinas->label() : ucwords(str_replace('_', ' ', $romantik->status_dinas)) }}</td>
                <td>{{ $romantik->status_bps instanceof \App\Enums\StatusBps ? $romantik->status_bps->label() : ucwords(str_replace('_', ' ', $romantik->status_bps)) }}</td>
                <td>{{ $romantik->tanggal_persetujuan ? $romantik->tanggal_persetujuan->format('d/m/Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
