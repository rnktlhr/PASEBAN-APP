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
                ->label(__('messages.import.download_template'))
                ->icon('heroicon-o-arrow-down-tray')
                ->color('info')
                ->action(function () {
                    $headers = "id_romantik,jenis,tahun,status_dinas,status_kominfo,status_bps\n";
                    $sample = "1,kegiatan,2024,belum_menyusun,belum_diajukan,sedang_diperiksa\n";
                    return response()->streamDownload(function () use ($headers, $sample) {
                        echo $headers . $sample;
                    }, 'template_import_metadata.csv', ['Content-Type' => 'text/csv']);
                }),
            Action::make('import')
                ->label(__('messages.import.import_excel'))
                ->icon('heroicon-o-document-arrow-up')
                ->color('success')
                ->form([
                    FileUpload::make('file')
                        ->label(__('messages.import.choose_file'))
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
                            ->title(__('messages.import.success'))
                            ->success()
                            ->send();
                    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                        Storage::disk('local')->delete($data['file']);
                        $failures = $e->failures();
                        $messages = [];
                        foreach ($failures as $failure) {
                            $messages[] = __('messages.import.row_error', ['row' => $failure->row(), 'errors' => implode(', ', $failure->errors())]);
                        }
                        \Filament\Notifications\Notification::make()
                            ->title(__('messages.import.validation_failed'))
                            ->body(implode('<br>', array_slice($messages, 0, 5)) . (count($messages) > 5 ? '<br>' . __('messages.import.more_errors', ['count' => count($messages) - 5]) : ''))
                            ->danger()
                            ->persistent()
                            ->send();
                    } catch (\Exception $e) {
                        Storage::disk('local')->delete($data['file']);
                        \Filament\Notifications\Notification::make()
                            ->title(__('messages.import.failed'))
                            ->body(__('messages.import.failed_body', ['error' => $e->getMessage()]))
                            ->danger()
                            ->persistent()
                            ->send();
                    }
                }),
            \Filament\Actions\CreateAction::make()
        ]; 
    } 
}
