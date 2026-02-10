<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Company;
use App\Models\Deal;
use Livewire\Component;

class GlobalSearch extends Component
{
    public string $query = '';
    public bool $showResults = false;

    public function updatedQuery(): void
    {
        $this->showResults = strlen($this->query) >= 2;
    }

    public function close(): void
    {
        $this->showResults = false;
        $this->query = '';
    }

    public function render()
    {
        $results = [];

        if (strlen($this->query) >= 2) {
            $q = $this->query;

            $results['contacts'] = Contact::where(fn ($qb) =>
                $qb->where('first_name', 'like', "%{$q}%")
                   ->orWhere('last_name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
            )->take(5)->get();

            $results['companies'] = Company::where('name', 'like', "%{$q}%")
                ->orWhere('domain', 'like', "%{$q}%")
                ->take(5)->get();

            $results['deals'] = Deal::where('title', 'like', "%{$q}%")
                ->take(5)->get();
        }

        return view('livewire.global-search', compact('results'));
    }
}
