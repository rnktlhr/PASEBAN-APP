<?php
namespace App\Filament\Resources\KegiatanStatistikResource\Pages;
use App\Filament\Resources\KegiatanStatistikResource;
use Filament\Resources\Pages\ListRecords;
use App\Imports\KegiatanStatistikImport;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListKegiatanStatistik extends ListRecords { 
    protected static string $resource = KegiatanStatistikResource::class; 
    
    protected function getHeaderActions(): array { 
        return [
            Action::make('download_template')
                ->label('Download Template')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->action(function () {
                    $headers = "dinas_id,nama,jenis,tahun\n";
                    $sample = "1,Survei Penduduk,survei,2024\n";
                    return response()->streamDownload(function () use ($headers, $sample) {
                        echo $headers . $sample;
                    }, 'template_import_kegiatan.csv', ['Content-Type' => 'text/csv']);
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
                        Excel::import(new KegiatanStatistikImport, $filePath);
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
