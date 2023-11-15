<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class BallotPaper extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.ballot-paper';

    public $activeTab = 'above';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

}
