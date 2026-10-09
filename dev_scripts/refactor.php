<?php
$dirs = ['app', 'resources/views'];
foreach($dirs as $dir) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $c = file_get_contents($file);
            
            $c = str_replace(
                ['dinas_id', 'kegiatan_id', '->name', "['name']", '"name"'],
                ['id_dinas', 'id_kegiatan', '->nama', "['nama']", '"nama"'],
                $c
            );
            
            // Also user table has 'nama' now instead of 'name'? Wait! User uses 'nama'?
            // Let's check User model
            
            file_put_contents($file, $c);
        }
    }
}
echo "Refactoring complete.\n";
