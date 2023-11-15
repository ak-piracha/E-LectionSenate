<?php

namespace App\Livewire;

use App\Models\Candidate;
use App\Models\BtlVote;
use App\Models\Voter;
use App\Models\Party;
use Auth;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BelowTheLine extends Component implements HasForms
{
    use InteractsWithForms;

    public $candidateCount;
    public $candidates;
    public $eligible;
    public $partiesWithCandidates;
    public $inputValues = [];
    public $currentElectionId; // Assuming this is dynamically set

    public function mount(): void
{
    $this->partiesWithCandidates = Party::with('candidates')->get();
    $this->candidates = Candidate::all();
    $this->candidateCount = $this->candidates->count();

    foreach ($this->candidates as $candidate) {
        $this->inputValues[$candidate->id] = null;
    }
}

public function form(Form $form): Form
{
    $partyFields = $this->partiesWithCandidates->map(function ($party) {
        $candidateFields = $party->candidates->map(function ($candidate) {
            return Select::make("inputValues.{$candidate->id}")
                ->options($this->getPriorityOptions($candidate->id))
                ->label("{$candidate->first_name} {$candidate->last_name}")
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->updateOtherSelects($candidate->id, $state));
        });

        return Section::make($party->name)
            ->schema($candidateFields->toArray());
    });

    return $form->schema($partyFields->toArray());
}

protected function getPriorityOptions($currentCandidateId)
{
    $usedPriorities = array_filter($this->inputValues);

    $options = array_combine(range(1, $this->candidateCount), range(1, $this->candidateCount));

    foreach ($options as $priority) {
        if (in_array($priority, $usedPriorities) && (!isset($usedPriorities[$currentCandidateId]) || $usedPriorities[$currentCandidateId] != $priority)) {
            unset($options[$priority]);
        }
    }

    return $options;
}

public function submit()
{
    foreach ($this->inputValues as $candidateId => $priority) {
        if ($priority !== null) {
            BtlVote::create([
                'voter_id' => Auth::id(),
                'election_id' =>1,
                'candidate_id' => $candidateId,
                'priority' => $priority,
            ]);
        }
    }
    Voter::where('user_id', Auth::id())->update(['is_voting_eligible' => false]);

    session()->flash('message', 'Your vote has been submitted successfully.');
}



protected function updateOtherSelects($currentCandidateId, $selectedValue)
{
    foreach ($this->inputValues as $candidateId => &$value) {
        if ($candidateId != $currentCandidateId && $value == $selectedValue) {
            $value = null;
        }
    }
}



    public function render(): View
    {
        return view('livewire.below-the-line', ['eligible' => $this->eligible]);
    }
}
