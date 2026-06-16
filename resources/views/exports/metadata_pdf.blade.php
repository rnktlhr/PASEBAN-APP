<!DOCTYPE html>
<html>
<head>
    <title>Export Metadata Statistik</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Metadata Statistik Sektoral - {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Jenis Metadata</th>
                <th>Status Dinas</th>
                <th>Status BPS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($metadataItems as $index => $metadata)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $metadata->kegiatanStatistik->nama ?? '-' }}</td>
                <td>{{ $metadata->kegiatanStatistik->dinas->nama ?? '-' }}</td>
                <td>{{ $metadata->jenis instanceof \App\Enums\JenisMetadata ? $metadata->jenis->label() : ucfirst($metadata->jenis) }}</td>
                <td>{{ $metadata->status_dinas instanceof \App\Enums\StatusDinas ? $metadata->status_dinas->label() : ucwords(str_replace('_', ' ', $metadata->status_dinas)) }}</td>
                <td>{{ $metadata->status_bps instanceof \App\Enums\StatusBps ? $metadata->status_bps->label() : ucwords(str_replace('_', ' ', $metadata->status_bps)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
