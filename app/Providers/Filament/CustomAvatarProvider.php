<?php

namespace App\Providers\Filament;

use Filament\AvatarProviders\Contracts\AvatarProvider;
use Illuminate\Database\Eloquent\Model;

class CustomAvatarProvider implements AvatarProvider
{
    public function get(Model $record): string
    {
        $name = urlencode(trim($record->name ?? 'Admin'));
        return 'https://api.dicebear.com/9.x/initials/svg?seed=' . $name . '&backgroundColor=F58220&textColor=ffffff';
    }
}
