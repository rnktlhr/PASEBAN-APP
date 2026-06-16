<!DOCTYPE html>
<html>
<head>
    <title>Export Aliran Data (Sedata Sebantul)</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Aliran Data (Sedata Sebantul) - {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Frekuensi</th>
                <th>Status Tayang</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aliranDataItems as $index => $aliran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $aliran->kegiatanStatistik->nama ?? '-' }}</td>
                <td>{{ $aliran->kegiatanStatistik->dinas->nama ?? '-' }}</td>
                <td>{{ $aliran->frekuensi instanceof \App\Enums\FrekuensiData ? $aliran->frekuensi->label() : ucfirst($aliran->frekuensi) }}</td>
                <td>{{ $aliran->sudah_tayang ? 'Sudah Tayang' : 'Belum Tayang' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
