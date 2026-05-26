<?php $b = App\Models\BeritaAcara::find(3); if($b){ $b->narasi = str_replace("http://localhost", "http://127.0.0.1:8000", $b->narasi); $b->save(); echo "Fixed DB URLs!"; }
