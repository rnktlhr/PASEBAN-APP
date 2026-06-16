<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Status Dinas</th>
            <th>Status Kominfo</th>
            <th>Status BPS</th>
            <th>Tanggal Pengajuan</th>
            <th>Tanggal Persetujuan</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($romantikItems as $index => $romantik)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $romantik->kegiatanStatistik->nama ?? '-' }}</td>
            <td>{{ $romantik->kegiatanStatistik->dinas->nama ?? '-' }}</td>
            <td>{{ $romantik->status_dinas instanceof \App\Enums\StatusDinas ? $romantik->status_dinas->label() : ucwords(str_replace('_', ' ', $romantik->status_dinas)) }}</td>
            <td>{{ $romantik->status_kominfo instanceof \App\Enums\StatusKominfo ? $romantik->status_kominfo->label() : ucwords(str_replace('_', ' ', $romantik->status_kominfo)) }}</td>
            <td>{{ $romantik->status_bps instanceof \App\Enums\StatusBps ? $romantik->status_bps->label() : ucwords(str_replace('_', ' ', $romantik->status_bps)) }}</td>
            <td>{{ $romantik->tanggal_pengajuan ? $romantik->tanggal_pengajuan->format('d/m/Y') : '-' }}</td>
            <td>{{ $romantik->tanggal_persetujuan ? $romantik->tanggal_persetujuan->format('d/m/Y') : '-' }}</td>
            <td>{{ $romantik->catatan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
