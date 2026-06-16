<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kegiatan Statistik</th>
            <th>OPD/Dinas</th>
            <th>Jenis Kegiatan</th>
            <th>Tahun</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kegiatanItems as $index => $kegiatan)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $kegiatan->nama }}</td>
            <td>{{ $kegiatan->dinas->nama ?? '-' }}</td>
            <td>{{ $kegiatan->jenis instanceof \App\Enums\JenisKegiatan ? $kegiatan->jenis->label() : ucfirst($kegiatan->jenis) }}</td>
            <td>{{ $kegiatan->tahun }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
