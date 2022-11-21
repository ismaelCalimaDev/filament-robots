<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\File;

class RobotsTxt extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.robots-txt';

    public string $robots = '';

    public function mount()
    {
        $this->form->fill([
            'robots' => File::get(public_path('robots.txt'))
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Textarea::make('robots')->required(),
        ];
    }

    public function save()
    {
        File::replace(public_path('robots.txt'), $this->robots);
        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();
    }
}
