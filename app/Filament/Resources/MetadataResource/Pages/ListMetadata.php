<?php
namespace App\Filament\Resources\MetadataResource\Pages;
use App\Filament\Resources\MetadataResource;
use Filament\Resources\Pages\ListRecords;
use App\Imports\MetadataImport;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListMetadata extends ListRecords { 
    protected static string $resource = MetadataResource::class; 
    
    protected function getHeaderActions(): array { 
        return [
            Action::make('download_template')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->action(function () {
                    $headers = "kegiatan_id,jenis,tahun,status_dinas,status_kominfo,status_bps,catatan\n";
                    $sample = "1,kegiatan,2024,belum_diajukan,sedang_diperiksa,sedang_diperiksa,Contoh catatan\n";
                    return response()->streamDownload(function () use ($headers, $sample) {
                        echo $headers . $sample;
                    }, 'template_import_metadata.csv', ['Content-Type' => 'text/csv']);
                }),
            Action::make('import')
                ->label('Import Excel')
                ->icon('heroicon-o-document-arrow-up')
                ->color('success')
                ->form([
                    FileUpload::make('file')
                        ->label('Pilih File Excel')
                        ->disk('local')
                        ->directory('imports')
                        ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'text/csv', 'text/plain'])
                        ->required(),
                ])
                ->action(function (array $data) {
                    try {
                        $filePath = Storage::disk('local')->path($data['file']);
                        Excel::import(new MetadataImport, $filePath);
                        Storage::disk('local')->delete($data['file']);
                        
                        \Filament\Notifications\Notification::make()
                            ->title('Import Berhasil')
                            ->success()
                            ->send();
                    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                        Storage::disk('local')->delete($data['file']);
                        $failures = $e->failures();
                        $messages = [];
                        foreach ($failures as $failure) {
                            $messages[] = 'Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors());
                        }
                        \Filament\Notifications\Notification::make()
                            ->title('Import Gagal (Validasi)')
                            ->body(implode('<br>', array_slice($messages, 0, 5)) . (count($messages) > 5 ? '<br>...dan ' . (count($messages) - 5) . ' error lainnya.' : ''))
                            ->danger()
                            ->persistent()
                            ->send();
                    } catch (\Exception $e) {
                        Storage::disk('local')->delete($data['file']);
                        \Filament\Notifications\Notification::make()
                            ->title('Import Gagal')
                            ->body('Pastikan format file sesuai template. Error: ' . $e->getMessage())
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),
            \Filament\Actions\CreateAction::make()
        ]; 
    } 
}
