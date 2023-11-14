<?php

namespace App\Livewire;

use App\Models\Party;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AboveTheLine extends Component implements HasForms
{
    use InteractsWithForms;
    public $partyCount;
    public $parties;

    // Properties to store the input values
    public $inputValues = [];

    public function mount(): void
    {
        $this->parties = Party::all();
        $this->partyCount = Party::count();

        // Initialize input values array
        foreach ($this->parties as $party) {
            $this->inputValues[$party->id] = $party->name;
        }
    }

    public function form(Form $form): Form
    {
        $partyFields = $this->parties->map(function ($party) {
            return Grid::make()
                ->schema([
                    Select::make("inputValues.{$party->id}")
                        ->options(array_combine(range(1, $this->partyCount), range(1, $this->partyCount)))
                        ->label("{$party->name}")
                        ->reactive()
                        ->afterStateUpdated(fn ($state) => $this->updateOtherSelects($party->id, $state)),
                ]);
        });

        return $form
            ->columns($this->partyCount)
            ->schema($partyFields->toArray());
    }

    public function submit(): void
    {
        foreach ($this->inputValues as $partyId => $value) {
            Log::info("Party ID {$partyId}: {$value}");
        }
    }

    protected function updateOtherSelects($currentPartyId, $selectedValue)
    {
        foreach ($this->inputValues as $partyId => &$value) {
            if ($partyId != $currentPartyId && $value == $selectedValue) {
                $value = null;
            }
        }
    }

    public function render(): View
    {
        return view('livewire.above-the-line');
    }

}

