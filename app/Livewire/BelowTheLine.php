<?php

namespace App\Livewire;

use App\Models\Party;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Livewire\Component;

class BelowTheLine extends Component implements HasForms
{
    use InteractsWithForms;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('leader'),
            ]);
    }

    public function render(): View
    {
        return view('livewire.below-the-line');
    }
}
