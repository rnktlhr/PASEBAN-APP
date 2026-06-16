<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Format Data</th>
            <th>Frekuensi</th>
            <th>Status Tayang</th>
            <th>Link Dataset</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aliranDataItems as $index => $aliran)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $aliran->kegiatanStatistik->nama ?? '-' }}</td>
            <td>{{ $aliran->kegiatanStatistik->dinas->nama ?? '-' }}</td>
            <td>{{ $aliran->format_data ?? '-' }}</td>
            <td>{{ $aliran->frekuensi instanceof \App\Enums\FrekuensiData ? $aliran->frekuensi->label() : ucfirst($aliran->frekuensi) }}</td>
            <td>{{ $aliran->sudah_tayang ? 'Sudah Tayang' : 'Belum Tayang' }}</td>
            <td>{{ $aliran->link_dataset ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
