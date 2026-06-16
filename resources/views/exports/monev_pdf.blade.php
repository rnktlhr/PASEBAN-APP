<!DOCTYPE html>
<html>
<head>
    <title>Export Monev</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Laporan Monitoring & Evaluasi Kegiatan Statistik Sektoral - {{ $tahun }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kegiatan Statistik</th>
                <th>OPD/Dinas</th>
                <th>Status</th>
                <th>Metadata</th>
                <th>Romantik</th>
                <th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>Mei</th><th>Jun</th>
                <th>Jul</th><th>Agu</th><th>Sep</th><th>Okt</th><th>Nov</th><th>Des</th>
            </tr>
        </thead>
        <tbody>
            @foreach($monevItems as $index => $monev)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $monev->kegiatanStatistik->nama ?? '-' }}</td>
                <td>{{ $monev->kegiatanStatistik->dinas->nama ?? '-' }}</td>
                <td>{{ $monev->status?->label() ?? '-' }}</td>
                <td>{{ $monev->status_metadata ?? '-' }}</td>
                <td>{{ $monev->status_romantik ?? '-' }}</td>
                @for($m = 1; $m <= 12; $m++)
                    @php
                        $isRencana = $m >= $monev->bulan_rencana_mulai && $m <= $monev->bulan_rencana_selesai;
                        $isRealisasi = $monev->bulan_realisasi_mulai && $monev->bulan_realisasi_selesai && $m >= $monev->bulan_realisasi_mulai && $m <= $monev->bulan_realisasi_selesai;
                        
                        $symbol = '';
                        if ($isRealisasi) $symbol = 'V';
                        elseif ($isRencana) $symbol = 'O';
                    @endphp
                    <td style="text-align: center; {{ $isRealisasi ? 'color: green;' : ($isRencana ? 'color: blue;' : '') }}">{{ $symbol }}</td>
                @endfor
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
