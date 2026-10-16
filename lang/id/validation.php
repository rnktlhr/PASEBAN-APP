<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |--------------------------------------------------------------------------
    */

    'accepted' => ':attribute harus diterima.',
    'accepted_if' => ':attribute harus diterima ketika :other bernilai :value.',
    'active_url' => ':attribute bukan URL yang valid.',
    'after' => ':attribute harus berisi tanggal setelah :date.',
    'after_or_equal' => ':attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha' => ':attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num' => ':attribute hanya boleh berisi huruf dan angka.',
    'array' => ':attribute harus berisi sebuah array.',
    'ascii' => ':attribute hanya boleh berisi karakter alfanumerik dan simbol single-byte.',
    'before' => ':attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => ':attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => ':attribute harus memiliki :min sampai :max anggota.',
        'file' => ':attribute harus berukuran antara :min sampai :max kilobita.',
        'numeric' => ':attribute harus bernilai antara :min sampai :max.',
        'string' => ':attribute harus berisi antara :min sampai :max karakter.',
    ],
    'boolean' => ':attribute harus bernilai true atau false.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_equals' => ':attribute harus berisi tanggal yang sama dengan :date.',
    'date_format' => ':attribute tidak cocok dengan format :format.',
    'decimal' => ':attribute harus memiliki :decimal tempat desimal.',
    'declined' => ':attribute harus ditolak.',
    'different' => ':attribute dan :other harus berbeda.',
    'digits' => ':attribute harus terdiri dari :digits digit.',
    'digits_between' => ':attribute harus terdiri dari :min sampai :max digit.',
    'dimensions' => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':attribute memiliki nilai yang duplikat.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'ends_with' => ':attribute harus diakhiri salah satu dari berikut: :values.',
    'enum' => ':attribute yang dipilih tidak valid.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'extensions' => ':attribute harus memiliki salah satu ekstensi berikut: :values.',
    'file' => ':attribute harus berupa sebuah berkas.',
    'filled' => ':attribute harus memiliki nilai.',
    'gt' => [
        'array' => ':attribute harus memiliki lebih dari :value anggota.',
        'file' => ':attribute harus berukuran lebih besar dari :value kilobita.',
        'numeric' => ':attribute harus bernilai lebih besar dari :value.',
        'string' => ':attribute harus berisi lebih besar dari :value karakter.',
    ],
    'gte' => [
        'array' => ':attribute harus memiliki :value anggota atau lebih.',
        'file' => ':attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus bernilai lebih besar dari atau sama dengan :value.',
        'string' => ':attribute harus berisi lebih besar dari atau sama dengan :value karakter.',
    ],
    'image' => ':attribute harus berupa gambar.',
    'in' => ':attribute yang dipilih tidak valid.',
    'in_array' => ':attribute tidak ada di dalam :other.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'ip' => ':attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => ':attribute harus berupa alamat IPv6 yang valid.',
    'json' => ':attribute harus berupa JSON string yang valid.',
    'lowercase' => ':attribute harus berupa huruf kecil.',
    'lt' => [
        'array' => ':attribute harus memiliki kurang dari :value anggota.',
        'file' => ':attribute harus berukuran kurang dari :value kilobita.',
        'numeric' => ':attribute harus bernilai kurang dari :value.',
        'string' => ':attribute harus berisi kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => ':attribute tidak boleh memiliki lebih dari :value anggota.',
        'file' => ':attribute harus berukuran kurang dari atau sama dengan :value kilobita.',
        'numeric' => ':attribute harus bernilai kurang dari atau sama dengan :value.',
        'string' => ':attribute harus berisi kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => ':attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => ':attribute maksimal terdiri dari :max anggota.',
        'file' => ':attribute maksimal berukuran :max kilobita.',
        'numeric' => ':attribute maksimal bernilai :max.',
        'string' => ':attribute maksimal berisi :max karakter.',
    ],
    'max_digits' => ':attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => ':attribute harus berupa berkas berjenis: :values.',
    'mimetypes' => ':attribute harus berupa berkas berjenis: :values.',
    'min' => [
        'array' => ':attribute minimal terdiri dari :min anggota.',
        'file' => ':attribute minimal berukuran :min kilobita.',
        'numeric' => ':attribute minimal bernilai :min.',
        'string' => ':attribute minimal berisi :min karakter.',
    ],
    'min_digits' => ':attribute harus memiliki setidaknya :min digit.',
    'missing' => ':attribute harus tidak ada.',
    'multiple_of' => ':attribute harus merupakan kelipatan dari :value.',
    'not_in' => ':attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => ':attribute harus berupa angka.',
    'password' => [
        'letters' => ':attribute harus mengandung setidaknya satu huruf.',
        'mixed' => ':attribute harus mengandung setidaknya satu huruf kapital dan satu huruf kecil.',
        'numbers' => ':attribute harus mengandung setidaknya satu angka.',
        'symbols' => ':attribute harus mengandung setidaknya satu simbol.',
        'uncompromised' => ':attribute yang diberikan telah muncul dalam kebocoran data. Silakan pilih :attribute yang berbeda.',
    ],
    'present' => ':attribute wajib ada.',
    'prohibited' => ':attribute tidak boleh diisi.',
    'prohibited_if' => ':attribute tidak boleh diisi ketika :other bernilai :value.',
    'prohibited_unless' => ':attribute tidak boleh diisi kecuali :other memiliki nilai :values.',
    'prohibits' => ':attribute melarang :other untuk ditampilkan.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => ':attribute wajib diisi.',
    'required_array_keys' => ':attribute wajib berisi entri untuk: :values.',
    'required_if' => ':attribute wajib diisi bila :other adalah :value.',
    'required_if_accepted' => ':attribute wajib diisi bila :other diterima.',
    'required_unless' => ':attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with' => ':attribute wajib diisi bila terdapat :values.',
    'required_with_all' => ':attribute wajib diisi bila terdapat :values.',
    'required_without' => ':attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => ':attribute wajib diisi bila sama sekali tidak terdapat :values.',
    'same' => ':attribute dan :other harus sama.',
    'size' => [
        'array' => ':attribute harus mengandung :size anggota.',
        'file' => ':attribute harus berukuran :size kilobita.',
        'numeric' => ':attribute harus berukuran :size.',
        'string' => ':attribute harus berukuran :size karakter.',
    ],
    'starts_with' => ':attribute harus diawali salah satu dari berikut: :values.',
    'string' => ':attribute harus berupa string.',
    'timezone' => ':attribute harus berisi zona waktu yang valid.',
    'unique' => ':attribute sudah ada sebelumnya.',
    'uploaded' => ':attribute gagal diunggah.',
    'uppercase' => ':attribute harus berupa huruf kapital.',
    'url' => 'Format :attribute tidak valid.',
    'ulid' => ':attribute harus berupa ULID yang valid.',
    'uuid' => ':attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |--------------------------------------------------------------------------
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Nama Atribut Kustom
    |--------------------------------------------------------------------------
    */

    'attributes' => [
        'nama' => 'nama',
        'email' => 'email',
        'password' => 'kata sandi',
        'role' => 'peran',
        'id_dinas' => 'dinas / OPD',
        'tahun' => 'tahun',
        'judul' => 'judul',
        'file' => 'berkas',
    ],

];
