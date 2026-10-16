<!DOCTYPE html>
<html>
<head>
    <title>Pengingat Keterlambatan Kegiatan Statistik</title>
</head>
<body style="font-family: sans-serif; color: #333; line-height: 1.6;">
    <p>Yth. Bapak/Ibu dari <strong>{{ $dinas->nama }}</strong>,</p>
    
    <p>Sistem {{ setting('app_kepanjangan') }} ({{ setting('app_nama', 'PASEBAN') }}) mendeteksi bahwa ada beberapa Kegiatan Statistik dari instansi Anda yang mengalami keterlambatan dalam jadwal Monitoring & Evaluasi:</p>
    
    <ul>
        @foreach($kegiatanList as $kegiatan)
            <li><strong>{{ $kegiatan->nama }}</strong> (Jenis: {{ $kegiatan->jenis instanceof \App\Enums\JenisKegiatan ? $kegiatan->jenis->label() : ucfirst(str_replace('_', ' ', $kegiatan->jenis)) }})</li>
        @endforeach
    </ul>
    
    <p>Mohon agar segera melengkapi dokumen ROMANTIK atau Metadata terkait melalui aplikasi {{ setting('app_nama', 'PASEBAN') }}.</p>
    
    <p>Terima kasih atas kerja samanya dalam mewujudkan Satu Data Indonesia.</p>
    
    <p>Salam,<br>Admin {{ setting('app_nama', 'PASEBAN') }} - {{ setting('org_nama') }}</p>
</body>
</html>
