<?php

namespace App\Livewire;

use App\Models\Party;
use App\Models\AtlVote;
use App\Models\Voter;
use Auth;
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
    public $eligible;

    // Properties to store the input values
    public $inputValues = [];

    public function mount(): void
    {

         $this->parties = Party::with('candidates')->get();

     // Check if parties are loaded
        if (!$this->parties) {
            $this->parties = collect(); // Initialize as an empty collection
        }
        $this->parties = Party::all();
        $this->partyCount = Party::count();
        $voter = Voter::where('user_id', Auth::id())->first();

        if ($voter) {
            $this->eligible = $voter->is_voting_eligible;
        } else {
            $this->eligible = false;
        }
        Log::info($this->eligible);

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

        $this->personSubmit();

        Voter::updateOrCreate(
            [
                'user_id' =>  Auth::id(),
            ],
            [
                'is_voting_eligible' => false,
            ]
        );
    }

    public function personSubmit()
    {
        foreach ($this->inputValues as $partyId => $value) {
            AtlVote::create([
                'voter_id' => Auth::id(),
                'election_id' => 1,
                'party_id' => $partyId,
                'priority' => $value,
            ]);
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

