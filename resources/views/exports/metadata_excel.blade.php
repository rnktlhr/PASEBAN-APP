<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Jenis Metadata</th>
            <th>Status Dinas</th>
            <th>Status Kominfo</th>
            <th>Status BPS</th>
            <th>Catatan</th>
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
            <td>{{ $metadata->status_kominfo instanceof \App\Enums\StatusKominfo ? $metadata->status_kominfo->label() : ucwords(str_replace('_', ' ', $metadata->status_kominfo)) }}</td>
            <td>{{ $metadata->status_bps instanceof \App\Enums\StatusBps ? $metadata->status_bps->label() : ucwords(str_replace('_', ' ', $metadata->status_bps)) }}</td>
            <td>{{ $metadata->catatan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
