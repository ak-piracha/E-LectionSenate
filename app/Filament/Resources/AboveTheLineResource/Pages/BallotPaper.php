<?php

namespace App\Filament\Resources\AboveTheLineResource\Pages;

use App\Filament\Resources\AboveTheLineResource;
use Filament\Resources\Pages\Page;

class BallotPaper extends Page
{
    protected static string $resource = AboveTheLineResource::class;

    protected static string $view = 'filament.resources.above-the-line-resource.pages.ballot-paper';
}
